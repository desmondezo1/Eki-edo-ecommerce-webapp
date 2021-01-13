import { AuthService } from './../service/auth.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-account',
  templateUrl: './account.component.html',
  styleUrls: ['./account.component.css']
})
export class AccountComponent implements OnInit {

  constructor(
    private authService: AuthService
  ) { }




  ngOnInit(): void {

  }


  logout(): any{
    this.authService.logout();
  }
}
