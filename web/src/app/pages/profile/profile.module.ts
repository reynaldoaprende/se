import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { ProfileRoutingModule } from './profile-routing.module';
import { ProfileComponent } from './profile.component';
import { PrincipalModule } from 'src/app/components/principal/principal.module';
import { FormProfileModule } from 'src/app/components/form-profile/form-profile.module';
import { TopModule } from 'src/app/components/top/top.module';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    PrincipalModule,
    FormProfileModule,
    ProfileRoutingModule,
    TopModule
  ],
  declarations: [ProfileComponent]
})
export class ProfileModule {}
