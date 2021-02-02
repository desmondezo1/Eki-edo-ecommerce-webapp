import { environment } from './../../environments/environment';

const consumerKey = 'consumer_key=ck_b89bbdbb55b1426f750447c1277b7a3ca5300df4';
const consumerSecret = 'consumer_secret=cs_dadab0770bcfbbdc4e2f754112286bff9d9dc479';

// export const baseUrl = environment.production ? '' : 'https://fakestoreapi.com';
export const baseUrl = 'https://fakestoreapi.com';
export const productUrl = baseUrl + '/products';
export const cartUrl = baseUrl + '/carts';
export const ordersUrl = baseUrl + '/orders/?'
export const wooBaseUrl = `${environment.origin}/${environment.wcEndpoint}`;
export const credentials = consumerKey + '&' + consumerSecret;
// WOOCOMMERCE APIS
export const productsApi = wooBaseUrl + '/products';
export const categoriesApi = wooBaseUrl + '/products/categories';
export const searchApi = wooBaseUrl + '/products?search=';
export const shippingZonesApi = wooBaseUrl + '/shipping/zones';
export const orderApi = wooBaseUrl + '/orders';
// /wp-json/wc/v3/shipping/zones/<zone_id>/methods/<id>
// https://admin.ekiedong.com/wp-json/wc/v3/shipping/zones

