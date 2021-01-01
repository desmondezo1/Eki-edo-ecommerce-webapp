import { AngularFireAuth } from '@angular/fire/auth';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { BehaviorSubject, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private loggedIn = new BehaviorSubject<boolean>(false);

  constructor(
    private router: Router,
    private auth: AngularFireAuth
  ) { }

  get isLoggedIn(): Observable<any> {
    return this.loggedIn.asObservable();
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

  register(email, password): any{
    this.auth.createUserWithEmailAndPassword(email, password).then(() => {
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


}
