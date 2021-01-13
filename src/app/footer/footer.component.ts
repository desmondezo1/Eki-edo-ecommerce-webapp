import { Component, HostListener, Inject, OnInit } from '@angular/core';
import { DOCUMENT } from '@angular/common'

@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.css']
})
export class FooterComponent implements OnInit {

  year;
  today: Date;
  constructor(
    @Inject(DOCUMENT) private document: Document
  ) { }

  @HostListener('window:scroll', [])
  ngOnInit(): void {

    this.today = new Date();
    this.year = this.today.getFullYear();

  }

  scrollToTop(): any {
    (function smoothscroll(): void {

      const currentScroll = document.documentElement.scrollTop || document.body.scrollTop;

      if (currentScroll > 0) {
        window.requestAnimationFrame(smoothscroll);
        window.scrollTo(0, currentScroll - (currentScroll / 8));
      }

    })();
  }

}
