import { AuthService } from './../../service/auth.service';
import { AngularFireAuth } from '@angular/fire/auth';
import { Component, OnInit } from '@angular/core';
import { NgForm, FormGroup, FormBuilder } from '@angular/forms';
import { Router } from '@angular/router';
import { NgbActiveModal, NgbModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  closeResult = '';
  constructor(
    private builder: FormBuilder,
    private authService: AuthService,
    public activeModal: NgbActiveModal,
    private modalService: NgbModal
  ) { }

  loginForm: FormGroup;
  resetPasswordForm: FormGroup;
  email;

  login(): void{
    const {email, password} = this.loginForm.value;
    this.authService.login(email, password);
  }

  resetPassword(): void {
    this.email = this.resetPasswordForm.value.email;
    if (!this.email) {
      alert('Type in your email first');
    }
    this.authService.resetPasswordInit(this.email)
    .then(
      () => alert('A password reset link has been sent to your email address'),
      (rejectionReason) => alert(rejectionReason))
    .catch(e => alert('An error occurred while attempting to reset your password'));
  }


  openModal(content): void {
    this.modalService.open(content, {ariaLabelledBy: 'modal-basic-title'}).result.then((result) => {
      this.closeResult = `Closed with: ${result}`;
    }, (reason) => {
      this.closeResult = `Dismissed `;
    });
  }


  ngOnInit(): void {
    this.loginForm = this.builder.group({
      email: '',
      password: '',
      remember: ''

    });

    this.resetPasswordForm = this.builder.group({
      email: ''
    });
  }

}

