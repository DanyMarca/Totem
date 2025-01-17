import { Component } from '@angular/core';
import { TranslationService } from './shared/services/translation/translation.service'
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html'
})
export class AppComponent {
  inputText: string = '';
  translatedText: string = '';

  constructor(private translationService: TranslationService) {}

  onTranslate(language: string) {
    this.translationService.translateText(this.inputText)
      .subscribe((response: any) => {
        this.translatedText = response.translation;
      });
  }
}
