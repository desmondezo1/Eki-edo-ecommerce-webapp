import { SearchResultComponent } from './shop/search-result/search-result.component';
import { ShopComponent } from './shop/shop.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './shop/home/home.component';

const routes: Routes = [
  {path: '' , component: HomeComponent},
  {path:'search/:query',component:SearchResultComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
