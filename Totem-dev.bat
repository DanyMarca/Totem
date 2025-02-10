@echo off
REM Ottieni la directory dello script
set scriptdir=%~dp0

echo Avvio del servizio MySQL...

start /b "MySQL" "C:\xampp\mysql\bin\mysqld"
if %errorlevel% neq 0 (
    echo Errore nell'avvio del servizio MySQL. Controllare il percorso.
    exit /b
)

echo Avvio del server Laravel...
cd "%scriptdir%BE"
start /b "Laravel" cmd /c "php artisan serve --host=0.0.0.0 --port=8000"
if %errorlevel% neq 0 (
    echo Errore nell'avvio del server Laravel.
    exit /b
)

echo Avvio del server Angular...
cd "%scriptdir%FE"
start /b "Angular" cmd /c "ng serve --host=0.0.0.0 --disable-host-check"
if %errorlevel% neq 0 (
    echo Errore nell'avvio del server Angular.
    exit /b
)

REM Controlla se il server Angular è pronto
echo Controllo del server Angular in corso...
:check_angular
timeout /t 5 >nul
curl -s http://localhost:4200 >nul 2>&1
if errorlevel 1 (
    echo. & echo Server Angular non ancora pronto. Riprovo tra 5 secondi...
    goto check_angular
)

@REM REM Chiudi tutte le istanze di Chrome
@REM taskkill /f /im chrome.exe >nul 2>&1

REM Avvia Chrome in modalità kiosk
echo Apertura del browser in modalità kiosk...
start chrome --kiosk "http://localhost:4200/"



if %errorlevel% neq 0 (
    echo Errore nell'apertura del browser.
    exit /b
)

echo Tutti i servizi sono stati avviati correttamente.
exit
