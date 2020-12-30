import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ShopComponent } from './shop/shop.component';
import { NavbarComponent } from './shop/navbar/navbar.component';
import { BigbannerComponent } from './shop/bigbanner/bigbanner.component';
import { CategoryComponent } from './shop/home/categories/category/category.component';
import { FooterComponent } from './shop/footer/footer.component';
import { HomebannerComponent } from './shop/home/homebanner/homebanner.component';
import { CategoriesComponent } from './shop/home/categories/categories.component';
import { HomeComponent } from './shop/home/home.component';
import { SearchbarComponent } from './shop/navbar/searchbar/searchbar.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { CarouselComponent } from './shop/home/homebanner/carousel/carousel.component';
import { ProductListComponent } from './shop/home/categories/category/product-list/product-list.component';
import { ProductComponent } from './shop/home/categories/category/product-list/product/product.component';
import { SearchResultComponent } from './shop/search-result/search-result.component';
import { ResultFilterComponent } from './shop/search-result/result-filter/result-filter.component';


import {FormsModule, ReactiveFormsModule } from '@angular/forms';
import { FilterNavigationComponent } from './shop/search-result/filter-navigation/filter-navigation.component';
import { ProductDetailComponent } from './shop/product-detail/product-detail.component';
import { ProductImageGalleryComponent } from './shop/product-detail/product-image-gallery/product-image-gallery.component';
import { ImageListComponent } from './shop/product-detail/product-image-gallery/image-list/image-list.component';
import { CartComponent } from './shop/cart/cart.component';
import { CartItemComponent } from './shop/cart/cart-item/cart-item.component';
import { CurrencyPipe } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { LoginComponent } from './auth/login/login.component';
import { RegisterComponent } from './auth/register/register.component';
import { PageNotFoundComponent } from './page-not-found/page-not-found.component';
@NgModule({
  declarations: [
    AppComponent,
    ShopComponent,
    NavbarComponent,
    BigbannerComponent,
    CategoryComponent,
    FooterComponent,
    HomebannerComponent,
    CategoriesComponent,
    HomeComponent,
    SearchbarComponent,
    CarouselComponent,
    ProductListComponent,
    ProductComponent,
    SearchResultComponent,
    ResultFilterComponent,
    FilterNavigationComponent,
    ProductDetailComponent,
    ProductImageGalleryComponent,
    ImageListComponent,
    CartComponent,
    CartItemComponent,
    LoginComponent,
    RegisterComponent,
    PageNotFoundComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  providers: [CurrencyPipe],
  bootstrap: [AppComponent]
})
export class AppModule { }
