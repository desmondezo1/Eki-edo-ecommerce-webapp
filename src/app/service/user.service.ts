import { Product } from './../models/product';
import { User } from './../models/user';
import { AngularFireAuth } from '@angular/fire/auth';
import { Injectable } from '@angular/core';
import { Subject, Observable } from 'rxjs';
import { AngularFirestore, AngularFirestoreCollection, AngularFirestoreDocument } from '@angular/fire/firestore';
import { ToastrService } from 'ngx-toastr';


@Injectable({
  providedIn: 'root'
})



export class UserService {

  private itemDoc: AngularFirestoreDocument<User>;
  private usersCollection: AngularFirestoreCollection<any>;
  private cartCollection: any;
  savedCollection;
  ordersCollection;

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
    private afs: AngularFirestore,
    private toastr: ToastrService,
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

    // this.cartCollection = this.afs.collection<any>('users').doc(uid).collection<any>('cart').add({});
    // this.savedCollection = this.afs.collection<any>('users').doc(uid).collection<any>('saved').add({});
    // this.ordersCollection = this.afs.collection<any>('users').doc(uid).collection<any>('orders').add({});
  }

  updateUser(uid, data){
    this.usersCollection.doc(uid).set(data, {merge: true}).then(
      ()=> this.toastr.success('Updated!')
    );
  }

  updateAddress(uid, data){
    this.usersCollection.doc(uid).update(data).then(
      ()=> this.toastr.success('Updated!')
    );
  }

  // createUserCart(uid, obj): void{
  //   // create a cart or adds to a cart
  //   this.afs.collection<any>('users').doc(uid).collection<any>('cart').add({});
  // }

  addItemtoSaved(){

  }


}
