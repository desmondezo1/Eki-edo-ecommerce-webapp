import { UserService } from './../../service/user.service';
import { AngularFireAuth } from '@angular/fire/auth';
import { Component, OnInit, AfterViewInit, NgZone, ViewChild } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { AuthService } from 'src/app/service/auth.service';
import { tap } from 'rxjs/operators';
import { MapsAPILoader } from '@agm/core';

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
  lat;
  lng;
  zoom = 1;
  private geoCoder;

  @ViewChild('search')
  public searchElementRef: any;

  constructor(
    private builder: FormBuilder,
    private auth: AngularFireAuth,
    private authService: AuthService,
    private userService: UserService,
    private mapsAPILoader: MapsAPILoader,
    private ngZone: NgZone
    ) { }

    selected(event: any){
      console.log(event)
    }


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

    //load Places Autocomplete
    this.mapsAPILoader.load().then(() => {
      this.geoCoder = new google.maps.Geocoder;

      const autocomplete = new google.maps.places.Autocomplete(this.searchElementRef.nativeElement);
      autocomplete.addListener("place_changed", () => {
        this.ngZone.run(() => {
          //get the place result
          const place: google.maps.places.PlaceResult = autocomplete.getPlace();

          //verify result
          if (place.geometry === undefined || place.geometry === null) {
            return;
          }

          //set latitude, longitude and zoom
          this.lat = place.geometry.location.lat();
          this.lng = place.geometry.location.lng();
          this.zoom = 12;
        });
      });
     });



  }

  updateProfile(){
    this.userService.updateUser(this.uid, this.profileForm.value);
  }




}
