import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ApplicationRoutingModule } from './application-routing.module';
import { IndirizziComponent } from './pages/indirizzi/indirizzi.component';
import { CardComponent } from './component/card/card.component';


@NgModule({
  declarations: [
    IndirizziComponent,
    CardComponent
  ],
  imports: [
    CommonModule,
    ApplicationRoutingModule
  ]
})
export class ApplicationModule { }
