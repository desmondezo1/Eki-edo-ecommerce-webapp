
import { AuthService } from './../../service/auth.service';
import { CartItem } from './../../models/cart-item';
import { CartService } from './../../service/cart.service';
import { Product } from './../../models/product';
import { MessengerService } from './../../service/messenger.service';
import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { AngularFireAuth } from '@angular/fire/auth';
import { switchMap, map } from 'rxjs/operators';
import { Router } from '@angular/router';
import { NgxSpinnerService } from "ngx-spinner";

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
  fireStoreProd;
  cartCount;
  constructor(
    private MsgService: MessengerService,
    private cartService: CartService,
    private authService: AuthService,
    private auth: AngularFireAuth,
    private router: Router,
    private spinner: NgxSpinnerService
    ) {}



    // changeQty(){
    //     this.qtyForm = this.builder.group({
    //       quantity: '',
    //     });
    // }

    checkout(){
      this.router.navigate(['/checkout']);
    }

    updateQty(e): void{
      this.authService.user$.subscribe((a) => {
        console.log('a is', a);
        if(a){
          this.cartService.updateItemQuantity(e);
          this.handleSubscription(a);
        }else{
          this.MsgService.updateQuatity(e.prodId, e.qty);
        }
       });

      console.log(e.prodId);


      // if(){

      // }else{
      //   this.MsgService.updateQuatity(e.prodId, e.qty);
      // }
    }

    // getCartTotalPrice(product): void{
    //   product.forEach(r => {
    //     this.cartTotal = +r.price * +r.qty;
    //   });
    // }


    getCartTotalPrice(cartItems): any{
        cartItems.forEach(r => {
          this.cartTotal += ( +r.price * +r.qty);
        });
        return this.cartTotal;
        // this.cartTotal = this.bf.reduce((a, b) => a + b, 0);
      }


    handleSubscription(loginStat): any{
      console.log('Handle Sub', this.localstoredItems);
      console.log(this.isLoggedIn);
      // if (this.isLoggedIn){
      if (loginStat){
        console.log(this.isLoggedIn)
        // getCartData from server
        this.loadCartItemsFromFirestore();
          this.spinner.hide();

      }else{
        console.log(this.localstoredItems);
        // if localstorage is empty get observable stream
        this.loadCartItemsFromLocalStorage();
        this.spinner.hide();
      }
    }

    // this function reruns the carttotal calculation
    //  when an item is removed from cart in local storage
    removeItemFromView(): void{
      // this.showProductsInComponent(this.localstoredItems);
      // this.handleSubscription();
      // this.cartTotal = this.MsgService.getCartTotal();
    }



    // this displays the products in the view (html template)
    showProductsInComponent(product: any): void {
        this.cartItems = product;
        console.log(this.cartItems);
        // this.getCartTotalPrice(product);
    }

    // Gets cartItems from firestore server
    loadCartItemsFromFirestore(): any{

      console.log('test', this.cartService.test);
      this.cartService.getUserCart().subscribe(

        products => {
          console.log('prod from snapsht', products);
          this.showProductsInComponent(products);

          if (products) {
            let cal = 0;
            products.forEach(r => {
          //     // console.log('new g', (r.price * r.qty));
              // this.cartTotal += ( +r.price * +r.qty);
                cal += ( +r.price * +r.qty);
              // console.log(this.cartTotal);
            });

            localStorage.setItem('fireTotal' , JSON.stringify(cal));
            this.cartTotal = JSON.parse(localStorage.getItem('fireTotal'));
          }
        }
      );


      // this.cartTotal = this.cartService.getGrandTotal();
      // this.cartService.getGrandTotal().subscribe( a => {
      //   this.cartTotal = a;
      // });

      // console.log('total', this.cartTotal);

    }

    // gets items from local storage when user isnt logged in
    loadCartItemsFromLocalStorage(): any{
      this.localstoredItems = JSON.parse(localStorage.getItem('user-cart'));

      console.log('ie enta here', this.localstoredItems )
      if (this.localstoredItems.length === 0){
          this.MsgService.getMsg().subscribe(
          (product: Product) => {
            this.showProductsInComponent(product);
            this.cartTotal = this.MsgService.getCartTotal();
          });
     }else{
          console.log(this.localstoredItems);
          this.showProductsInComponent(this.localstoredItems);
          this.cartTotal = this.MsgService.getCartTotal();
     }
    }


    isEmpty(obj): boolean {
      for (const key in obj) {
          if (obj.hasOwnProperty(key)) {
              return false;
          }
      }
      return true;
    }

    calculateCartCountFromFirestore(): void{
      this.cartService.getCartCount().subscribe(a => {
        // this.cartCount = a;
        console.log(a);
        if (!this.cartService.isEmpty(a)){
            this.cartCount = 0;
            a.forEach(r => {
              this.cartCount += +r.qty;
            });
            console.log(this.cartCount);
            // return this.cartCount;
          }else{
            // return false;
            this.cartCount = 0;
          }
      });
    }


    calculateCartCountFromLocalstorage(): void{
      console.log('local store');
      this.MsgService.getCartCount().subscribe(a =>{
        this.cartCount = a;
        console.log('A --', a);
      });
    }



    getCartCount(loginStat): any{
      if (loginStat){
        console.log('Fire store')
        this.calculateCartCountFromFirestore();
      }else{
        console.log('local store')
        this.calculateCartCountFromLocalstorage();
      }
    }



  ngOnInit(): void {

    this.spinner.show();

    this.isLoggedIn =  this.authService.user$.subscribe((a) => {
      console.log('a is', a);
      this.handleSubscription(a);
      this.getCartCount(a);
      return a;

     });




    //  this.loadCartItemsFromFirestore();






    // this sets the users loggedin status
    // to allow other functions use firestore or local storage


    // this.authService.isLoggedIn.subscribe(a => {
    //   this.isLoggedIn = a;
    // });
    // this.auth.authState.pipe(
    //   switchMap((user): any => {
    //     if (user){
    //       // return true;
    //     this.isLoggedIn = true;

    //   } else {
    //     this.isLoggedIn = false;
    //    }
    //   })
    //     );



    // this.handleSubscription();


    //   this.authService.user$.subscribe((a) => {
    //   console.log('a is', a);
    //   this.isLoggedIn = a;
    //   if (a){
    //     // this.handleSubscription();
    //   }

    //  });



    // console.log( this.cartService.getUserCart());

    // this.loadCartItems();

  }







}
