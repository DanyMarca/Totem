import { Component } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {

  selectedLanguage: string='it'
  
  constructor( 
    private translate: TranslateService  // Corretto l'injector per TranslateService
  ) {}

  updateSelectedOption(event: Event) {
    const selectElement = event.target as HTMLSelectElement; 
    this.selectedLanguage = selectElement.value;
    console.log('Selected Option:', this.selectedLanguage);
    this.changeLanguage(this.selectedLanguage);
  }
  changeLanguage(lang: string) {
    console.log('dentro changeLanguage');
    this.selectedLanguage = lang;  // Aggiornato il valore di selectedLanguage
    this.translate.use(lang);  // Cambia lingua
  }
}


