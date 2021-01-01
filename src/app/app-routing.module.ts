import { SavedItemsComponent } from './shop/account/saved-items/saved-items.component';
import { OrdersComponent } from './shop/account/orders/orders.component';
import { ChangePasswordComponent } from './shop/account/change-password/change-password.component';
import { UpdateProfileComponent } from './shop/account/update-profile/update-profile.component';
import { AccountComponent } from './shop/account/account.component';
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
import { updateLanguageServiceSourceFile } from 'typescript';
import { AngularFireAuthGuard, hasCustomClaim, redirectUnauthorizedTo, redirectLoggedInTo } from '@angular/fire/auth-guard';


const redirectUnauthorizedToLogin = () => redirectUnauthorizedTo(['/login']);
const redirectLoggedInToProfile = () => redirectLoggedInTo(['/profile']);

const routes: Routes = [
  {path: '' , component: HomeComponent},
  {path: 'login', component: LoginComponent, canActivate: [AngularFireAuthGuard], data: { authGuardPipe: redirectLoggedInToProfile }},
  {path: 'profile', redirectTo: 'profile/update', pathMatch: 'full'},
  {path: 'profile', component: AccountComponent,
  canActivate: [AngularFireAuthGuard], data: { authGuardPipe: redirectUnauthorizedToLogin },
  children: [
    {path: 'update', component: UpdateProfileComponent},
    {path: 'saved', component: SavedItemsComponent},
    {path: 'orders', component: OrdersComponent},
    {path: 'change-password', component: ChangePasswordComponent}
  ]},
  {path: 'register', component: RegisterComponent, canActivate: [AngularFireAuthGuard], data: { authGuardPipe: redirectLoggedInToProfile }},
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
