import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AmbienteComponent } from './ambiente.component';

describe('AmbienteComponent', () => {
  let component: AmbienteComponent;
  let fixture: ComponentFixture<AmbienteComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [AmbienteComponent]
    });
    fixture = TestBed.createComponent(AmbienteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
