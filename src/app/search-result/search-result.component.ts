// import { widgets } from 'instantsearch.js/es/connectors';

// import * as algoliasearch from 'algoliasearch/lite';
// import { environment } from './../../../environments/environment';
import { AfterViewInit, Component, HostListener, Input, OnInit, ViewEncapsulation } from '@angular/core';
// import algoliasearch from 'algoliasearch/lite';
// import instantsearch from 'instantsearch.js';
// import { searchBox, hits } from 'instantsearch.js/es/widgets';


// const searchClient = algoliasearch(
//   'B1G2GM9NG0',
//   'aadef574be1f9252bb48d4ea09b5cfe5'
// );


@Component({
  selector: 'app-search-result',
  templateUrl: './search-result.component.html',
  styleUrls: ['./search-result.component.css']
})

export class SearchResultComponent implements OnInit, AfterViewInit {


  //  search: any;


  // config: any = {
  //   indexName: 'test_products',
  //   searchClient: algoliasearch('NOK6B27L1T', '22c6e6783cb484e3c482b673f78e725d'),

  // };

  // filterDiv: HTMLElement;





  constructor() {

   }


  // getDiffBetweenTopAndBottom(ElTop: any, Elbottom: any): number{
  //     const result = ElTop.getBoundingClientRect().top - Elbottom.getBoundingClientRect().bottom;
  //     return result;
  // }




  //  @HostListener('window:scroll', ['$event']) onScrollEvent($event: any): void{


  //           const filterNav: any = document.querySelector('app-filter-navigation');
  //           const footer = document.querySelector('app-footer');
  //           const res = this.getDiffBetweenTopAndBottom(footer, filterNav);

  //           console.log(res);


  //           if ( res <= 0 ){
  //             filterNav.style.transform = "translateX(-100%)";
  //           }

  //           if (res > 0){
  //             filterNav.style.transform = "translateX(0)";
  //           }

  //       }






   ngAfterViewInit(): void {

   }



  ngOnInit(): void {


  }

}


