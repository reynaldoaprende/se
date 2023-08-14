import { Injectable } from '@angular/core';
import { MainService } from './main.service';

@Injectable({
  providedIn: 'root'
})
export class UsersService {

  constructor(private mainService:MainService) { }

  public init(data){
    return this.mainService.post("users/init",data,false);
  }

  public enter(data){
    return this.mainService.post("users/enter",data,false);
  }

  public list(){
    return this.mainService.get("users/list",true);
  }

  public confirmConsent(data){
    return this.mainService.post("users/confirmconsent",data,true);
  }

  public enabled(data){
    return this.mainService.post("users/enabled",data,true);
  }

  public detail(data){
    return this.mainService.post("users/detail",data,true);
  }

  public store(data){
    return this.mainService.post("users/store",data,true);
  }

  public report(data){
    return this.mainService.post("users/report",data,true);
  }

  public search(data){
    return this.mainService.post("users/search",data,true);
  }

  public find(data){
    return this.mainService.post("users/find",data,true);
  }

}
