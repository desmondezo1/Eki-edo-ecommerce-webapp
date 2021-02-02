import { FormBuilder } from '@angular/forms';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';


@Component({
  selector: 'app-searchbar',
  templateUrl: './searchbar.component.html',
  styleUrls: ['./searchbar.component.css']
})
export class SearchbarComponent implements OnInit {
  searchForm
  // search: any;


  // gotoSearchResults(){
  //     this.router.navigate(['search', 'q params']);
  // }

  search(){
    this.router.navigate(['search', this.searchForm.value.search]);
    // console.log()
  }


  constructor(
    public router: Router,
    private builder: FormBuilder,

    ) {

      this.searchForm = this.builder.group({
        search: ''
      });

    }

  ngOnInit(): void {

  }

}
