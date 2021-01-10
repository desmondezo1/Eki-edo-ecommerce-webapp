import { Observable } from 'rxjs';
import { AuthService } from './../../service/auth.service';
// import { UserService } from './../../service/user.service';
import { Component, OnInit } from '@angular/core';
import { NgbAccordion } from '@ng-bootstrap/ng-bootstrap'
import { CartService } from 'src/app/service/cart.service';
import { ThisReceiver } from '@angular/compiler';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {
 hamburger = document.querySelector('.hamburger');
 mainBody = document.querySelector('body');

 isLoggedIn$: Observable<boolean>;

constructor(
  // private userservice: UserService
     public authService: AuthService,
     private cartService: CartService
) { }



  cartCount;
  clicked = false;

  clickEvn(): void{

    this.clicked = !this.clicked;
    const mobileMenu = document.querySelector<HTMLElement>('.menu-section');
    const ham = document.querySelector<HTMLElement>('.hamburger-wrapper');
    const body = document.querySelector<HTMLElement>('body');



    if ( mobileMenu ){
      mobileMenu.classList.toggle('active-menu');
      body.classList.toggle('fixed');

      if (this.clicked){

        ham.style.padding = '13px';
        ham.style.justifyContent = 'flex-start';

      }else{

        ham.style.padding = '0';
        ham.style.justifyContent = 'center';

      }


    }

  }




  // hamburger.addEventListener('click',()=>{
  //         hamburger.classList.toggle('active');
  //         mobileMenu.classList.toggle('active-menu');
  //         if (mobileMenu.classList[1]=='active-menu' || mobileMenu.classList[0]=='active-menu') {
  //             mainBody.style.overflow="hidden";
  //         }else{
  //             mainBody.style.overflow="scroll";
  //         }

  // });

  logout(): any{
    this.authService.logout();
  }

  ngOnInit(): void {

     this.authService.isLoggedIn.subscribe(a =>{
        this.isLoggedIn$ =  a;
      });

    //  this.cartCount = this.cartService.getCartCount();
     console.log( this.cartService.getCartCount());
    //  this.cartService.getCartCount();
     this.cartService.getCartCount().subscribe(a => {
        // this.cartCount = a;
        console.log(a);

        if (!this.cartService.isEmpty(a)){
            this.cartCount = 0;
            a.forEach(r => {
              this.cartCount += +r.qty;
            });
            console.log(this.cartCount);
            // return this.cartCount;
          }else{
            // return false;
            this.cartCount = 0;
          }

      });

}

}
