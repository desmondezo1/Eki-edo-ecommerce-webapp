import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-change-password',
  templateUrl: './change-password.component.html',
  styleUrls: ['./change-password.component.css']
})
export class ChangePasswordComponent implements OnInit {


  changePasswordForm: FormGroup;
  constructor(private builder: FormBuilder) { }

  ngOnInit(): void {


    this.changePasswordForm = this.builder.group({

      password: ['', Validators.required],
      confirmPassword: ['', Validators.required],
    });
  }

}
