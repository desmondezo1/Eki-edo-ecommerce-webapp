import { ContactUsComponent } from './contact-us.component';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ContactUsRoutingModule } from './contact-us-routing.module';
import { AgmCoreModule } from '@agm/core';


@NgModule({
  declarations: [
    ContactUsComponent,
  ],
  imports: [
    CommonModule,
    ContactUsRoutingModule,
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyCVJvhmqDILKt3MsbrYlydH5LjQz4CSNbs',
    })
  ]
})
export class ContactUsModule { }
