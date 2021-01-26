import { ConnectionService } from 'ng-connection-service';
import { NgxSpinnerModule, NgxSpinnerService } from 'ngx-spinner';
import { FilterNavigationComponent } from './filter-navigation/filter-navigation.component';
import { SearchResultComponent } from './search-result.component';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SearchResultRoutingModule } from './search-result-routing.module';
// import { NgAisModule } from 'angular-instantsearch';
import { NgbDropdownConfig, NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ProductResultsComponent } from './product-results/product-results.component';
import { NgxPaginationModule } from 'ngx-pagination';
import { ProductItemComponent } from './product-results/product-item/product-item.component';
// import { FormControl } from '@angular/forms';
// import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/compiler';


@NgModule({
  declarations: [
    SearchResultComponent,
    FilterNavigationComponent,
    ProductResultsComponent,
    ProductItemComponent,
  ],
  imports: [
    CommonModule,
    NgxPaginationModule,
    // NgbModal,
    // NgbDropdownConfig,
    // NgModule,
    NgxSpinnerModule,
    SearchResultRoutingModule,
    // NgAisModule.forRoot()
  ],
  providers: [
    NgxSpinnerService,
    ConnectionService,
    // NgbModal
  ]
})
export class SearchResultModule { }
