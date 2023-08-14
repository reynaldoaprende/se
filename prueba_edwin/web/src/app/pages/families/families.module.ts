import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { LoadingModule } from 'src/app/components/loading/loading.module';
import { FamiliesRoutingModule } from './families-routing.module';
import { FamiliesComponent } from './families.component';
import { PrincipalModule } from 'src/app/components/principal/principal.module';
import { FormDemographicModule } from 'src/app/components/form-demographic/form-demographic.module';
import { TopModule } from 'src/app/components/top/top.module';
import { TitleModule } from 'src/app/singles-components/title/title.module';
import { FormPittsburghModule } from 'src/app/components/form-pittsburgh/form-pittsburgh.module';
import { ButtonModule } from 'src/app/singles-components/button/button.module';
import { FormFamilyModule } from 'src/app/components/form-family/form-family.module';
import { ModalModule } from 'src/app/singles-components/modal/modal.module';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    LoadingModule,
    FamiliesRoutingModule,
    PrincipalModule,
    ButtonModule,
    TopModule,
    TitleModule,
    FormFamilyModule,
    ModalModule
  ],
  declarations: [FamiliesComponent]
})
export class FamiliesModule {}
