import { Product } from 'src/app/models/product';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable, Subject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class MessengerService {

  product: Product[] = [];
  subject = new BehaviorSubject(this.product);


  constructor() { }




  sendMsg(product: Product): void {
    // this.product.push(product);

    this.product.push({
          id: product.id,
          title: Product.name,
          description: '',
          price: product.price,
          image: product.image,
          category: '',
          qty: 1,
        });
    this.subject.next(this.product);


  }



  getMsg(): Observable<any>{
    return this.subject.asObservable();
  }

}
