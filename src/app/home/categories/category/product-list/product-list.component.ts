import { ProductService } from './../../../../service/product.service';
import { Component, OnInit } from '@angular/core';
import { Product } from 'src/app/models/product';
import { NgxSpinnerService } from "ngx-spinner";
import { ConnectionService } from 'ng-connection-service';
// import {ProductService} from 'src/app/service/product.service';
@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.css']
})
export class ProductListComponent implements OnInit {

  productList: Product[] = [];
  p = 1;
  connectionMsg = 'You are Offline';
  isConnected = true;
  noInternetConnection: boolean;

  constructor(
    private productService: ProductService,
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

    }

  ngOnInit(): void {
     /** spinner starts on init */

     if(this.isConnected){
        this.spinner.show();
     }else{
       this.spinner.hide();
     }


    this.productService.getProducts().subscribe((res) => {
        this.productList = res;
        console.log(res);
        this.spinner.hide();
    });
  }

}
