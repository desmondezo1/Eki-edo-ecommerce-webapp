import { splitAtColon } from "@angular/compiler/src/util";

export class User {

  email: string;
  firstName: string;
  lastName: string;
  address: string;
  phone: string;
  state: string;
  city: string;
  newsPermission: boolean;

  constructor(email, firstName, lastName, phone, address, state, city, newsPermission){
    this.email = email;
    this.firstName = firstName;
    this.lastName = lastName;
    this.phone = phone;
    this.address = address;
    this.state = state;
    this.city = city;
    this.newsPermission = newsPermission;

  }

}
