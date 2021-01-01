import { AuthService } from './../../service/auth.service';
import { Router } from '@angular/router';
import { FormBuilder, ReactiveFormsModule, FormGroup } from '@angular/forms';
import { Component, OnInit } from '@angular/core';
import { AngularFireAuth } from '@angular/fire/auth';
import firebase from 'firebase/app';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  registerForm: FormGroup ;



  constructor(
    private builder: FormBuilder,
    private authService: AuthService
    ) { }


    register(): any{
        console.log(this.registerForm.value);
        this.createUser();
      }



  ngOnInit(): void {

    this.registerForm = this.builder.group({
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        password: '',
        city: '',
        address: '',
        newsPermission: '',
        state: ''

    });

  }

  //   async UpdateProfile(displayName: string): Promise<any> {
  //     const profile = {
  //         displayName,
  //         photoURL: 'https://example.com/jane-q-user/profile.jpg'
  //     };
  //     return (await this.auth.currentUser).updateProfile(profile);
  // }



   createUser(): any{
      // const fullname = this.registerForm.value.firstName + ' ' + this.registerForm.value.lastName;
      // const  phoneNumber = this.registerForm.value.phone;
      const {email, password} = this.registerForm.value;
      this.authService.register(email, password);
    }



}
