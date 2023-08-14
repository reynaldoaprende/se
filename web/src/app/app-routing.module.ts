import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from './guards/auth.guard';

const routes: Routes = [
  { path: '', redirectTo: 'login', pathMatch: 'full' },
  {
    path: 'login',
    loadChildren: () => import('./pages/login/login.module').then( m => m.LoginModule)
  },
  {
    path: 'reports',
    loadChildren: () => import('./pages/reports/reports.module').then( m => m.ReportsModule)
  },
  {
    path: 'home', canLoad:[AuthGuard],
    loadChildren: () => import('./pages/home/home.module').then( m => m.HomeModule)
  },
  {
    path: 'home/:time', canLoad:[AuthGuard],
    loadChildren: () => import('./pages/home/home.module').then( m => m.HomeModule)
  },
  {
    path: 'profile', canLoad:[AuthGuard],
    loadChildren: () => import('./pages/profile/profile.module').then( m => m.ProfileModule)
  },
  {
    path: 'users', canLoad:[AuthGuard],
    loadChildren: () => import('./pages/users/users.module').then( m => m.UsersModule)
  },
  {
    path: 'families', canLoad:[AuthGuard],
    loadChildren: () => import('./pages/families/families.module').then( m => m.FamiliesModule)
  },
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { } 