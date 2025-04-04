import { Component, Injectable, OnInit } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { Router } from '@angular/router';

import { HeaderService } from '../service-dedicati/header.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css'],
  
})
@Injectable({
  providedIn: 'root'
})
export class HeaderComponent {

  selectedLanguage: string = 'it';
  currentRoute: string = '';
  indicatorTransform: string = 'translateX(0px)';
  menuiIsLoading: boolean = false;

  showFunctionButton:boolean = false;
  showLogo:boolean = true;
  icon:string = '';
  buttonAction:Function = () => {};

  constructor(
    private translate: TranslateService,
    private router: Router,
    private headerService: HeaderService
  ) {
    // Aggiorna la route corrente e l'indicatore all'avvio o cambio di route


    this.headerService.showFunctionButton$.subscribe(value => this.showFunctionButton = value);
    this.headerService.showLogo$.subscribe(value => this.showLogo = value);
    this.headerService.icon$.subscribe(value => this.icon = value);
    this.headerService.buttonAction$.subscribe(value => this.buttonAction = value);
  }

  ngOnInit() {
    this.router.events.subscribe(() => {
      this.currentRoute = this.router.url;
      this.disableButton();
    });
  }

  updateSelectedOption(event: Event) {
    const selectElement = event.target as HTMLSelectElement;
    this.selectedLanguage = selectElement.value;
    this.changeLanguage(this.selectedLanguage);
  }

  changeLanguage(lang: string) {
    this.selectedLanguage = lang;
    this.translate.use(lang);
    // metodo per aggiornare l'estetica del select-box del menu
    setTimeout(() => {
      this.updateIndicator();
    }, 5);
  }



  setActive(route: string) {
    this.currentRoute = route;
    this.updateIndicator();
  }

  activateButton(icon: string, action:Function = () => {}) {
    this.showFunctionButton = true;
    this.showLogo = false;

    this.icon = icon;
    this.buttonAction = action;
  }

  disableButton() {
    this.showFunctionButton = false;
    this.showLogo = true;
  }


  updateIndicator() {
    console.log("updateIndicator");
    const routes = ['/indirizzi', '/ambiente', '/museum', '/recognitions'];
    const index = routes.indexOf(this.currentRoute);

    if (index !== -1) {
        const menu = document.querySelector('#header__menu ul') as HTMLElement;
        const currentLi = menu.children[index] as HTMLElement; // Ottieni il `li` corrente

      if (currentLi) {
          const liWidth = currentLi.offsetWidth; // Larghezza del `li`
          const liLeft = currentLi.offsetLeft; // Posizione del `li` rispetto al genitore

          // Aggiorna la trasformazione e la larghezza
          this.indicatorTransform = `translateX(${liLeft}px)`;
          (document.querySelector('.current-page-box') as HTMLElement).style.width = `${liWidth}px`;
      }
    }
  }
}
