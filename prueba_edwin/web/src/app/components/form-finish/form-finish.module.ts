import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { InputModule } from 'src/app/singles-components/input/input.module';
import { ButtonModule } from 'src/app/singles-components/button/button.module';
import { TitleModule } from 'src/app/singles-components/title/title.module';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { FormFinishComponent } from './form-finish.component';
import { SubtitleModule } from 'src/app/singles-components/subtitle/subtitle.module';

@NgModule({
  declarations: [FormFinishComponent],
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    InputModule,
    ButtonModule,
    TitleModule,
    SubtitleModule
  ],
  exports: [FormFinishComponent]
})
export class FormFinishModule { }
