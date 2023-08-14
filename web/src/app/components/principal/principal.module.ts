import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { PrincipalComponent } from './principal.component';
import { TopModule } from '../top/top.module';
import { LoadingModule } from '../loading/loading.module';


@NgModule({
  declarations: [PrincipalComponent],
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    TopModule,
    LoadingModule
  ],
  exports: [PrincipalComponent]
})
export class PrincipalModule { }

