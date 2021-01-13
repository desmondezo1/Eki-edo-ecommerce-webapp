import { BrowserModule } from '@angular/platform-browser';
import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ShopComponent } from './shop/shop.component';
import { NavbarComponent } from './navbar/navbar.component';
import { CategoryComponent } from './home/categories/category/category.component';
import { FooterComponent } from './footer/footer.component';
import { HomebannerComponent } from './home/homebanner/homebanner.component';
import { CategoriesComponent } from './home/categories/categories.component';
import { HomeComponent } from './home/home.component';
import { SearchbarComponent } from './navbar/searchbar/searchbar.component';
import { NgbActiveModal, NgbModal, NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { CarouselComponent } from './home/homebanner/carousel/carousel.component';
import { ProductListComponent } from './home/categories/category/product-list/product-list.component';
import { ProductComponent } from './home/categories/category/product-list/product/product.component';
// import { SearchResultComponent } from './search-result/search-result.component';
// import { ResultFilterComponent } from './search-result/result-filter/result-filter.component';


import {FormsModule, ReactiveFormsModule } from '@angular/forms';
// import { FilterNavigationComponent } from './search-result/filter-navigation/filter-navigation.component';
// import { ProductDetailComponent } from './product-detail/product-detail.component';
// import { ProductImageGalleryComponent } from './product-detail/product-image-gallery/product-image-gallery.component';
import { ImageListComponent } from './product-detail/product-image-gallery/image-list/image-list.component';
// import { CartComponent } from './cart/cart.component';
// import { CartItemComponent } from './cart/cart-item/cart-item.component';
import { CurrencyPipe } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { LoginComponent } from './auth/login/login.component';
import { RegisterComponent } from './auth/register/register.component';
import { PageNotFoundComponent } from './page-not-found/page-not-found.component';
// import { AccountComponent } from './account/account.component';
// import { UpdateProfileComponent } from './account/update-profile/update-profile.component';
// import { OrdersComponent } from './account/orders/orders.component';
// import { SavedItemsComponent } from './account/saved-items/saved-items.component';
// import { ChangePasswordComponent } from './account/change-password/change-password.component';
import { AngularFireModule } from '@angular/fire';
import { environment } from '../environments/environment';
import { NgxPaginationModule } from 'ngx-pagination';
import { NgAisModule } from 'angular-instantsearch';
// import { CheckoutComponent } from './checkout/checkout.component';
import { Angular4PaystackModule } from 'angular4-paystack';
import { UsermanagementComponent } from './auth/usermanagement/usermanagement.component';
import { NgxSpinnerModule } from "ngx-spinner";
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ToastrModule } from 'ngx-toastr';
import { ServiceWorkerModule } from '@angular/service-worker';
import { ConnectionServiceModule } from 'ng-connection-service';
@NgModule({
  declarations: [
    AppComponent,
    ShopComponent,
    NavbarComponent,
    CategoryComponent,
    FooterComponent,
    HomebannerComponent,
    CategoriesComponent,
    HomeComponent,
    SearchbarComponent,
    CarouselComponent,
    ProductListComponent,
    ProductComponent,
    // SearchResultComponent,
    // ResultFilterComponent,
    // FilterNavigationComponent,
    // ProductDetailComponent,
    // ProductImageGalleryComponent,
    ImageListComponent,
    // CartComponent,
    // CartItemComponent,
    LoginComponent,
    RegisterComponent,
    PageNotFoundComponent,
    // AccountComponent,
    // UpdateProfileComponent,
    // OrdersComponent,
    // SavedItemsComponent,
    // ChangePasswordComponent,
    // CheckoutComponent,
    UsermanagementComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    CommonModule,
    FormsModule,
    NgxPaginationModule,
    ReactiveFormsModule,
    HttpClientModule,
    AngularFireModule.initializeApp(environment.firebase),
    NgAisModule.forRoot(),
    Angular4PaystackModule.forRoot('pk_test_a20bdc9893a0202859761408baae4e082254f9fc'),
    NgxSpinnerModule,
    BrowserAnimationsModule,// required animations module
    ConnectionServiceModule,
    ToastrModule.forRoot({
      progressBar: true,
      timeOut: 1000
    }), ServiceWorkerModule.register('ngsw-worker.js', { enabled: environment.production }),
    // AngularFirestoreModule.enablePersistence()
  ],
  providers: [CurrencyPipe, NgbActiveModal, NgbModal],
  bootstrap: [AppComponent],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class AppModule { }
