import { ChangePasswordComponent } from './change-password/change-password.component';
import { OrdersComponent } from './orders/orders.component';
import { SavedItemsComponent } from './saved-items/saved-items.component';
import { UpdateProfileComponent } from './update-profile/update-profile.component';
import { AccountComponent } from './account.component';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AccountRoutingModule } from './account-routing.module';
import { NgbActiveModal, NgbModal, NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AgmCoreModule } from '@agm/core';


@NgModule({
  declarations: [
    OrdersComponent,
    AccountComponent,
    SavedItemsComponent,
    UpdateProfileComponent,
    ChangePasswordComponent
  ],
  imports: [
    CommonModule,
    NgbModule,
    FormsModule,
    ReactiveFormsModule,
    AccountRoutingModule,
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyCVJvhmqDILKt3MsbrYlydH5LjQz4CSNbs',
      libraries: ["places"],
    })
  ],
  providers:[
    NgbActiveModal,
    NgbModal
  ]
})
export class AccountModule { }
