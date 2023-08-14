import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { LinkComponent } from './link.component';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
  ],
  declarations: [LinkComponent],
  exports: [LinkComponent]
})
export class LinkModule {}
