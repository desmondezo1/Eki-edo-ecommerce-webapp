import { PageNotFoundComponent } from './page-not-found/page-not-found.component';
import { RegisterComponent } from './auth/register/register.component';
import { LoginComponent } from './auth/login/login.component';
import { CartComponent } from './shop/cart/cart.component';
import { ProductDetailComponent } from './shop/product-detail/product-detail.component';
import { SearchResultComponent } from './shop/search-result/search-result.component';
import { ShopComponent } from './shop/shop.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './shop/home/home.component';

const routes: Routes = [
  {path: '' , component: HomeComponent},
  {path: 'login', component: LoginComponent},
  {path: 'register', component: RegisterComponent},
  {path: 'cart', component: CartComponent},
  {path: 'search/:query', component: SearchResultComponent},
  {path: 'p/:id', component: ProductDetailComponent  },
  {path: '**', component: PageNotFoundComponent },

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
