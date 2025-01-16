import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
import { tap } from 'rxjs/operators';

@Injectable({
  providedIn: 'root',
})
export class TranslationService {
  private apiUrl = environment.libreTranslateApi;

  // Subject per gestire il testo tradotto
  private translatedTextSubject = new BehaviorSubject<string>('');
  public translatedText$: Observable<string> = this.translatedTextSubject.asObservable();

  constructor(private http: HttpClient) {}

  // Metodo per effettuare la traduzione
  translateText(text: string, sourceLang: string, targetLang: string): Observable<any> {
    const body = {
      q: text,
      source: sourceLang,
      target: targetLang,
      format: 'text',
    };

    return this.http.post(this.apiUrl, body).pipe(
      tap((response: any) => {
        // Aggiorna il Subject con il testo tradotto
        this.translatedTextSubject.next(response.translatedText);
        console.log("testo tradotto dentro api: ", response.translatedText)
      })
    );
    
  }
}
