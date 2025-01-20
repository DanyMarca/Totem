import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ApplicationComponent } from './application.component';
import { IndirizziComponent } from './pages/indirizzi/indirizzi.component';


const routes: Routes = [
  {
    path: '', component: ApplicationComponent, children: [
      { path: 'indirizzi', component: IndirizziComponent }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ApplicationRoutingModule { }
