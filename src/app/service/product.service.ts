import { productUrl } from './../config/api';
import { Observable } from 'rxjs';
import { Injectable } from '@angular/core';
import {Product} from 'src/app/models/product';
import { HttpClient } from '@angular/common/http';




@Injectable({
  providedIn: 'root'
})

export class ProductService {


  constructor(private http: HttpClient) { }

  // populate product from Api here and return observable

  getProducts(): Observable<Product[]>{
    // return this.products;
    return this.http.get<Product[]>(productUrl);
  }



  getProductFromServer(id: number): any{
    return this.http.get<Product[]>(productUrl + '/' + id);
  }

}
