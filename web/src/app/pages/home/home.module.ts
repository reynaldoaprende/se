import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { LoadingModule } from 'src/app/components/loading/loading.module';
import { HomeRoutingModule } from './home-routing.module';
import { HomeComponent } from './home.component';
import { PrincipalModule } from 'src/app/components/principal/principal.module';
import { FormDemographicModule } from 'src/app/components/form-demographic/form-demographic.module';
import { TopModule } from 'src/app/components/top/top.module';
import { TitleModule } from 'src/app/singles-components/title/title.module';
import { FormPittsburghModule } from 'src/app/components/form-pittsburgh/form-pittsburgh.module';
import { FormFinishModule } from 'src/app/components/form-finish/form-finish.module';
import { FormUnityModule } from 'src/app/components/form-unity/form-unity.module';
import { FormCicardianModule } from 'src/app/components/form-cicardian/form-cicardian.module';
import { FormAffectionModule } from 'src/app/components/form-affection/form-affection.module';
import { FormViolenceModule } from 'src/app/components/form-violence/form-violence.module';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    LoadingModule,
    HomeRoutingModule,
    FormDemographicModule,
    FormPittsburghModule,
    FormFinishModule,
    FormUnityModule,
    FormCicardianModule,
    FormAffectionModule,
    FormViolenceModule,
    PrincipalModule,
    TopModule,
    TitleModule
  ],
  declarations: [HomeComponent]
})
export class HomeModule {}
