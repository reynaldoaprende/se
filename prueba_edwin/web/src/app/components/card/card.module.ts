import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { TopModule } from '../top/top.module';
import { CardComponent } from './card.component';


@NgModule({
  declarations: [CardComponent],
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    TopModule
  ],
  exports: [CardComponent]
})
export class CardModule { }

