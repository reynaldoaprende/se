import { Injectable } from '@angular/core';
import {  Router, CanLoad, Route, UrlSegment } from '@angular/router';
import { Observable } from 'rxjs';
import { MainService } from '../services/main.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanLoad {
  constructor(private mainService: MainService, private  router:Router){
  }
  canLoad(route: Route, segments: UrlSegment[]): boolean | Observable<boolean> | Promise<boolean> {  
    if(this.mainService.getToken())
      return true;
    else
      return false;
  }
  
}
