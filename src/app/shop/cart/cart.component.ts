
import { AuthService } from './../../service/auth.service';
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

  cartTotal = 0;
  cartItems: any[] = [];
  isLoggedIn ;
  localstoredItems: any[];


  constructor(
    private MsgService: MessengerService,
    private cartService: CartService,
    private authService: AuthService,
    ) { }


    // changeQty(){
    //     this.qtyForm = this.builder.group({
    //       quantity: '',
    //     });
    // }

    updateQty(e): void{
      console.log(e.prodId);
      this.MsgService.updateQuatity(e.prodId, e.qty);
    }

    // getCartTotalPrice(product): void{
    //   product.forEach(r => {
    //     this.cartTotal = +r.price * +r.qty;
    //   });
    // }


    getCartTotalPrice(cartItems): void{
        cartItems.forEach(r => {
          this.cartTotal += ( +r.price * +r.qty);
        });

        // this.cartTotal = this.bf.reduce((a, b) => a + b, 0);
      }


    handleSubscription(): any{

      this.localstoredItems = JSON.parse(localStorage.getItem('user-cart'));
      console.log('Handle Sub', this.localstoredItems);
      console.log(this.isLoggedIn);
      if (this.isLoggedIn){
        // getCartData from server
        // this.loadCartItems();

      }else{
        console.log(this.localstoredItems);
        // if localstorage is empty get observable stream

        if (this.localstoredItems.length === 0){

          this.MsgService.getMsg().subscribe(
          (product: Product) => {
            this.showProductsInComponent(product);
          });

       }else{

        console.log(this.localstoredItems);
        this.showProductsInComponent(this.localstoredItems);

       }
      }
    }


    removeItemFromView(): void{
      // this.showProductsInComponent(this.localstoredItems);
      this.handleSubscription();
      this.cartTotal = this.MsgService.getCartTotal();
    }

    //

    showProductsInComponent(product: any): void {
        this.cartItems = product;
        console.log(this.cartItems);
        // this.getCartTotalPrice(product);
        this.cartTotal = this.MsgService.getCartTotal();
    }


    loadCartItems(): any{

      // Gets cart Items from server

      this.cartService.getCartItems().subscribe( (items: CartItem[]) => {
        console.log(items);
      });
    }



  ngOnInit(): void {
    // this.localstoredItems = JSON.parse(localStorage.getItem('user-cart'));
    this.authService.isLoggedIn.subscribe(a => this.isLoggedIn = a);
    this.handleSubscription();



    // this.loadCartItems();

  }






}
