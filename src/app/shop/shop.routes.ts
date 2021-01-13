// import { ChangePasswordComponent } from './account/change-password/change-password.component';
// import { SearchResultComponent } from './search-result/search-result.component';
// import { ProductDetailComponent } from './product-detail/product-detail.component';
// import { CheckoutComponent } from './checkout/checkout.component';
// import { CartComponent } from './cart/cart.component';
// import { AccountComponent } from './account/account.component';
// import { HomeComponent } from './home/home.component';
// import { AngularFireAuthGuard, hasCustomClaim, redirectUnauthorizedTo, redirectLoggedInTo } from '@angular/fire/auth-guard';
// import { UpdateProfileComponent } from './account/update-profile/update-profile.component';
// import { SavedItemsComponent } from './account/saved-items/saved-items.component';
// import { OrdersComponent } from './account/orders/orders.component';


// const redirectUnauthorizedToLogin = () => redirectUnauthorizedTo(['/login']);
// const redirectLoggedInToProfile = () => redirectLoggedInTo(['/profile']);

// export const shopRoutes = [
//   {path: '' , component: HomeComponent},
// {path: 'checkout', component: CheckoutComponent,
//          canActivate: [AngularFireAuthGuard],
//          data: { authGuardPipe: redirectUnauthorizedToLogin }
//     },
// {path: 'profile', redirectTo: 'profile/update', pathMatch: 'full'},
//   {path: 'profile', component: AccountComponent,
//   canActivate: [AngularFireAuthGuard], data: { authGuardPipe: redirectUnauthorizedToLogin },
//   children: [
//     {path: 'update', component: UpdateProfileComponent},
//     {path: 'saved', component: SavedItemsComponent},
//     {path: 'orders', component: OrdersComponent},
//     {path: 'change-password', component: ChangePasswordComponent}
//   ]},
// {path: 'cart', component: CartComponent},
//   {path: 'search', component: SearchResultComponent},
//   {path: 'p/:id', component: ProductDetailComponent  },

// ]
