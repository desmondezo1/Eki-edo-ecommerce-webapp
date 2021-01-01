import { AngularFireAuth } from '@angular/fire/auth';
import { Injectable } from '@angular/core';
import { Subject, Observable } from 'rxjs';


@Injectable({
  providedIn: 'root'
})


export class UserService {

  // userSubject = new Subject();


  // user = this.auth.currentUser;
  // constructor(private auth: AngularFireAuth) { }

  // getFullname(): Observable<any>{
  //   const userObj: any = {};
  //   this.auth.onAuthStateChanged(
  //     user => {
  //       userObj.fullname = user.displayName;
  //     }
  //   );

  //   this.userSubject.next(userObj);

  //   return this.userSubject.asObservable();
  // }
}
