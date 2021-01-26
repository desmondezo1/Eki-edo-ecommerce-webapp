
import { AuthService } from './../../service/auth.service';
import { Router } from '@angular/router';
import { FormBuilder, ReactiveFormsModule, FormGroup } from '@angular/forms';
import { Component, ElementRef, NgZone, OnInit, ViewChild } from '@angular/core';
import { AngularFireAuth } from '@angular/fire/auth';
import firebase from 'firebase/app';
import { ToastrService } from 'ngx-toastr';
import { MapsAPILoader } from '@agm/core';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  registerForm: FormGroup ;
  // lat = 51.678418;
  // lng = 7.809007;
  lat;
  lng;
  zoom = 1;
  private geoCoder;

  @ViewChild('search')
  public searchElementRef: any;

  constructor(
    private builder: FormBuilder,
    private authService: AuthService,
    private mapsAPILoader: MapsAPILoader,
    private ngZone: NgZone
    ) { }


    selectLocation(event){
      console.log(event);
    }

    // public mapReadyHandler(map: google.maps.Map): void {
    //   this.map = map;
    //   this.mapClickListener = this.map.addListener('click', (e: google.maps.MouseEvent) => {
    //     this.zone.run(() => {
    //       // Here we can get correct event
    //       console.log(e.latLng.lat(), e.latLng.lng());
    //     });
    //   });
    // }

    // public ngOnDestroy(): void {
    //   if (this.mapClickListener) {
    //     this.mapClickListener.remove();
    //   }
    // }


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

    this.getLocation();



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


  getLocation(): void{
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position)=>{
          const longitude = position.coords.longitude;
          const latitude = position.coords.latitude;
          // this.callApi(longitude, latitude);
          this.lat = latitude;
          this.lng = longitude;
          console.log('lon', longitude, 'lat', latitude);
        });
    } else {
       console.log("No support for geolocation")
    }
  }

  //   async UpdateProfile(displayName: string): Promise<any> {
  //     const profile = {
  //         displayName,
  //         photoURL: 'https://example.com/jane-q-user/profile.jpg'
  //     };
  //     return (await this.auth.currentUser).updateProfile(profile);
  // }



   createUser(): any{
      const {email, password} = this.registerForm.value;
      const {firstName, lastName, phone, address, state, city, newsPermission} = this.registerForm.value;
      this.authService.register(email, password, {email, firstName, lastName, phone, address, state, city, newsPermission});
    }



}
