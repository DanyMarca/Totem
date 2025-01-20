import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment.prod';

@Injectable({
  providedIn: 'root'
})
export class ContentServiceService {

  endpoint: string = environment.apiBaseUrl;
  private finalUrlList: string[] = ["indirizzi"];  // Corretto con array di stringhe

  constructor(
    private http: HttpClient
  ) {}

  fetchData(finalUrl: string) {
    if (this.finalUrlList.includes(finalUrl)) {  // Corretto l'uso di includes
      return this.http.get<any>(`${this.endpoint}/${finalUrl}`);
    } else {
      console.error('URL non valido');  // Aggiunto un log di errore
      return null;  // Restituito null se l'URL non è presente
    }
  }
}

