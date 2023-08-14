import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { LabelComponent } from './label.component';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
  ],
  declarations: [LabelComponent],
  exports: [LabelComponent]
})
export class LabelModule {}
