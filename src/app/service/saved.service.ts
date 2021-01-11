import { Injectable } from '@angular/core';
import { AngularFireAuth } from '@angular/fire/auth';
import { AngularFirestore } from '@angular/fire/firestore';
import { of } from 'rxjs';
import { map, switchMap } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class SavedService {
  userId;
  userSaved;
  test = [];
  constructor(
    private auth: AngularFireAuth,
    private afs: AngularFirestore,
  ) {
    this.setSavedItems();
    console.log(this.userId);
   }


  setSavedItems(): any{
    this.userSaved = this.auth.authState.pipe(
          switchMap((user): any => {
            console.log('cartserv authstate', user);
            if (user){
              this.userId = user.uid;
        //       // return this.afs.collection<any>(`users`).doc<any>(`${user.uid}`).collection('cart').valueChanges();
              return this.afs.collection<any>(`users`).doc<any>(`${user.uid}`).collection('saved').snapshotChanges().pipe(
                 map(actions =>
                  actions.map(a => {
                  const data = a.payload.doc.data() as any;
                  data.fid = a.payload.doc.id;
                  // this.test.push(data);
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



      getSavedItems(){
        return this.userSaved;
      }

      removeSavedItem(item){
        const itm = this.afs.collection<any>(`users`)
        .doc<any>(this.userId).collection('saved').doc<any>(item.fid);
        itm.delete();
      }




  getUserStat(): any{
    // return  this.userId;
    console.log(this.userId);
  }



}
