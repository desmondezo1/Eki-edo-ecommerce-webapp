
import { NgModule } from '@angular/core';
import { CommonModule, CurrencyPipe } from '@angular/common';

import { CheckoutRoutingModule } from './checkout-routing.module';
import { CheckoutComponent } from './checkout.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { NgxSpinnerModule } from 'ngx-spinner';
import { Angular4PaystackModule } from 'angular4-paystack';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { AgmCoreModule } from '@agm/core';

@NgModule({
  declarations: [
    CheckoutComponent
  ],
  imports: [
    CommonModule,
    CheckoutRoutingModule,
    FormsModule,
    NgbModule,
    NgxSpinnerModule,
    ReactiveFormsModule,
    Angular4PaystackModule.forRoot('pk_test_a20bdc9893a0202859761408baae4e082254f9fc'),
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyCVJvhmqDILKt3MsbrYlydH5LjQz4CSNbs',
      libraries: ["places"],
    })
  ],
  providers:[
    CurrencyPipe
  ]
})
export class CheckoutModule { }
