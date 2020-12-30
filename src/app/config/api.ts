
import { environment } from './../../environments/environment';

export const baseUrl = environment.production ? '' : 'https://fakestoreapi.com';
export const productUrl = baseUrl + '/products';
export const cartUrl = baseUrl + '/carts';
