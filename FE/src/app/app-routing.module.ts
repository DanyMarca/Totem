import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  { path: 'application', loadChildren: ()=> import('../app/module/application/application.module').then(m=>m.ApplicationModule)},
  { path: '', loadChildren: ()=> import('../app/module/application/application.module').then(m=>m.ApplicationModule)},
  { path: '**', redirectTo: ''}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
