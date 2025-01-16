import { Component } from '@angular/core';
import { TranslationService } from './shared/services/translation/translation.service';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent {
  textToTranslate = '';
  sourceLang = 'it';
  targetLang = 'en';
  translatedText$ = this.translationService.translatedText$;

  constructor(private translationService: TranslationService) {}

  // Metodo per avviare la traduzione
  translate() {
    console.log("testo da tradurre: ",this.textToTranslate)
    console.log("testo da tradurre: ",this.sourceLang)
    console.log("testo da tradurre: ",this.targetLang)
    console.log("testo da tradurre: ",this.translatedText$)
    this.translationService.translateText(this.textToTranslate, this.sourceLang, this.targetLang).subscribe(
      () => console.log('Traduzione completata'),
      (error) => console.error('Errore durante la traduzione:', error)
    );
  }
}
