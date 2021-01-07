import { Product } from './../models/product';
import { User } from './../models/user';
import { AngularFireAuth } from '@angular/fire/auth';
import { Injectable } from '@angular/core';
import { Subject, Observable } from 'rxjs';
import { AngularFirestore, AngularFirestoreCollection, AngularFirestoreDocument } from '@angular/fire/firestore';


@Injectable({
  providedIn: 'root'
})



export class UserService {

  private itemDoc: AngularFirestoreDocument<User>;
  private usersCollection: AngularFirestoreCollection<any>;
  private cartCollection: any;
  item: Observable<User>;
  items: Observable<any[]>;
  product = {
    id: '' ,
    title: '',
    price: '',
    image: '',
    description: '',
    categories: '',
  };
  constructor(
    private afs: AngularFirestore
  ){
    this.usersCollection = afs.collection<any>('users');

  }

  storeUser(uid, dataObj?: User): void{
    this.usersCollection.doc(uid).set(dataObj);
    // this.cartCollection.
    // this.cartCollection = this.afs.collection<any>(`users/${uid}`).collection<any>('cart').set();
    // this.cartCollection = this.afs.collection<any>('users').doc(uid).collection<any>('cart').add({
    //   id: '' ,
    //   title: '',
    //   price: '',
    //   image: '',
    //   description: '',
    //   categories: '',
    // });

    this.cartCollection = this.afs.collection<any>('users').doc(uid).collection<any>('cart').add({});
  }

  updateUser(){

  }


}
