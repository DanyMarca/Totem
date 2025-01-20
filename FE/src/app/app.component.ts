import { Component } from '@angular/core';
import { TranslationService } from './shared/services/translation/translation.service';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html'
})
export class AppComponent {
  inputText: string = '';
  translatedText: string = '';


  private selectedLanguage = 'it';  // Correzione da selectLanguage a selectedLanguage
  
  constructor(
    private translationService: TranslationService, 
    private translate: TranslateService  // Corretto l'injector per TranslateService
  ) {
    this.translate.setDefaultLang('it');  // Lingua predefinita
    this.translate.use('it');  // Lingua iniziale
  }

  changeLanguage(lang: string) {
    this.selectedLanguage = lang;  // Aggiornato il valore di selectedLanguage
    this.translate.use(lang);  // Cambia lingua
  }

  onTranslate() {
    this.translationService.translateText(this.inputText, this.selectedLanguage)  // Passato selectedLanguage al servizio
      .subscribe((response: any) => {
        this.translatedText = response.translation;
      });
  }
}
