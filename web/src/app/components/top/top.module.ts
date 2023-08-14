import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TopComponent } from './top.component';
import { RouterModule } from '@angular/router';
import { ModalConsentModule } from '../modal-consent/modal-consent.module';

@NgModule({
  declarations: [TopComponent],
  imports: [
    CommonModule,
    RouterModule,
    ModalConsentModule
  ],
  exports:[TopComponent]
})
export class TopModule { }
