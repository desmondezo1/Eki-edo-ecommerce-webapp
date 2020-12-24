import { Component, OnInit } from '@angular/core';
import { FormControl } from '@angular/forms';

@Component({
  selector: 'app-result-filter',
  templateUrl: './result-filter.component.html',
  styleUrls: ['./result-filter.component.css']
})
export class ResultFilterComponent implements OnInit {
  range1 = new FormControl();
  range2 = new FormControl();

  // price: any = this.ageControl.value;

  constructor() { }


  ngOnInit(): void {

  }

}
