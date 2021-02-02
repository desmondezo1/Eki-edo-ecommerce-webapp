import { Component, Input, OnInit } from '@angular/core';
import { Product } from 'src/app/models/product';
import { NgxSpinnerService } from "ngx-spinner";
import { ConnectionService } from 'ng-connection-service';


@Component({
  selector: 'app-product-results',
  templateUrl: './product-results.component.html',
  styleUrls: ['./product-results.component.css']
})
export class ProductResultsComponent implements OnInit {
  @Input() products: Product[];

  p = 1;
  productList: Product[];
  
  isConnected = true;
  noInternetConnection: boolean;


  connectionMsg = 'You are Offline';
  constructor(
      private spinner: NgxSpinnerService,
      private connectionService: ConnectionService
      ) {

        this.connectionService.monitor().subscribe(isConnected => {
          this.isConnected = isConnected;
          if (this.isConnected) {
            this.noInternetConnection=false;
          }
          else {
            this.noInternetConnection=true;
            this.spinner.hide();
          }
        });

        this.products = this.productList;

      }

    ngOnInit(): void {
       /** spinner starts on init */

      //  if(this.isConnected){
      //     this.spinner.show();
      //  }else{
      //    this.spinner.hide();
      //  }
      // }
  }

}
