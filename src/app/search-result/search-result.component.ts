import { ProductService } from 'src/app/service/product.service';
import { ActivatedRoute } from '@angular/router';
// import { widgets } from 'instantsearch.js/es/connectors';

// import * as algoliasearch from 'algoliasearch/lite';
// import { environment } from './../../../environments/environment';
import { AfterViewInit, Component, HostListener, Input, OnInit, ViewEncapsulation } from '@angular/core';
import { NgxSpinnerService } from 'ngx-spinner';
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

  products: any[];

  constructor(
    private route:ActivatedRoute,
    private prdService: ProductService,
    private spinner: NgxSpinnerService
  ) {

   }



  searchProducts(q: any): any{


    return this.prdService.searchForProduct(q).subscribe(
      (res) => {
         this.products = res;
        //  console.log(res);

      setTimeout(() => {
        /** spinner ends after 5 seconds */
        this.spinner.hide();
      }, 500);
        //  this.spinner.hide();
      }
    );

  }



   ngAfterViewInit(): void {

   }



  ngOnInit(): void {
    this.spinner.show();

    this.searchProducts(this.route.snapshot.params['q']);

  }

}


