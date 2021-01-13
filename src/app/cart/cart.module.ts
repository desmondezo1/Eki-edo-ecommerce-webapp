
import { NgModule } from '@angular/core';
import { CommonModule, CurrencyPipe } from '@angular/common';

import { CartRoutingModule } from './cart-routing.module';
import { CartComponent } from './cart.component';
import { CartItemComponent } from './cart-item/cart-item.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';


@NgModule({
  declarations: [
    CartComponent,
    CartItemComponent
  ],
  imports: [
    CommonModule,
    CartRoutingModule,
    FormsModule,
    ReactiveFormsModule,
  ],
  providers: [
    CurrencyPipe
  ]
})
export class CartModule { }
