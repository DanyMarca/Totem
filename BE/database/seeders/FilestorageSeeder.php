<?php
namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\FileStorage;
use App\Models\Artifact;
use App\Models\Category;
use App\Models\Laboratory;

class FileStorageSeeder extends Seeder
{
    public function run()
    {
        // Percorso della cartella che contiene le immagini
        $imageFolder = storage_path('stock_images'); // Modifica con il percorso corretto

        // Recupera tutte le immagini nella cartella
        $images = glob($imageFolder . '/*.{jpg,jpeg,png,gif,svg}', GLOB_BRACE);

        // Rimuovi tutte le immagini esistenti nella tabella FileStorage
        FileStorage::truncate(); // Elimina tutti i record dalla tabella FileStorage

        foreach ($images as $imagePath) {
            try {
                // Recupera il nome del file e l'estensione
                $fileName = pathinfo($imagePath, PATHINFO_FILENAME);
                $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
                $storedFileName = str_replace(' ', '-', $fileName) . '_' . time() . '.' . $extension;

                // Carica il file nella cartella 'public' di storage
                Storage::disk('public')->put($storedFileName, file_get_contents($imagePath));

                // Ottieni le dimensioni dell'immagine (larghezza x altezza)
                $imageSize = getimagesize($imagePath);
                $width = $imageSize[0];  // Larghezza
                $height = $imageSize[1]; // Altezza

                // Determina l'orientamento: orizzontale o verticale
                $orientation = ($width > $height) ? 'horizontal' : 'vertical';
                

                // Verifica se il file esiste già nel database

                // Crea un nuovo record nella tabella FileStorage
                $type = [Category::class,Laboratory::class,Artifact::class];

                for($i=0; $i<3; $i++)
                { FileStorage::create([
                    'path' => '/storage/' . $storedFileName,
                    'orientation' => $orientation,  // Memorizza solo "orizzontale" o "verticale"
                    'filestorageable_type' => $type[rand(0,2)], // Modifica se necessario
                    'filestorageable_id' => rand(1,5), // Modifica l'ID secondo le tue esigenze
                ]);}

                echo "File {$storedFileName} caricato correttamente con orientamento {$orientation}.\n";

            } catch (\Exception $e) {
                echo "Errore durante il caricamento del file {$imagePath}: " . $e->getMessage() . "\n";
            }
        }
    }
}
