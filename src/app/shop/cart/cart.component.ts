import { CartItem } from './../../models/cart-item';
import { CartService } from './../../service/cart.service';
import { Product } from './../../models/product';
import { MessengerService } from './../../service/messenger.service';
import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit {

  cartTotal: number;
  cartItems: any[] = [];


  constructor(
    private MsgService: MessengerService,
    private cartService: CartService
    ) { }


    // getCartTotalPrice(product): void{
    //   product.forEach(r => {
    //     this.cartTotal = +r.price * +r.qty;
    //   });
    // }


    getCartTotalPrice(cartItems): void{
        // // this.cartTotal = this.MsgService.getCartTotalPrice();
        cartItems.forEach(r => {
        //   this.bf.push(+r.price * +r.qty);
          this.cartTotal = +r.price * +r.qty;
        });

        // this.cartTotal = this.bf.reduce((a, b) => a + b, 0);
      }


    handleSubscription(): any{
      this.MsgService.getMsg().subscribe(
        (product: Product) => {
          this.showProductsInComponent(product);
          this.loadCartItems();
        });
    }

    //

    showProductsInComponent(product: any): void {

        this.cartItems = product;
        console.log(this.cartItems);
        this.getCartTotalPrice(product);

    }


    loadCartItems(): any{

      // Gets cart Items from server

      this.cartService.getCartItems().subscribe( (items: CartItem[]) => {
        console.log(items);
      });
    }



  ngOnInit(): void {
    this.handleSubscription();
    this.loadCartItems();

  }






}
