import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ApplicationComponent } from './application.component';
import { IndirizziComponent } from './pages/indirizzi/indirizzi.component';
import { AmbienteComponent } from './pages/ambiente/ambiente.component';

const routes: Routes = [
  {
    path: '', component: ApplicationComponent, children: [
      { path: 'indirizzi', component: IndirizziComponent },
      { path: 'ambiente', component: AmbienteComponent },
      { path: '', redirectTo: 'indirizzi', pathMatch: 'full'}

    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ApplicationRoutingModule { }
