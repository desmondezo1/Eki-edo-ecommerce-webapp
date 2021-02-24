

import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import {NgbCarouselConfig} from '@ng-bootstrap/ng-bootstrap';



@Component({
  selector: 'app-carousel',
  templateUrl: './carousel.component.html',
  styleUrls: ['./carousel.component.css'],
   providers: [NgbCarouselConfig]
})
export class CarouselComponent implements OnInit {

  // url = 'http://admin.ekiedong.com/wp-content/uploads/slide31.jpg';
  showNavigationArrows = false;
  showNavigationIndicators = false;
  // images = [1055, 194, 368].map((n) => `https://picsum.photos/id/${n}/900/500`);

  images = ['http://admin.ekiedong.com/wp-content/uploads/slide31.jpg','http://admin.ekiedong.com/wp-content/uploads/slide2.jpg','http://admin.ekiedong.com/wp-content/uploads/slide3.jpg'];

  constructor(config: NgbCarouselConfig, private http: HttpClient) {
    // customize default values of carousels used by this component tree
    config.showNavigationArrows = true;
    config.showNavigationIndicators = true;
  }

  setDefaultImage(){
    console.log('error');
  }


  //  checkEachUrl(){
  //   this.images.forEach(url => {

  //     if(this.checkUrlifValid(url)){
  //       console.log(this.checkUrlifValid(url))
  //       console.log(true)
  //     }else{
  //       console.log(false);
  //     }
  //   //  fetch(url).then(res => {
  //   //    console.log('boie-> ',res.ok);
  //   //  });

    // });
  // }




  // checkUrlifValid(url): any{
  //   this.http.get(url).toPromise().then(a =>{ return true}).catch( error => { return false});

  // }



  ngOnInit():void{
    // this.checkUrlifValid();
    // this.checkEachUrl();
  }

}
