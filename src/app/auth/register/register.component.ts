import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  form: any = {};

  register(){

    console.log(this.form);
  }

  constructor() { }

  ngOnInit(): void {
  }

}
