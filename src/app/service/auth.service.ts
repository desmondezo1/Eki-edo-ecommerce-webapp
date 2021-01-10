import { AngularFirestore } from '@angular/fire/firestore';
import { UserService } from './user.service';
import { AngularFireAuth } from '@angular/fire/auth';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { BehaviorSubject, Observable, of } from 'rxjs';
import { switchMap } from 'rxjs/operators';

import { User } from '../models/user';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  user$: Observable<any>;

  private loggedIn = new BehaviorSubject<boolean>(false);

  constructor(
    private router: Router,
    private auth: AngularFireAuth,
    private usService: UserService,
    private afs: AngularFirestore
  ) {

    this.user$ = this.auth.authState.pipe(
      switchMap(user => {
        if (user){
          return this.afs.doc<User>(`users/${user.uid}`).valueChanges();
        } else {
          return of(false);
        }
      })
    );
  }

  get isLoggedIn(): Observable<any> {
    // return this.loggedIn.asObservable();
    return this.user$;
  }


  // ------- LOGIN SERVICE ----------

  login(email, password): any{
    this.auth.signInWithEmailAndPassword(email, password).then(
      user => {
        // console.log(user);
        this.loggedIn.next(true);
        this.router.navigate(['']);
      }
    );
  }



// --------------- REGISTER SERVICE ------------------

  register(email, password, dataObj?): any{
    this.auth.createUserWithEmailAndPassword(email, password).then((a) => {
      this.usService.storeUser(a.user.uid, dataObj);
      this.loggedIn.next(true);
      this.router.navigate(['/profile']);
    });

  }

  // ------------LOGOUT SERVICE -------------

  logout(): any {
    this.auth.signOut().then(
      () => {
        this.loggedIn.next(false);
        this.router.navigate(['login']);

    });
  }




  getUserData(){
    return this.user$;
  }


  /**
   * Initiate the password reset process for this user
   * @param email email of the user
   */
  resetPasswordInit(email: string): any {
    return this.auth.sendPasswordResetEmail(
      email,
      { url: 'http://localhost:4200/login' });
    }





}
