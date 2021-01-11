import { SavedService } from './../../../service/saved.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-saved-items',
  templateUrl: './saved-items.component.html',
  styleUrls: ['./saved-items.component.css']
})
export class SavedItemsComponent implements OnInit {
  items;
  constructor(
    private savedService: SavedService
  ) { }

  ngOnInit(): void {
    this.savedService.getSavedItems().subscribe(a => {
        this.items = a;
        console.log(a);
      });
  }



  removeSavedItem(item){
    this.savedService.removeSavedItem(item);
  }
}
