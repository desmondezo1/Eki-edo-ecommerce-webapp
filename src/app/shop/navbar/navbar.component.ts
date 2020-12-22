import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {

  constructor() { }

  clicked:boolean = false;

  clickEvn(): void{

    this.clicked = !this.clicked;
    const mobileMenu = document.querySelector('.menu-section');
    if ( mobileMenu ){
    mobileMenu.classList.toggle('active-menu');
    }

  }

  hamburger = document.querySelector('.hamburger');

  mainBody = document.querySelector('body');

  // hamburger.addEventListener('click',()=>{
  //         hamburger.classList.toggle('active');
  //         mobileMenu.classList.toggle('active-menu');
  //         if (mobileMenu.classList[1]=='active-menu' || mobileMenu.classList[0]=='active-menu') {
  //             mainBody.style.overflow="hidden";
  //         }else{
  //             mainBody.style.overflow="scroll";
  //         }

  // });

  ngOnInit(): void {
  }

}
