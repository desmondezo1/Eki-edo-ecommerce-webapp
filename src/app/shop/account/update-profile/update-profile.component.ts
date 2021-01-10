import { UserService } from './../../../service/user.service';
import { AngularFireAuth } from '@angular/fire/auth';
import { Component, OnInit, AfterViewInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { AuthService } from 'src/app/service/auth.service';
import { tap } from 'rxjs/operators';

@Component({
  selector: 'app-update-profile',
  templateUrl: './update-profile.component.html',
  styleUrls: ['./update-profile.component.css']
})
export class UpdateProfileComponent implements OnInit {

  displayName: string;
  email: string;
  uid;
  phoneNumber: string;
  userData: any;
  profileForm: FormGroup;

  constructor(
    private builder: FormBuilder,
    private auth: AngularFireAuth,
    private authService: AuthService,
    private userService: UserService
    ) { }




  ngOnInit(): void {

    // console.log(this.authService.user$);


    this.auth.onAuthStateChanged(
      (User): any => {
        if (User){
          this.uid = User.uid;
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




    this.userData = this.authService.user$.subscribe(user => {
      this.profileForm.get('email').disable();
      this.profileForm.patchValue(user);
      console.log(user);
    });

  }

  updateProfile(){
    this.userService.updateUser(this.uid, this.profileForm.value);
  }




}
