import { AngularFireAuth } from '@angular/fire/auth';
import { Component, Inject, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import * as firebase from 'firebase';
import { FirebaseApp } from '@angular/fire';




/**
*
* @param form
*/


function passwordMatch(form): void{
  const password = form.get('password');
  const oldPassword = form.get('oldPassword');
  const confirmPassword = form.get('confirmPassword');

  if (oldPassword === ''){
    oldPassword.setErrors({require: true});
  }else{
    oldPassword.setErrors(null);
  }

  if (password.value !== confirmPassword.value) {
    confirmPassword.setErrors({match: true});
  }
  else{
    confirmPassword.setErrors(null);
  }
}




function symbolValidator(control){
  console.log(control.value);
}
@Component({
  selector: 'app-change-password',
  templateUrl: './change-password.component.html',
  styleUrls: ['./change-password.component.css']
})

export class ChangePasswordComponent implements OnInit {

  cred;
  changePasswordForm: FormGroup;
  constructor(
    private builder: FormBuilder,
    private auth: AngularFireAuth,
    @Inject(FirebaseApp) private firebaseApp: any
    ) {

     }

  ngOnInit(): void {


    this.changePasswordForm = this.builder.group({
      oldPassword: '',
      password: ['', [Validators.required, symbolValidator, Validators.minLength(8)]],
      confirmPassword: '',
    }, {
      validators: passwordMatch
    });
  }


  async changePassword(): Promise<any>{


      // const user = await this.auth.currentUser;
      // const credentials = firebase.auth.EmailAuthProvider.credential(user.email, this.changePasswordForm.value.oldPassword);
      // user.reauthenticateWithCredential(credentials)
      // .then(() => console.log('reauth ok'));

      const User = await this.auth.currentUser;


      this.auth.authState.subscribe(usr => {
        const credential = {email: usr.email, password: this.changePasswordForm.value.oldPassword};
        this.auth.signInWithEmailAndPassword(credential.email, credential.password).then(() => {
          User.updatePassword(this.changePasswordForm.value.password).then(a => console.log('it update?', a));
        });

        console.log('cred:', this.cred, 'user: ', usr);

      });



  

      // User.reauthenticateWithCredential(credential).then(function() {
      //   // User re-authenticated.
      // }).catch(function(error) {
      //   // An error happened.
      // });

      // this.cred = this.auth.credential.subscribe(a => console.log(a));

      console.log(this.cred);
      // console.log(User);
      // this.auth.sign
      // this.auth.credential.subscribe(
      //   a => console.log(a)
      // );
      // console.log(this.auth.credential);
      // this.auth.signInAndRetrieveDataWithCredential(this.auth.credential)
      // User.updatePassword(this.changePasswordForm.value.password).then(() =>{
      //   console.log('Omo! ie work o');
      // });
      console.log(this.changePasswordForm.value.oldPassword);
    // updatePassword(newPassword).then(function() {
    //   // Update successful.
    // }).catch(function(error) {
    //   // An error happened.
    // });
  }

}
