import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BigbannerComponent } from './bigbanner.component';

describe('BigbannerComponent', () => {
  let component: BigbannerComponent;
  let fixture: ComponentFixture<BigbannerComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BigbannerComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(BigbannerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
