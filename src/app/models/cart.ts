import { CartItem } from './cart-item';


export class Cart {
id: number;
userId: number;
date: Date;
products: CartItem[];

constructor(id: number, userId: number, products: CartItem[]){
    this.id = id;
    this.date = new Date();
    this.products = products;

  }
}
