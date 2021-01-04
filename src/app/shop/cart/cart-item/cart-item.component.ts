import { MessengerService } from './../../../service/messenger.service';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';

@Component({
  selector: 'app-cart-item',
  templateUrl: './cart-item.component.html',
  styleUrls: ['./cart-item.component.css']
})

export class CartItemComponent implements OnInit {
  qtyForm: FormGroup;
  @Input() cartItem: any;
  qty: number;
  subtotal;
  @Output() newQty = new EventEmitter<any>();
  @Output() cartItemRemoved = new EventEmitter<any>();
  q = [
    {id: 1, value: 1, selected: false},
    {id: 2, value: 2, selected: false},
    {id: 3, value: 3, selected: false},
    {id: 4, value: 4, selected: false},
    {id: 5, value: 5, selected: false},
    {id: 6, value: 6, selected: false},
    {id: 7, value: 7, selected: false},
    {id: 8, value: 8, selected: false},
    {id: 9, value: 9, selected: false},
    {id: 10, value: 10, selected: false}
  ];

  constructor(
    private builder: FormBuilder,
    private MsgService: MessengerService
  ) { }

  removeItem(cartItem): void{
    this.MsgService.removeItem(cartItem);
    this.cartItemRemoved.emit(true);
  }

  buildForm(): void{
    this.qtyForm = this.builder.group({
      quantity: this.cartItem.qty,
    });

  }



  changeQty(e): void{
    console.log(e);
    this.newQty.emit({prodId: this.cartItem.id, qty: e.target.value});
    this.qtyForm.value.quantity = e.target.value;
    this.calculateSubtotal(e.target.value);
  }

  calculateSubtotal(value?): void{
    if (value){
      this.subtotal = this.cartItem.price * value;
    } else {
      this.subtotal = this.cartItem.price * this.cartItem.qty;
    }

  }

  ngOnInit(): void {

    this.buildForm();
    this.calculateSubtotal();
  }

}
