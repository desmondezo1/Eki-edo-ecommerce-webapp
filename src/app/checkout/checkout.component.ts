import { AngularFireAuth } from '@angular/fire/auth';
import { AuthService } from './../service/auth.service';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { CartService } from './../service/cart.service';
import { Component, NgZone, OnInit, ViewChild } from '@angular/core';
import { PaystackOptions } from 'angular4-paystack';
import { UserService } from 'src/app/service/user.service';
import { elementEventFullName } from '@angular/compiler/src/view_compiler/view_compiler';
import { Router } from '@angular/router';
import { NgxSpinnerService } from "ngx-spinner";
import { MapsAPILoader } from '@agm/core';

@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css']
})
export class CheckoutComponent implements OnInit {

  addressForm: FormGroup;
  reference = '';
  title;
  userData;
  cartItems;
  userId;
  totalPrice: any;
  lat;
  lng;
  zoom = 1;

  private geoCoder;

  @ViewChild('search')
  public searchElementRef: any;

  options: PaystackOptions;

  constructor(
    private cartService: CartService,
    private builder: FormBuilder,
    private authService: AuthService,
    private userService: UserService,
    private auth: AngularFireAuth,
    private router: Router,
    private spinner: NgxSpinnerService,
    private mapsAPILoader: MapsAPILoader,
    private ngZone: NgZone
  ) {


    this.addressForm = this.builder.group({
      fullName: '',
      address: ['', [Validators.required]],
      phone: ['', [Validators.required]],
      delivery_method: ''
    });

    this.auth.authState.subscribe( user => {
      this.userId = user.uid;
    });

    this.userData = this.authService.user$.subscribe(user => {
      const usr = {
        fullName : `${user.firstName} ${user.lastName}`,
        address: user.address,
        phone: user.phone
      };
      this.addressForm.patchValue(usr);
      console.log('usr ==', usr);
      console.log(user);
    });
  }

  onFormSubmit(): void{
    console.log(this.addressForm.value);
    this.updateUserAddress();
  }

  editAddress(editbtn: HTMLElement): void{
    this.addressForm.get('fullName').enable();
    this.addressForm.get('phone').enable();
    this.addressForm.get('address').enable();
    this.addressForm.get('delivery_method').enable();
    editbtn.style.display = 'flex';
    const formControl = document.querySelectorAll<HTMLElement>('.form-control');
    formControl.forEach((a: HTMLElement) => {
      a.style.border = '1px solid grey';
    });
    const edit = document.querySelector<HTMLElement>('.edit');
    edit.style.display = 'none';
    const closeIt = document.querySelector<HTMLElement>('.closeIt');
    closeIt.style.display = 'flex';
    const mapSpan = document.querySelector<HTMLElement>('#map');
    mapSpan.style.display = "flex";
  }


  closeEditAddress(editbtn?: HTMLElement): void{
    this.addressForm.get('fullName').disable();
    this.addressForm.get('phone').disable();
    this.addressForm.get('address').disable();
    this.addressForm.get('delivery_method').disable();
    if (editbtn){
      editbtn.style.display = 'none';
    }
    const formControl = document.querySelectorAll<HTMLElement>('.form-control');
    formControl.forEach((a: HTMLElement) => {
      a.style.border = 'none';
    });
    const edit = document.querySelector<HTMLElement>('.edit');
    edit.style.display = 'flex';
    const closeIt = document.querySelector<HTMLElement>('.closeIt');
    closeIt.style.display = 'none';
    const mapSpan = document.querySelector<HTMLElement>('#map');
    mapSpan.style.display = "none";
  }

  toggleClassOnHome(home, pickup): void{
    pickup.classList.remove('selected');
    home.classList.toggle('selected');
  }

  toggleClassOnPickup(pickup, home): void{
    home.classList.remove('selected');
    pickup.classList.toggle('selected');

  }

  paymentInit(): void {
    console.log('Payment initialized');
  }


  paymentDone(ref: any): void {
    this.title = 'Payment successfull';
    console.log(this.title, ref);
    this.cartService.sendItemsToOrders();
  }

  paymentCancel(): void {
    console.log('payment failed');
  }

  updateUserAddress(): void{
    let fullName = this.addressForm.value.fullName;
    const address = this.addressForm.value.address;
    const phone = this.addressForm.value.phone;
    fullName = fullName.split(' ');

    const data = {
      firstName: fullName[0],
      lastName:  fullName[1],
      address,
      phone
    };
    // this.userService.updateUser(this.userId, data);
    console.log(this.userId);
    this.userService.updateAddress(this.userId, data);
  }



  // check if any object is empty
  isEmpty(obj): boolean {
    for (const key in obj) {
        if (obj.hasOwnProperty(key)) {
            return false;
        }
    }
    return true;
  }






  ngOnInit(): void {
    this.spinner.show();

    this.cartService.getUserCart().subscribe(a => {
      if(a.length <= 0){
        this.router.navigate(['']);
      }
    });




    this.reference = `ref-${Math.ceil(Math.random() * 10e13)}`;

    console.log(this.cartService.getGrandTotal());

    this.cartService.userCart.subscribe( a  => {
      console.log('checkout', a)
      this.cartItems = a;

      if (!this.isEmpty(a)){
        this.totalPrice = 0;
        a.forEach(r => {
          if(r.discount_price){
            console.log('new g', (r.price * r.qty));
            this.totalPrice += ( +r.discount_price * +r.qty);
            console.log(Math.round(this.totalPrice));
          }else{
            console.log('new g', (r.price * r.qty));
            this.totalPrice += ( +r.price * +r.qty);
            console.log(Math.round(this.totalPrice));
          }

       });
      }
      this.options = {
        amount: (Math.round(this.totalPrice) * 100),
        email: 'user@mail.com',
        ref: `${Math.ceil(Math.random() * 10e10)}`
      };

      this.spinner.hide();
    });

    this.closeEditAddress();


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


    // this.cartService.getGrandTotal().subscribe(
    //   a => {
    //     localStorage.setItem('finaltotalPrice', JSON.stringify(a));
    //   }
    // )
  }

}
