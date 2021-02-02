// This file can be replaced during build by using the `fileReplacements` array.
// `ng build --prod` replaces `environment.ts` with `environment.prod.ts`.
// The list of file replacements can be found in `angular.json`.

export const environment = {
  production: false,
  firebase: {
    apiKey: 'AIzaSyDkGpP2jhAlNeMZs4Zadb0gax-TUbIgBNU',
    authDomain: 'eki-edo.firebaseapp.com',
    projectId: 'eki-edo',
    storageBucket: 'eki-edo.appspot.com',
    messagingSenderId: '756346159052',
    appId: '1:756346159052:web:35e2a66801478571e8e769',
    measurementId: 'G-V5W6YY6EJN'
  },

  algolia:{
    indexName: 'test_products',
    appId: 'NOK6B27L1T',
    apiKey: '22c6e6783cb484e3c482b673f78e725d',

  },
  // woocommerce: {
  //   consumer_key: 'ck_1c7d2c10e89682a8bc54de43477e22dd20217585',
  //   consumer_secret: 'cs_cdb76c3edf7acfc9c20f1c8bf3b20ce367b3c0f4'
  // }

  origin: 'https://admin.ekiedong.com',
    wcEndpoint: '/wp-json/wc/v3',
    woocommerce: {
      consumer_key:  'ck_1c7d2c10e89682a8bc54de43477e22dd20217585',
      consumer_secret: 'cs_cdb76c3edf7acfc9c20f1c8bf3b20ce367b3c0f4'
  }




};

/*
 * For easier debugging in development mode, you can import the following file
 * to ignore zone related error stack frames such as `zone.run`, `zoneDelegate.invokeTask`.
 *
 * This import should be commented out in production mode because it will have a negative impact
 * on performance if an error is thrown.
 */
// import 'zone.js/dist/zone-error';  // Included with Angular CLI.
