import { Component,OnInit  } from '@angular/core';
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
  showHero: boolean = false;
  showCategory: boolean = false;
  categoryDetails: any = [];


  constructor(private contentService: ContentServiceService) { }

  ngOnInit(): void {
    this.loadIndirizziData();
  }

  loadIndirizziData(): void {
    this.isLoading = true; 
    
    this.contentService?.fetchDataHomeIndirizzi()?.pipe(
      tap(() => {
        this.isLoading = false;
        this.showHero = true;
      }), // Nascondi il loader quando i dati vengono ricevuti e mostra la hero section
      catchError((error) => {
        this.isLoading = false; // Nascondi il loader in caso di errore
        console.error("Errore durante il caricamento dei dati:", error);
        return of([]);
      })
    ).subscribe((res) => {
      this.homedata=res
      
    });
  }

  genereteCategoryDetails(category: any): void {
    this.categoryDetails = category;
    this.showHero = false;
    console.log(this.categoryDetails);
    this.showCategory = true;


  }
  
}