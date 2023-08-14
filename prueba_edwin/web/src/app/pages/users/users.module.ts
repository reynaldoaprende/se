import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { LoadingModule } from 'src/app/components/loading/loading.module';
import { PrincipalModule } from 'src/app/components/principal/principal.module';
import { UsersRoutingModule } from './users-routing.module';
import { UsersComponent } from './users.component';
import { ModalConfirmModule } from 'src/app/components/modal-confirm/modal-confirm.module';
import { SelectModule } from 'src/app/singles-components/select/select.module';
import { ButtonModule } from 'src/app/singles-components/button/button.module';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    LoadingModule,
    PrincipalModule,
    UsersRoutingModule,
    ModalConfirmModule,
    ReactiveFormsModule,
    SelectModule,
    ButtonModule
  ],
  declarations: [UsersComponent]
})
export class UsersModule {}
