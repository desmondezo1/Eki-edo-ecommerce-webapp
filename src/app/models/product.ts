export class Product {

  id: number;
  title: string;
  description: string;
  price: number;
  image: string;
  category: string;
  qty: number;

  constructor(id: number, title: string = 'product', price: number, image: string, category: string, qty: number, description?: string){
    this.id = id;
    this.title = title;
    this.description = description;
    this.category = category;
    this.price = price;
    this.image = image;
    this.qty = qty;
  }
}
