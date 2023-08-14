import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { LoadingModule } from 'src/app/components/loading/loading.module';
import { ReportsRoutingModule } from './reports-routing.module';
import { ReportsComponent } from './reports.component';
import { PrincipalModule } from 'src/app/components/principal/principal.module';
import { FormDemographicModule } from 'src/app/components/form-demographic/form-demographic.module';
import { TopModule } from 'src/app/components/top/top.module';
import { TitleModule } from 'src/app/singles-components/title/title.module';
import { FormPittsburghModule } from 'src/app/components/form-pittsburgh/form-pittsburgh.module';
import { ButtonModule } from 'src/app/singles-components/button/button.module';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    LoadingModule,
    ReportsRoutingModule,
    FormDemographicModule,
    FormPittsburghModule,
    PrincipalModule,
    ButtonModule,
    TopModule,
    TitleModule
  ],
  declarations: [ReportsComponent]
})
export class ReportsModule {}
