import { Component, OnInit } from '@angular/core';
import { TranslationService } from './shared/services/translation/translation.service';
import { TranslateService } from '@ngx-translate/core';

import { Location } from '@angular/common';
import { ActivatedRoute, Router } from '@angular/router';

import { environment } from 'src/environments/environment.prod';



@Component({
  selector: 'app-root',
  templateUrl: './app.component.html'
})
export class AppComponent {
  inputText: string = '';
  translatedText: string = '';

  fullUrl=window.location.origin;


  private selectedLanguage = 'it';  // Correzione da selectLanguage a selectedLanguage
  
  constructor(
    private translationService: TranslationService, 
    private translate: TranslateService,  // Corretto l'injector per TranslateService
    private location: Location, private route: ActivatedRoute, private router: Router
  ) {
    this.translate.setDefaultLang('it');  // Lingua predefinita
    this.translate.use('it');  // Lingua iniziale
  }

  ngOnInit() {
    this.fullUrl = this.fullUrl.replace('4200', '8000');
    console.log(`${this.fullUrl}${this.router.url}api`);
    environment.apiBaseUrl = `${this.fullUrl}${this.router.url}api`;
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
