import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class TranslationService {
  private apiUrl = 'https://lingva.ml/api/v1/';

  constructor(private http: HttpClient) {}

  translateText(text: string) {
    return this.http.get(`${this.apiUrl}it/en/${encodeURIComponent(text)}`);
}

}
