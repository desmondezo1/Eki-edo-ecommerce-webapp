import { Router } from '@angular/router';
// import { ProductResultsComponent } from './../search-result/product-results/product-results.component';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { NgxSpinnerService } from 'ngx-spinner';
import { ProductService } from '../service/product.service';


@Component({
  selector: 'app-category',
  templateUrl: './category.component.html',
  styleUrls: ['./category.component.css']
})
export class CategoryComponent implements OnInit {
  products: any[];
  categories: any[];
  constructor(
    private route:ActivatedRoute,
    private router: Router,
    private prdService: ProductService,
    private spinner: NgxSpinnerService
  ) { }

  getProductsInCategory(c: any): any{

    return this.prdService.listCategoryProducts(c).subscribe(
      (res) => {
         this.products = res;
        console.log(res);

      setTimeout(() => {
        /** spinner ends after 5 seconds */
        this.spinner.hide();
      }, 500);
        //  this.spinner.hide();
      }
    );

  }


  getCategoryProducts(id){
    this.router.navigate(['c', id]);
  }





  ngOnInit(): void {
    this.spinner.show();
    this.route.paramMap.subscribe(paramMap =>{
      let c = paramMap.get('c');
      this.getProductsInCategory(c);
    })


    this.prdService.getCategories().subscribe( a => {
          this.categories = a;
          console.log(a);
           })
  }

}
