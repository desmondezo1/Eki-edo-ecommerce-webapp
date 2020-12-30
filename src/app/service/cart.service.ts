import { cartUrl } from './../config/api';
import { HttpClient } from '@angular/common/http';
import { CartItem } from './../models/cart-item';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { Product } from '../models/product';


@Injectable({
  providedIn: 'root'
})
export class CartService {

  userId = 2;


  constructor(private http: HttpClient) { }

  getCartItems(): Observable<CartItem[]>{

    /// Mapping the obtained value to our cartItems props.(pipe() and map())
    return this.http.get<CartItem[]>(cartUrl).pipe(
      map((result: any[]) => {

        let cartItems: CartItem[] = [];
        // let cartItems: any[] = [];

        for (let item of result){
           let productExists = false;

           for (let i in cartItems){
            if(cartItems[i].productId === item.product.id ){
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

  addProductToCart(product: Product): Observable<any>{
    return this.http.post(cartUrl, { product });
  }



}
