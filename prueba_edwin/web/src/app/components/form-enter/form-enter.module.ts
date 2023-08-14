import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormEnterComponent } from './form-enter.component';
import { InputModule } from 'src/app/singles-components/input/input.module';
import { ButtonModule } from 'src/app/singles-components/button/button.module';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { SubtitleModule } from 'src/app/singles-components/subtitle/subtitle.module';

@NgModule({
  declarations: [FormEnterComponent],
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    InputModule,
    ButtonModule,
    SubtitleModule,
  ],
  exports: [FormEnterComponent]
})
export class FormEnterModule { }
