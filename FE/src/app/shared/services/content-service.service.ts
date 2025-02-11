import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment.prod';

@Injectable({
  providedIn: 'root'
})
export class ContentServiceService {

  endpoint: string = environment.apiBaseUrl;

  constructor(
    private http: HttpClient
  ) {}

  fetchDataHomeIndirizzi() {
    return this.http.get<any>(`${this.endpoint}/Category/home`);
  }
}

