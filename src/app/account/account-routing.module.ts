import { AccountComponent } from './account.component';
import { SavedItemsComponent } from './saved-items/saved-items.component';
import { UpdateProfileComponent } from './update-profile/update-profile.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { OrdersComponent } from './orders/orders.component';
import { ChangePasswordComponent } from './change-password/change-password.component';

const routes: Routes = [
  {path:'', redirectTo: 'profile/update', pathMatch: 'full'},
  {path: '', component: AccountComponent,
    children: [
      {path: '', component: UpdateProfileComponent},
      {path:'update', redirectTo: '', pathMatch: 'full'},
      {path: 'saved', component: SavedItemsComponent},
      {path: 'orders', component: OrdersComponent},
      {path: 'change-password', component: ChangePasswordComponent}
    ]

  },
  // {path: 'update', component: UpdateProfileComponent},
  // {path: 'saved', component: SavedItemsComponent},
  // {path: 'orders', component: OrdersComponent},
  // {path: 'change-password', component: ChangePasswordComponent}
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AccountRoutingModule { }
