import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-product-image-gallery',
  templateUrl: './product-image-gallery.component.html',
  styleUrls: ['./product-image-gallery.component.css']
})
export class ProductImageGalleryComponent implements OnInit {
    @Input() img: any;
  constructor() { }

  ngOnInit(): void {
  }

}
