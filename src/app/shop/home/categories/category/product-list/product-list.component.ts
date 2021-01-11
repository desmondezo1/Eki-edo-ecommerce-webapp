import { ProductService } from './../../../../../service/product.service';
import { Component, OnInit } from '@angular/core';
import { Product } from 'src/app/models/product';
import { NgxSpinnerService } from "ngx-spinner";
// import {ProductService} from 'src/app/service/product.service';
@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.css']
})
export class ProductListComponent implements OnInit {

  productList: Product[] = [];
  p = 1;


  constructor(
    private productService: ProductService,
    private spinner: NgxSpinnerService
    ) { }

  ngOnInit(): void {
     /** spinner starts on init */
     this.spinner.show();

    this.productService.getProducts().subscribe((res) => {
        this.productList = res;
        this.spinner.hide();
    });
  }

}
