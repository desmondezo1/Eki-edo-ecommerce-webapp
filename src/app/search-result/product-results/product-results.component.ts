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
  productList: Product[] = [
    {
      "id":11,
    "title":"Silicon Power 256GB SSD 3D NAND A55 SLC Cache Performance Boost SATA III 2.5",
    "price":109,
    "description":"3D NAND flash are applied to deliver high transfer speeds Remarkable transfer speeds that enable faster bootup and improved overall system performance. The advanced SLC Cache Technology allows performance boost and longer lifespan 7mm slim design suitable for Ultrabooks and Ultra-slim notebooks. Supports TRIM command, Garbage Collection technology, RAID, and ECC (Error Checking & Correction) to provide the optimized performance and enhanced reliability.",
    "category":"electronics",
      qty: 1,
    "image":"https://fakestoreapi.com/img/71kWymZ+c+L._AC_SX679_.jpg"
  },
  {
    "id":12,
  "title":"Silicon Power 256GB SSD 3D NAND A55 SLC Cache Performance Boost SATA III 2.5",
  "price":139,
  "description":"3D NAND flash are applied to deliver high transfer speeds Remarkable transfer speeds that enable faster bootup and improved overall system performance. The advanced SLC Cache Technology allows performance boost and longer lifespan 7mm slim design suitable for Ultrabooks and Ultra-slim notebooks. Supports TRIM command, Garbage Collection technology, RAID, and ECC (Error Checking & Correction) to provide the optimized performance and enhanced reliability.",
  "category":"electronics",
    qty: 1,
  "image":"https://fakestoreapi.com/img/71kWymZ+c+L._AC_SX679_.jpg"
}

  ];
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
