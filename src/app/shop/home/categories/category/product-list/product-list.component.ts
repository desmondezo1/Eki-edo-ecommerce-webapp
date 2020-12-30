import { ProductService } from './../../../../../service/product.service';
import { Component, OnInit } from '@angular/core';
import { Product } from 'src/app/models/product';
// import {ProductService} from 'src/app/service/product.service';
@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.css']
})
export class ProductListComponent implements OnInit {

  productList: Product[] = [];

  constructor(private productService: ProductService) { }

  ngOnInit(): void {

    this.productService.getProducts().subscribe((res) => {
        this.productList = res;
    });
  }

}
