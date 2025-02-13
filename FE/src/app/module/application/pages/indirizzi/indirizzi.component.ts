import { Component,OnInit  } from '@angular/core';
import { catchError, of, tap } from 'rxjs';
import { ContentServiceService } from 'src/app/shared/services/content-service.service';

import { ActivatedRoute, Router } from '@angular/router';

import { HeaderComponent } from '../../component/header/header.component';
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


  constructor(private contentService: ContentServiceService, private route: ActivatedRoute, private router: Router, private headerComponent: HeaderComponent)
   { }

  ngOnInit(): void {
    this.loadIndirizziData();
  }

  goBack(): void {
    this.showCategory=false;
    this.showHero=true;
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
    console.log("categori details: ", this.categoryDetails.categories);
    this.showCategory = true;
    this.headerComponent.activateButton('FE\src\assets\icon\arrow_back_icon_235226.png', this.goBack);
  }
}