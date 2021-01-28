import { environment } from './../../environments/environment';


// export const baseUrl = environment.production ? '' : 'https://fakestoreapi.com';
export const baseUrl = 'https://fakestoreapi.com';
export const productUrl = baseUrl + '/products';
export const cartUrl = baseUrl + '/carts';
export const ordersUrl = baseUrl + '/orders/?'


// WOOCOMMERCE APIS

export const wooBaseUrl = 'http://admin.local/wp-json/wc/v3';
export const wooProductUrl = baseUrl + '/products';

