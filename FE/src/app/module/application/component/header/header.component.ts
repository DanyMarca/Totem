import { Component, Injectable } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
@Injectable({
  providedIn: 'root'
})
export class HeaderComponent {
  selectedLanguage: string = 'it';
  currentRoute: string = '';
  indicatorTransform: string = 'translateX(0px)';

  showFunctionButton:boolean = false;
  showLogo:boolean = true;
  icon:string = '';
  buttonAction:Function = () => {};

  constructor(
    private translate: TranslateService,
    private router: Router
  ) {
    // Aggiorna la route corrente e l'indicatore all'avvio o cambio di route
    this.router.events.subscribe(() => {
      this.currentRoute = this.router.url;
      this.updateIndicator();
    });
    console.log(this.showLogo)
  }

  updateSelectedOption(event: Event) {
    const selectElement = event.target as HTMLSelectElement;
    this.selectedLanguage = selectElement.value;
    this.changeLanguage(this.selectedLanguage);
  }

  changeLanguage(lang: string) {
    this.selectedLanguage = lang;
    this.translate.use(lang);
  }

  setActive(route: string) {
    this.currentRoute = route;
    this.updateIndicator();
  }

  activateButton(icon: string, action:Function = () => {}) {
    console.log("dentro activate button")
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
