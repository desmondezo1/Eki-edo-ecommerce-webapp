import { AboutModule } from './about/about.module';
import { CheckoutComponent } from './checkout/checkout.component';
import { SavedItemsComponent } from './account/saved-items/saved-items.component';
import { OrdersComponent } from './account/orders/orders.component';
import { ChangePasswordComponent } from './account/change-password/change-password.component';
import { UpdateProfileComponent } from './account/update-profile/update-profile.component';
import { AccountComponent } from './account/account.component';
import { PageNotFoundComponent } from './page-not-found/page-not-found.component';
import { RegisterComponent } from './auth/register/register.component';
import { LoginComponent } from './auth/login/login.component';
// import { CartComponent } from './cart/cart.component';
// import { ProductDetailComponent } from './product-detail/product-detail.component';
import { SearchResultComponent } from './search-result/search-result.component';
// import { ShopComponent } from './shop.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { updateLanguageServiceSourceFile } from 'typescript';
import { AngularFireAuthGuard, hasCustomClaim, redirectUnauthorizedTo, redirectLoggedInTo } from '@angular/fire/auth-guard';


const redirectUnauthorizedToLogin = () => redirectUnauthorizedTo(['/login']);
const redirectLoggedInToProfile = () => redirectLoggedInTo(['/profile']);

const routes: Routes = [
  {path: '' , component: HomeComponent},
  {path: 'about', loadChildren: () => import('src/app/about/about.module').then(m => m.AboutModule)},
  // {path: '', loadChildren: () => import('src/app/home/home.module').then(m => m.HomeModule) },
  {path: 'p/:id', loadChildren: () => import('src/app/product-detail/product-detail.module').then(m => m.ProductDetailModule) },
  // {path: 'checkout', component: CheckoutComponent,
  //        canActivate: [AngularFireAuthGuard],
  //        data: { authGuardPipe: redirectUnauthorizedToLogin }
  //   },
  {path: 'checkout', loadChildren: () => import('src/app/checkout/checkout.module').then(m => m.CheckoutModule) ,
         canActivate: [AngularFireAuthGuard],
         data: { authGuardPipe: redirectUnauthorizedToLogin }
    },
  {path: 'login', component: LoginComponent, canActivate: [AngularFireAuthGuard], data: { authGuardPipe: redirectLoggedInToProfile }},
  // {path: 'profile', redirectTo: 'profile/update', pathMatch: 'full'},
  {path: 'profile', loadChildren: () => import('src/app/account/account.module').then(m => m.AccountModule),
  canActivate: [AngularFireAuthGuard], data: { authGuardPipe: redirectUnauthorizedToLogin },
  // children: [
  //   // {path: 'update', component: UpdateProfileComponent},
  //   // {path: 'saved', component: SavedItemsComponent},
  //   // {path: 'orders', component: OrdersComponent},
  //   // {path: 'change-password', component: ChangePasswordComponent}
  // ]
},
  {path: 'register', component: RegisterComponent, canActivate: [AngularFireAuthGuard], data: { authGuardPipe: redirectLoggedInToProfile }},
  // {path: 'cart', component: CartComponent},
  {path: 'cart', loadChildren: () => import('src/app/cart/cart.module').then(m => m.CartModule) },
  {path: 'contact-us', loadChildren: () => import('src/app/contact-us/contact-us.module').then(m => m.ContactUsModule) },
  // {path: 'search', component: SearchResultComponent},
  {path: 'search', loadChildren: () => import('src/app/search-result/search-result.module').then(m => m.SearchResultModule)},
  // {path: 'p/:id', component: ProductDetailComponent  },
  {path: '**', component: PageNotFoundComponent },
  {path: '404', component: PageNotFoundComponent },

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
