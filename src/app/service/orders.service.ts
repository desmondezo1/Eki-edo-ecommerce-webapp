import { credentials } from './../config/api';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { AngularFireAuth } from '@angular/fire/auth';
import { AngularFirestore } from '@angular/fire/firestore';
import { of } from 'rxjs';
import { map, switchMap } from 'rxjs/operators';
import { orderApi } from '../config/api';


@Injectable({
  providedIn: 'root'
})
export class OrdersService {
  userOrders;
  userId;
  test = [];

  constructor(
    private auth: AngularFireAuth,
    private afs: AngularFirestore,
    private http: HttpClient,

  ) {
    this.setUserOrders();
   }



  setUserOrders(): any{
    this.userOrders = this.auth.authState.pipe(
          switchMap((user): any => {
            console.log('cartserv authstate', user);
            if (user){
              this.userId = user.uid;
        //       // return this.afs.collection<any>(`users`).doc<any>(`${user.uid}`).collection('cart').valueChanges();
              return this.afs.collection<any>(`users`).doc<any>(`${user.uid}`).collection('orders').snapshotChanges().pipe(
                 map(actions =>
                  actions.map(a => {
                  const data = a.payload.doc.data() as any;
                  data.fid = a.payload.doc.id;
                  // return this.test;
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

      createOrderOnWoocommerce(data){
        let httpheaders = new HttpHeaders({'content-type': 'application/json'});
        return this.http.post<any[]>(orderApi + '?' + credentials, data, {headers: httpheaders});
      }

      getUserOrders(){
        return this.userOrders;
      }
}
