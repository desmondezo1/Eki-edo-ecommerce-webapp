import { environment } from './../../environments/environment.prod';
import { productsApi, categoriesApi, credentials, shippingZonesApi, getCategoryApi } from './../config/api';
import { Observable, throwError } from 'rxjs';
import { Injectable } from '@angular/core';
import {Product} from 'src/app/models/product';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { catchError, retry } from 'rxjs/operators';
import { Router } from '@angular/router';




@Injectable({
  providedIn: 'root'
})

export class ProductService {


  constructor(
    private http: HttpClient,
    private router: Router
    ) {


     }



  // populate product from Api here and return observable

  getProducts(): Observable<Product[]>{
    // // let url = 'https://admin.ekiedong.com/wp-json/wc/v3/products?consumer_key=ck_b89bbdbb55b1426f750447c1277b7a3ca5300df4&consumer_secret=cs_dadab0770bcfbbdc4e2f754112286bff9d9dc479';
    // let url = `${environment.origin}/${environment.wcEndpoint}`

    // let httpheaders = new HttpHeaders({
    //   // 'content-type': 'application/json',
    //   'ck_b89bbdbb55b1426f750447c1277b7a3ca5300df4':'cs_dadab0770bcfbbdc4e2f754112286bff9d9dc479'
    // });
    // let cat = this.http.get<any[]>(categoriesApi);
    // console.log(cat);

    return this.http.get<Product[]>(productsApi + '?' + credentials);
  }

  getCategories(){
    return this.http.get<Product[]>(categoriesApi + '?' + credentials);
  }


  getProductFromServer(id: number): any{

    if (!id){
      this.router.navigate(['404']);
      return false;
    }
    return this.http.get<Product[]>(productsApi + '/' + id + '?' + credentials)
    .pipe(
      retry(3), // retry a failed request up to 3 times
      catchError(this.handleError) // then handle the error
    );

  }

  getShippingZone(){
    // shippingZonesApi
    return this.http.get<Product[]>(shippingZonesApi + '?' + credentials)
    .pipe(
      retry(3), // retry a failed request up to 3 times
      catchError(this.handleError) // then handle the error
    );
  }

  getShippingMethods(id){
    return this.http.get<any[]>(shippingZonesApi + '/' + id + '/methods' +'?' + credentials)
    .pipe(
      retry(3), // retry a failed request up to 3 times
      catchError(this.handleError) // then handle the error
    );
  }

  getSingleShippingMethod(zoneid, methodid){
    return this.http.get<any[]>(shippingZonesApi + '/' + zoneid + '/methods/' + methodid +'?' + credentials).pipe(
      retry(3), // retry a failed request up to 3 times
      catchError(this.handleError) // then handle the error
    );
  }


  searchForProduct(q: string): any{
    if (!q){
      this.router.navigate(['']);
      return false;
    }

    return this.http.get<Product[]>(productsApi + '?search=' + q + '&' + credentials)
    .pipe(
      retry(3), // retry a failed request up to 3 times
      catchError(this.handleError) // then handle the error
    );

  }

  listCategoryProducts(c: string): any{
    if (!c){
      this.router.navigate(['']);
      return false;
    }

    return this.http.get<Product[]>(getCategoryApi + c + '&' + credentials)
    .pipe(
      retry(3), // retry a failed request up to 3 times
      catchError(this.handleError) // then handle the error
    );
  }






  private handleError(error: HttpErrorResponse): any {
    if (error.error instanceof ErrorEvent) {
      // A client-side or network error occurred. Handle it accordingly.
      console.error('An error occurred:', error.error.message);
    } else {
      // The backend returned an unsuccessful response code.
      // The response body may contain clues as to what went wrong.
      console.error(
        `Backend returned code ${error.status}, ` +
        `body was: ${error.error}`);
    }

    // Return an observable with a user-facing error message.
    return throwError(
      'Something bad happened; please try again later.');
  }

}
