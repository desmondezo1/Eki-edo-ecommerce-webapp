import { Observable } from 'rxjs';
import { AuthService } from './../../service/auth.service';
// import { UserService } from './../../service/user.service';
import { Component, OnInit } from '@angular/core';
import { NgbAccordion } from '@ng-bootstrap/ng-bootstrap'

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
     private authService: AuthService
) { }




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

}

}
