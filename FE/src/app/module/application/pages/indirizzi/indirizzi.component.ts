import { Component,OnInit } from '@angular/core';
import { catchError, of, tap } from 'rxjs';
import { ContentServiceService } from 'src/app/shared/services/content-service.service';


@Component({
  selector: 'app-indirizzi',
  templateUrl: './indirizzi.component.html',
  styleUrls: ['./indirizzi.component.css']
})
export class IndirizziComponent {

  homedata:any=[];
  isLoading: boolean = false;
  cardKeys: { [key: string]: boolean } = {}


  constructor(private contentService: ContentServiceService) { }

  ngOnInit(): void {
    this.loadIndirizziData();
  }

  loadIndirizziData(): void {
    this.isLoading = true; 
    
    this.contentService?.fetchDataHomeIndirizzi()?.pipe(
      tap(() => this.isLoading = false), // Nascondi il loader quando i dati vengono ricevuti
      catchError((error) => {
        this.isLoading = false; // Nascondi il loader in caso di errore
        console.error("Errore durante il caricamento dei dati:", error);
        return of([]);
      })
    ).subscribe((res) => {
      this.homedata=res
      this.dataProcessor()
    });
  }
  
  dataProcessor(){
    this.homedata.forEach((element: { id: string | number; }) => {
      this.cardKeys[element.id]=false
    });
  }

}


