import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { FormFamilyComponent } from './form-family.component';
import { TitleModule } from 'src/app/singles-components/title/title.module';
import { LoadingModule } from '../loading/loading.module';
import { ButtonModule } from 'src/app/singles-components/button/button.module';
import { InputModule } from 'src/app/singles-components/input/input.module';
import { LabelModule } from 'src/app/singles-components/label/label.module';
import { SelectModule } from 'src/app/singles-components/select/select.module';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';


@NgModule({
  declarations: [FormFamilyComponent],
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    InputModule,
    ButtonModule,
    LoadingModule,
    TitleModule
  ],
  exports: [FormFamilyComponent]
})
export class FormFamilyModule { }
