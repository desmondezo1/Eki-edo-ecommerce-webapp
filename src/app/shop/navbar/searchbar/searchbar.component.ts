import { environment } from './../../../../environments/environment';
import { Component, OnInit } from '@angular/core';
import algoliasearch from 'algoliasearch/lite';
import instantsearch from 'instantsearch.js';
import { searchBox, hits } from 'instantsearch.js/es/widgets'
import { Router } from '@angular/router';
// import * as algoliasearch from 'algoliasearch/lite';
// import * as instantsearch from 'instantsearch.js';
// import { instantsearch } from 'instantsearch.js';
// import { widgets } from 'instantsearch.js/es/connectors';

@Component({
  selector: 'app-searchbar',
  templateUrl: './searchbar.component.html',
  styleUrls: ['./searchbar.component.css']
})
export class SearchbarComponent implements OnInit {

  search: any;

  // config = {
  //   indexName: 'test_products',
  //   searchClient: algoliasearch('NOK6B27L1T', '22c6e6783cb484e3c482b673f78e725d'),
  //   routing: true
  // };

  gotosearch(){
      this.router.navigate(['search']);
  }



  constructor(public router: Router) { }

  ngOnInit(): void {
    // const options = environment.algolia;
    const config = {
      indexName: 'test_products',
      searchClient: algoliasearch('NOK6B27L1T', '22c6e6783cb484e3c482b673f78e725d'),
      routing: true
    };

    this.search = instantsearch(config);

    // this.search.addWidgets(
    //   instantSearch.widgets.configure({
    //     container: '#searchbox',
    //     autofocus: false,
    //     poweredBy: true
    //   })
    // );





    // this.search.addWidgets([
    //   instantsearch.widgets.searchBox({
    //     container: '#searchbox',
    //   }),

    //   instantsearch.widgets.hits({
    //     container: '#hits',
    //   })
    // ]);

    // this.search.addWidgets([
    //   searchBox({
    //     container: "#searchbox"
    //   }),

    //   hits({
    //     container: "#hits"
    //   })
    // ]);

    // this.search.addWidgets([
    //   // 2. Create an interactive search box
    //   instantsearch.widgets.searchBox({
    //     container: '#searchbox',
    //     placeholder: 'Search for products',
    //   }),

    //   // // 3. Plug the search results into the product container
    //   // instantsearch.widgets.hits({
    //   //   container: '#products',
    //   //   templates: {
    //   //     item: '{{#helpers.highlight}}{ "attribute": "name" }{{/helpers.highlight}}',
    //   //   },
    //   // }),

    //   // // 4. Make the brands refinable
    //   // instantsearch.widgets.refinementList({
    //   //   container: '#brand',
    //   //   attribute: 'brand',
    //   // }),
    // ]);

    this.search.start();
  }

}
