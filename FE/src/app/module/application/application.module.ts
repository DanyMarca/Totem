import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TranslateModule } from '@ngx-translate/core';

// Modulo di routing
import { ApplicationRoutingModule } from './application-routing.module';

// Componenti
import { IndirizziComponent } from './pages/indirizzi/indirizzi.component';
import { CardComponent } from './component/card/card.component';
import { HeaderComponent } from './component/header/header.component';
import { ApplicationComponent } from './application.component';
import { FormsModule } from '@angular/forms';

@NgModule({
  declarations: [
    ApplicationComponent,   // Componente principale del modulo
    IndirizziComponent,     // Pagina "Indirizzi"
    CardComponent,          // Componente "Card"
    HeaderComponent         // Componente "Header"
  ],
  imports: [
    CommonModule,           // Moduli base Angular
    ApplicationRoutingModule, // Modulo di routing specifico
    TranslateModule,
    FormsModule
  ],
  exports: [
    ApplicationComponent    // Esporta il componente principale (se necessario)
  ]
})
export class ApplicationModule { }
