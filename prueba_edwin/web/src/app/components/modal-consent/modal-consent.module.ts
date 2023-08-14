import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { TextareaModule } from 'src/app/singles-components/textarea/textarea.module';
import { InputModule } from 'src/app/singles-components/input/input.module';
import { ModalModule } from 'src/app/singles-components/modal/modal.module';
import { TitleModule } from 'src/app/singles-components/title/title.module';
import { ButtonModule } from 'src/app/singles-components/button/button.module';
import { SelectModule } from 'src/app/singles-components/select/select.module';
import { LabelModule } from 'src/app/singles-components/label/label.module';
import { ModalConsentComponent } from './modal-consent.component';

@NgModule({
  declarations: [ModalConsentComponent],
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    InputModule,
    TextareaModule,
    ModalModule,
    TitleModule,
    ButtonModule,
    SelectModule,
    LabelModule
  ],
  exports: [ModalConsentComponent]
})
export class ModalConsentModule { }
