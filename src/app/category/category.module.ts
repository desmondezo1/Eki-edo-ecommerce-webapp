


import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CategoryRoutingModule } from './category-routing.module';
import { NgxPaginationModule } from 'ngx-pagination';
import { NgxSpinnerModule, NgxSpinnerService } from 'ngx-spinner';
import { ConnectionService } from 'ng-connection-service';

import { ResultsComponent } from './results/results.component';
import { ItemComponent } from './results/item/item.component';
import { CategoryComponent } from './category.component';

@NgModule({
  declarations: [
    ResultsComponent,
    CategoryComponent,
    ItemComponent
  ],
  imports: [
    CommonModule,
    CategoryRoutingModule,
    NgxPaginationModule,
    NgxSpinnerModule,
  ],
  providers: [
    NgxSpinnerService,
    ConnectionService,
  ]
})
export class CategoryModule { }
