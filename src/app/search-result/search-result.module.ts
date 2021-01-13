import { SearchResultComponent } from './search-result.component';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SearchResultRoutingModule } from './search-result-routing.module';
import { NgAisModule } from 'angular-instantsearch';


@NgModule({
  declarations: [
    SearchResultComponent
  ],
  imports: [
    CommonModule,
    SearchResultRoutingModule,
    NgAisModule.forRoot()
  ]
})
export class SearchResultModule { }
