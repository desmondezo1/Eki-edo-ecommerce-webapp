import { ProductImageGalleryComponent } from './product-image-gallery/product-image-gallery.component';
import { ProductDetailComponent } from './product-detail.component';
import { CUSTOM_ELEMENTS_SCHEMA, NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ProductDetailRoutingModule } from './product-detail-routing.module';
import { NgxSpinnerModule } from 'ngx-spinner';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';


@NgModule({
  declarations: [
    ProductDetailComponent,
    ProductImageGalleryComponent
  ],
  imports: [
    CommonModule,
    NgxSpinnerModule,
    NgbModule,
    ProductDetailRoutingModule
  ],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class ProductDetailModule { }
