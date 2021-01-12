import { SavedService } from './../../service/saved.service';
import { CartService } from './../../service/cart.service';
import { productUrl } from './../../config/api';
import { ProductService } from './../../service/product.service';
import { MessengerService } from './../../service/messenger.service';
import { Component, Input, OnInit } from '@angular/core';
import { Product } from 'src/app/models/product';
import { ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { NgxSpinnerService } from "ngx-spinner";
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-product-detail',
  templateUrl: './product-detail.component.html',
  styleUrls: ['./product-detail.component.css']
})
export class ProductDetailComponent implements OnInit {
  // product: Product;
  product: any;
  status;

  constructor(
    private MsgServ: MessengerService,
    private PrdService: ProductService,
    private route: ActivatedRoute,
    private http: HttpClient,
    private toastr: ToastrService,
    private cartService: CartService,
    private savedService: SavedService,
    private spinner: NgxSpinnerService
    ) {
      this.spinner.show();
    }

    // addToCart(): void{
    //   this.MsgServ.sendMsg(this.product);
    //   // this.MsgServ.sendMsg('message don send go');
    // }


    addToCart(): void {
      this.cartService.addProductToCart(this.product);
      this.toastr.success(`${this.product.title}`, 'Added to Cart');

      // .subscribe(
      // () => {
      //   this.MsgServ.sendMsg(this.product);
      // });

    }

    addToSavedItems(): void{
      this.cartService.addProductToSaved(this.product);
    }

    // getProductFromServer(id: number){
    //   return this.http.get<Product[]>(productUrl + id);
    // }

    getSingleProduct(id: number): any{


      return this.PrdService.getProductFromServer(id).subscribe(
        (res) => {
           this.product = res;

        setTimeout(() => {
          /** spinner ends after 5 seconds */
          this.spinner.hide();
        }, 500);
          //  this.spinner.hide();
        }
      );
      // https://fakestoreapi.com/products/1

    //   return this.PrdService.getProducts().subscribe(
    //    (res) => {
    //      this.product = res.find(product => product.id === id);
    //    }
    //  );
    }



  ngOnInit(): void {


    // this.toastr.success(`${this.product.title} added to cart `, 'Cart');
     this.getSingleProduct(
      // tslint:disable-next-line: no-string-literal
      +this.route.snapshot.params['id']
    );

    //  console.log(this.product);
      // this.addToCart();
    }

}
