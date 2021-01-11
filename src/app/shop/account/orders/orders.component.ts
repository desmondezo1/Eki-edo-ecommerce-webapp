import { OrdersService } from './../../../service/orders.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-orders',
  templateUrl: './orders.component.html',
  styleUrls: ['./orders.component.css']
})
export class OrdersComponent implements OnInit {
  orders;


  constructor(
    private ordersService: OrdersService
  ) { }

  ngOnInit(): void {
    this.ordersService.getUserOrders().subscribe(a => {
        this.orders = a;

      });
  }

}
