import { Injectable } from '@angular/core';
import { Demographic } from '../classes/demographic';
import { MainService } from './main.service';

@Injectable({
  providedIn: 'root'
})
export class DemographicsService {

  constructor(private mainService:MainService) { }
  
  public store(data:Demographic){
    return this.mainService.post(`demographics/store`,data,true);
  }
  
  public detail(user_id:number){
    return this.mainService.get(`demographics/detail/${(user_id?user_id.toString():null)}`,true);
  }
}
