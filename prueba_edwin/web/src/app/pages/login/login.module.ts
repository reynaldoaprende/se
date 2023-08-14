import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { LoginRoutingModule } from './login-routing.module';
import { LoginComponent } from './login.component';
import { TopModule } from 'src/app/components/top/top.module';
import { PrincipalModule } from 'src/app/components/principal/principal.module';
import { TitleModule } from 'src/app/singles-components/title/title.module';
import { FormEnterModule } from 'src/app/components/form-enter/form-enter.module';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    FormEnterModule,
    TopModule,
    PrincipalModule,
    LoginRoutingModule,
    TitleModule
  ],
  declarations: [LoginComponent]
})
export class LoginModule {}
