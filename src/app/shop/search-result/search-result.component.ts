import { AfterViewInit, Component, HostListener, Input, OnInit, ViewEncapsulation } from '@angular/core';


@Component({
  selector: 'app-search-result',
  templateUrl: './search-result.component.html',
  styleUrls: ['./search-result.component.css']
})

export class SearchResultComponent implements OnInit, AfterViewInit {

  // filterDiv: HTMLElement;

  constructor() { }


  getDiffBetweenTopAndBottom(ElTop: any, Elbottom: any): number{
      const result = ElTop.getBoundingClientRect().top - Elbottom.getBoundingClientRect().bottom;
      return result;
  }




   @HostListener('window:scroll', ['$event']) onScrollEvent($event: any): void{

            // const screenHeight = $event.path[1].screen.availHeight;
            // const scrollLocation = $event.path[1].scrollY;
            // console.log(scrollLocation);
            // console.log($event.path);
            // console.log(screenHeight);
            const filterNav: any = document.querySelector('app-filter-navigation');
            const footer = document.querySelector('app-footer');
            const res = this.getDiffBetweenTopAndBottom(footer, filterNav);

            console.log(res);


            if ( res <= 0 ){
              filterNav.style.transform = "translateX(-100%)";
            }

            if (res > 0){
              filterNav.style.transform = "translateX(0)";
            }




            // this.hideFilterNav('app-filter-navigation');
            // const Div = document.querySelector("app-footer");
            // console.log(Div.getBoundingClientRect());
            // console.log(Div.getBoundingClientRect());
        }


   ngAfterViewInit(): void {

   }



  ngOnInit(): void {
  }

}
