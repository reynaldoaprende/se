import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SubtitleComponent } from './subtitle.component';

@NgModule({
  declarations: [SubtitleComponent],
  imports: [
    CommonModule
  ],
  exports: [SubtitleComponent]
})
export class SubtitleModule { }
