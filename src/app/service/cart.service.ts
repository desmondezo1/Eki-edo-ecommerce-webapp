import { MessengerService } from './messenger.service';
import { AuthService } from './auth.service';
import { cartUrl, ordersUrl } from './../config/api';
import { HttpClient } from '@angular/common/http';
import { CartItem } from './../models/cart-item';
import { Injectable } from '@angular/core';
import { Observable, of, Subject } from 'rxjs';
import { map, single, switchMap } from 'rxjs/operators';
import { Product } from '../models/product';
import { AngularFireAuth } from '@angular/fire/auth';
import { AngularFirestore, AngularFirestoreCollection } from '@angular/fire/firestore';
import { User } from '../models/user';


@Injectable({
  providedIn: 'root'
})
export class CartService {

  userId;
  userCart;
  isLoggedIn;
  cartTotal = 0;
  cartForTotal;
  cartRef;
  test = [];
  cartCount;

  constructor(
    private http: HttpClient,
    private authService: AuthService,
    private auth: AngularFireAuth,
    private afs: AngularFirestore,
    private msgService: MessengerService
    ) {
      this.setUserCart()
      this.sendItemsToOrders();
      setTimeout(() => { this.sendItemsToOrders(); },2000)
      this.setLoginState();
    }





    // set the user's authentication state
    setLoginState(): void{
      this.authService.isLoggedIn.subscribe(res => {
        this.isLoggedIn = res;
      });
    }


    // set the user's cart in a variable
    setUserCart(): any{

      // this.cartForTotal = this.auth.authState.pipe(
      //   switchMap((user): any => {
      //     console.log('cartserv authstate', user);
      //     if (user){
      //       this.userId = user.uid;
      //       return this.afs.collection<any>(`users`).doc<any>(`${user.uid}`).collection('cart').valueChanges();
      //     } else {
      //       return of(null);
      //     }
      //    })
      //   );
      //   this.userCart = this.cartForTotal;



      this.userCart = this.auth.authState.pipe(
        switchMap((user): any => {
          console.log('cartserv authstate', user);
          if (user){
            this.userId = user.uid;
      //       // return this.afs.collection<any>(`users`).doc<any>(`${user.uid}`).collection('cart').valueChanges();
            return this.afs.collection<any>(`users`).doc<any>(`${user.uid}`).collection('cart').snapshotChanges().pipe(
               map(actions =>
                actions.map(a => {
                const data = a.payload.doc.data() as any;
                data.fid = a.payload.doc.id;
                this.test.push(data);
                return data;
                })

              )
            );
          } else {
            return of(null);
          }
        })
      );




    }



    // check if any object is empty
    isEmpty(obj): boolean {
        for (const key in obj) {
            if (obj.hasOwnProperty(key)) {
                return false;
            }
        }
        return true;
    }


    // Get the total amount (price * qty) of all products
    // from firestore cart
    getGrandTotal(): any{
      this.userCart.subscribe((a): any => {
        console.log('new g', a)
        if (!this.isEmpty(a)){
          a.forEach(r => {
            console.log('new g', (r.price * r.qty));
            this.cartTotal += ( +r.price * +r.qty);
            console.log(this.cartTotal);
         });
          return this.cartTotal;
        } else{
          this.cartTotal = 0;
        }
      });

    }


  getCartCount(): any{
      this.cartCount = 0;

      return this.userCart;
    //   const v = this.userCart.subscribe((a): any => {
    //     if (!this.isEmpty(a)){
    //       a.forEach(r => {
    //         this.cartCount += +r.qty;
    //       });
    //       console.log(this.cartCount);
    //       return this.cartCount;

    //     }else{
    //       return false;
    //     }
    // });
    //   return v;
  }


  // return data of the user's cart
  getUserCart(): any{
    console.log('get user cart', this.userCart);
    return this.userCart;
  }





  getCartItems(): Observable<CartItem[]>{
    /// Mapping the obtained value to our cartItems props.(pipe() and map())
    return this.http.get<CartItem[]>(cartUrl).pipe(
      map((result: any[]) => {
        let cartItems: CartItem[] = [];
        // let cartItems: any[] = [];
        for (let item of result){
           let productExists = false;
           for (let i in cartItems){
            if (cartItems[i].productId === item.product.id ){
              cartItems[i].qty++;
              productExists = true;
              break;
             }
           }
           if (!productExists){
             cartItems.push(new CartItem(item.id, item.product));
           }
        }
        return cartItems;
         })
      );
  }




  // add product to cart firebase or localstorage
  // depending on authentication state
  addProductToCart(product: Product): any{
      if (this.isLoggedIn){
        product.qty = 1;
        const cart = this.afs.collection<any>(`users`).doc<any>(this.userId).collection('cart');
        cart.add(product);
        // this.cartRef.add(product);

      }else{
        this.msgService.sendMsg(product);
      }
    // return this.http.post(cartUrl, { product });
  }


  // removes a single product from cart
    removeProductfromUserCart(product): void{

      if (this.isLoggedIn){

        const item = this.afs.collection<any>(`users`)
        .doc<any>(this.userId).collection('cart').doc<any>(product.fid);
        item.delete();
        // item.get().then((querySnapshot) => {
        //   querySnapshot.forEach((doc) => {
        //     doc.ref.delete();
        //   });
        // });
        // const cartRef = this.afs.collection<any>(`users`)
        // .doc<any>(this.userId).collection('cart', ref => ref.where('id', '==', product.id));

        // // const SingleProd = cartRef.get();
        // cartRef.doc<any>();

        // where('id', '==', product.id);
        // SingleProd.delete();
      }else{
        this.msgService.removeItem(product);
      }
      // const tutRef = db.doc('tutorial');
      // tutRef.delete();

    }

    updateItemQuantity(item){
      const Item = this.afs.collection<any>(`users`)
      .doc<any>(this.userId).collection('cart').doc<any>(item.fid).update({ qty: item.qty });
      item.then( console.log('updated!'));
    }

    addProductToSaved(product): void{
      console.log(this.userId);
      if (this.userId){
         this.afs.collection<any>('users').doc(this.userId).collection<any>('saved').add(product).then(
           () => console.log('added to saved')
         );
      }

    }

    sendItemsToOrders(){
      const url =  ordersUrl + this.userId;

      this.getUserCart().subscribe(
        products => {
          this.http.post<any>(url , products);
        });

    }





}
