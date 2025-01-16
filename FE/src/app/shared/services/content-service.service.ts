import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment.prod';

@Injectable({
  providedIn: 'root'
})
export class ContentServiceService {
  endpoint: string = environment.apiBaseUrl+'/api/auth';
  constructor() { }
}
