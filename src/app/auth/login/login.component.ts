import { AuthService } from './../../service/auth.service';
import { AngularFireAuth } from '@angular/fire/auth';
import { Component, OnInit } from '@angular/core';
import { NgForm, FormGroup, FormBuilder } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  constructor(
    private builder: FormBuilder,
    private authService: AuthService
  ) { }

  loginForm: FormGroup;

  login(): void{
    const {email, password} = this.loginForm.value;
    this.authService.login(email, password);
  }


  ngOnInit(): void {
    this.loginForm = this.builder.group({
      email: '',
      password: '',
      remember: ''

    });
  }

}

