import { Component, OnInit } from '@angular/core';
import {NgbModal, NgbDropdownConfig} from '@ng-bootstrap/ng-bootstrap';


@Component({
  selector: 'app-filter-navigation',
  templateUrl: './filter-navigation.component.html',
  styleUrls: ['./filter-navigation.component.css'],
  providers: [NgbDropdownConfig]
})
export class FilterNavigationComponent implements OnInit {

  constructor(private modalService: NgbModal, config: NgbDropdownConfig) {

    config.placement = 'top-left';
    config.autoClose = false;
   }

  

  openVerticallyCentered(content: any): void {
    this.modalService.open(content, { centered: true });
  }


  ngOnInit(): void {
  }

}
