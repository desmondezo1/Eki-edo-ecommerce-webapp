import { Router } from '@angular/router';
import { ProductService } from './../../service/product.service';
import { Component, OnInit} from '@angular/core';
// import { NgbSlideEvent, NgbSlideEventSource } from '@ng-bootstrap/ng-bootstrap';


@Component({
  selector: 'app-homebanner',
  templateUrl: './homebanner.component.html',
  styleUrls: ['./homebanner.component.css']
})
export class HomebannerComponent implements OnInit {

  categories: any[];

  constructor(private prodservice: ProductService, private router: Router) { }

  getProductsInCategory(id){
    this.router.navigate(['c', id]);
  }

  ngOnInit(): void {
    this.prodservice.getCategories().subscribe( a => {
      this.categories = a;
      console.log(a);
       })

  }

}
