import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { ModalModule } from 'src/app/singles-components/modal/modal.module';
import { TitleModule } from 'src/app/singles-components/title/title.module';
import { ButtonModule } from 'src/app/singles-components/button/button.module';
import { LabelModule } from 'src/app/singles-components/label/label.module';
import { ModalConfirmComponent } from './modal-confirm.component';

@NgModule({
  declarations: [ModalConfirmComponent],
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    ModalModule,
    TitleModule,
    ButtonModule
  ],
  exports: [ModalConfirmComponent]
})
export class ModalConfirmModule { }
