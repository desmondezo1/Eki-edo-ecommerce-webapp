import { Product } from 'src/app/models/product';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable, Subject } from 'rxjs';
import { stringify } from '@angular/compiler/src/util';
import { map } from 'rxjs/operators';
// import { lstat } from 'fs';
import { updateLanguageServiceSourceFile } from 'typescript';

@Injectable({
  providedIn: 'root'
})
export class MessengerService {

  product: Product[] = [];
  subject = new BehaviorSubject(this.product);


  constructor() { }




  sendMsg(product: Product): void {
    let present = false;
    // this.product.push(product);
    if (this.product.length > 0){

      // loop to check if already exists
        for (let i in this.product) {
          if (this.product[i].id === product.id) {
            present = true;
            this.product[i].qty = this.product[i].qty + 1;
          }
        }

        if(!present){
            this.product.push({
              id: product.id,
              title: Product.name,
              description: '',
              price: product.price,
              image: product.image,
              category: '',
              qty: 1,
            });

            console.log('if prod len  > 0', this.product);
            present = false;
          }

      // }

    }else {

          this.product.push({
            id: product.id,
            title: Product.name,
            description: '',
            price: product.price,
            image: product.image,
            category: '',
            qty: 1,
          });

          console.log('if prod len  !> 0', this.product)
    }

    // store cart data offline for unauhtenticated users

    this.subject.next(this.product);
    console.log('msg service cart', this.product);
    localStorage.setItem('user-cart' , JSON.stringify(this.product));

  }


  removeItem(cartitem): void{
    const localstoredItems = JSON.parse(localStorage.getItem('user-cart'));
    const newArray = localstoredItems.filter(item => item.id !== cartitem.id);
    localStorage.setItem('user-cart' , JSON.stringify(newArray));
    console.log('item new array', newArray);
    // window.location.reload();
  }



  updateQuatity(id, qty){
    // get from ls, filter find, then update, then storeback
    const data = JSON.parse(localStorage.getItem('user-cart'));
    let item = data.find(item => item.id === id);
    item.qty = qty;
    console.log('DATA', data);
    localStorage.setItem('user-cart', JSON.stringify(data));
  }


  getCartTotal(): number{
    const data = JSON.parse(localStorage.getItem('user-cart'));
    let cartTotal = 0;
    data.forEach(r => {
      cartTotal += ( +r.price * +r.qty);
    });
    return cartTotal;
  }





  getMsg(): Observable<any>{
    return this.subject.asObservable();
  }

}
