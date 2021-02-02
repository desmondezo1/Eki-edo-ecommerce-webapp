import { OrdersService } from './../../service/orders.service';
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
      console.log(a);

      let nArr: any[] = []

      for (let index = 0; index < a.length; index++) {
        let prod = a[index].products;
          for (let index = 0; index < prod.length; index++) {

            nArr.push({
              'id': prod[index].id,
              'name': prod[index].name,
              'price': prod[index].price,
              'product_id': prod[index].product_id,
              'quantity': prod[index].quantity,
              'purchase_date': prod[index].purchase_date,
            });
          }
      }



        this.orders = nArr;
        console.log({nArr});

      });


  }

}
