import { Injectable } from '@angular/core';
import { Unity } from '../classes/unity';
import { MainService } from './main.service';

@Injectable({
  providedIn: 'root'
})
export class UnityService {

  constructor(private mainService:MainService) { }
  
  public store(data:Unity){
    return this.mainService.post(`unity/store`,data,true);
  }
  
  public detail(user_id:number){
    return this.mainService.get(`unity/detail/${(user_id!=null?user_id.toString():null)}`,true);
  }
}
