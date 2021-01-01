import { AngularFireAuth } from '@angular/fire/auth';
import { Component, OnInit, AfterViewInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-update-profile',
  templateUrl: './update-profile.component.html',
  styleUrls: ['./update-profile.component.css']
})
export class UpdateProfileComponent implements OnInit {

  displayName: string;
  email: string;
  phoneNumber: string;
  userData: any;

  profileForm: FormGroup;
  constructor(
    private builder: FormBuilder,
    private auth: AngularFireAuth
    ) { }



  ngOnInit(): void {

    this.auth.onAuthStateChanged(
      (User): any => {
        if (User){
          console.log(User);
          console.log(this.profileForm.value);
          this.displayName = User.displayName;
          this.email = User.email;
          this.phoneNumber = User.phoneNumber;
        }
      }
    );

    this.profileForm = this.builder.group({

      firstName: ['' , Validators.required],
      lastName: [ '' , Validators.required],
      email: [ '' , [Validators.required, Validators.email]],
      phone: [ '' , Validators.required],
      state: ['', Validators.required],
      city: ['', Validators.required],
      address: ['', Validators.required],

    });




  }




}
