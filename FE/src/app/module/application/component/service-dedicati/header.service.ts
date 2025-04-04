import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class HeaderService {
  private showFunctionButtonSubject = new BehaviorSubject<boolean>(false);
  private showLogoSubject = new BehaviorSubject<boolean>(true);
  private iconSubject = new BehaviorSubject<string>('');
  private buttonActionSubject = new BehaviorSubject<() => void>(() => {});

  showFunctionButton$ = this.showFunctionButtonSubject.asObservable();
  showLogo$ = this.showLogoSubject.asObservable();
  icon$ = this.iconSubject.asObservable();
  buttonAction$ = this.buttonActionSubject.asObservable();

  activateButton(icon: string, action: () => void = () => {}) {
    console.log("Attivazione bottone nel servizio");
    this.showFunctionButtonSubject.next(true);
    this.showLogoSubject.next(false);
    this.iconSubject.next(icon);
    this.buttonActionSubject.next(action);
  }

  disableButton() {
    console.log("Disabilitazione bottone nel servizio");
    this.showFunctionButtonSubject.next(false);
    this.showLogoSubject.next(true);
  }
}
