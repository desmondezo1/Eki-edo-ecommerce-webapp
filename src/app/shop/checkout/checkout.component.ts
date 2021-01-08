import { FormGroup, FormBuilder } from '@angular/forms';
import { CartService } from './../../service/cart.service';
import { Component, OnInit } from '@angular/core';
import { PaystackOptions } from 'angular4-paystack';


@Component({
  selector: 'app-checkout',
  templateUrl: './checkout.component.html',
  styleUrls: ['./checkout.component.css']
})
export class CheckoutComponent implements OnInit {

  addressForm: FormGroup;
  reference = '';
  title;
  cartItems;
  totalPrice: any;

  options: PaystackOptions;

  constructor(
    private cartService: CartService,
    private builder: FormBuilder
  ) {
    this.addressForm = this.builder.group({
      fullName: 'Dr. Ojile',
      address: 'Faculty of Social Sciences, NDU, Amasoma Bayelsa, AMASSOMA, Bayelsa',
      phone: '+23408162099369',
      delivery_method: ''
    });
  }

  onFormSubmit(){
    console.log(this.addressForm.value);
  }

  editAddress(editbtn): void{
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

  }


  closeEditAddress(editbtn?: any): void{
    this.addressForm.get('fullName').disable();
    this.addressForm.get('phone').disable();
    this.addressForm.get('address').disable();
    this.addressForm.get('delivery_method').disable();
    editbtn.style.display = 'none';
    const formControl = document.querySelectorAll<HTMLElement>('.form-control');
    formControl.forEach((a: HTMLElement) => {
      a.style.border = 'none';
    });
    const edit = document.querySelector<HTMLElement>('.edit');
    edit.style.display = 'flex';
    const closeIt = document.querySelector<HTMLElement>('.closeIt');
    closeIt.style.display = 'none';

  }

  toggleClassOnHome(home, pickup): void{
    pickup.classList.remove('selected');
    home.classList.toggle('selected');
  }

  toggleClassOnPickup(pickup, home): void{
    home.classList.remove('selected');
    pickup.classList.toggle('selected');

  }

  paymentInit() {
    console.log('Payment initialized');
  }


  paymentDone(ref: any) {
    this.title = 'Payment successfull';
    console.log(this.title, ref);
  }

  paymentCancel() {
    console.log('payment failed');
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

  ngOnInit() {
    this.reference = `ref-${Math.ceil(Math.random() * 10e13)}`;

    console.log(this.cartService.getGrandTotal());

    this.cartService.userCart.subscribe( a  => {
      console.log('checkout', a)
      this.cartItems = a;

      if (!this.isEmpty(a)){
        this.totalPrice = 0;
        a.forEach(r => {
          console.log('new g', (r.price * r.qty));
          this.totalPrice += ( +r.price * +r.qty);
          console.log(Math.round(this.totalPrice));
       })
      }
      this.options = {
        amount: (Math.round(this.totalPrice) * 100),
        email: 'user@mail.com',
        ref: `${Math.ceil(Math.random() * 10e10)}`
      };
    });

      this.closeEditAddress();

    // this.cartService.getGrandTotal().subscribe(
    //   a => {
    //     localStorage.setItem('finaltotalPrice', JSON.stringify(a));
    //   }
    // )
  }

}
