@echo off

echo Avvio del servizio MySQL...
start /b "MySQL" "C:\xampp\mysql\bin\mysqld"
if %errorlevel% neq 0 (
    echo Errore nell'avvio del servizio MySQL. Controllare il percorso.
    pause
    exit /b
)

:: Ottieni il percorso della directory dello script attuale
set SCRIPT_DIR=%~dp0

echo Avvio del server Laravel...
cd "%SCRIPT_DIR%BE"
start /b "Laravel" cmd /c "php artisan serve"
if %errorlevel% neq 0 (
    echo Errore nell'avvio del server Laravel.
    pause
    exit /b
)

echo Avvio del server Angular...
cd "%SCRIPT_DIR%FE"
start /b "Angular" cmd /c "ng serve"
if %errorlevel% neq 0 (
    echo Errore nell'avvio del server Angular.
    pause
    exit /b
)

echo Apertura del browser su Google...
start chrome --start-fullscreen "http://localhost:4200/"
if %errorlevel% neq 0 (
    echo Errore nell'apertura del browser.
    pause
    exit /b
)

echo Tutti i servizi sono stati avviati e la pagina web è stata aperta.
pause
exit
