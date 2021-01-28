import { wooProductUrl } from './../config/api';
import { Observable, throwError } from 'rxjs';
import { Injectable } from '@angular/core';
import {Product} from 'src/app/models/product';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { catchError, retry } from 'rxjs/operators';
import { Router } from '@angular/router';




@Injectable({
  providedIn: 'root'
})

export class ProductService {


  constructor(
    private http: HttpClient,
    private router: Router
    ) { }

  // populate product from Api here and return observable

  getProducts(): Observable<Product[]>{
    // return this.products;
    return this.http.get<Product[]>(wooProductUrl);
  }



  getProductFromServer(id: number): any{

    if (!id){
      this.router.navigate(['404']);
      return false;
    }
    return this.http.get<Product[]>(wooProductUrl + '/' + id)
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
