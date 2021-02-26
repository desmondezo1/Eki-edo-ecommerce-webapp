import { Component, Input, OnInit } from '@angular/core';
import { ConnectionService } from 'ng-connection-service';
import { NgxSpinnerService } from 'ngx-spinner';
import { Product } from 'src/app/models/product';

@Component({
  selector: 'app-results',
  templateUrl: './results.component.html',
  styleUrls: ['./results.component.css']
})
export class ResultsComponent implements OnInit {

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
  }

}
