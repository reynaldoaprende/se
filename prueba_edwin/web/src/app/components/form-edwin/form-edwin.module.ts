import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { FormEdwinComponent } from './form-edwin.component';
import { TitleModule } from 'src/app/singles-components/title/title.module';
import { LoadingModule } from '../loading/loading.module';
import { ButtonModule } from 'src/app/singles-components/button/button.module';
import { InputModule } from 'src/app/singles-components/input/input.module';
import { LabelModule } from 'src/app/singles-components/label/label.module';
import { SelectModule } from 'src/app/singles-components/select/select.module';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';


@NgModule({
  declarations: [FormEdwinComponent],
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    InputModule,
    ButtonModule,
    LoadingModule,
    LabelModule,
    TitleModule,
    SelectModule
  ],
  exports: [FormEdwinComponent]
})
export class FormEdwinModule { }
