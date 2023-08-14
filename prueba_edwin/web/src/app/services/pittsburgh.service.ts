import { Injectable } from '@angular/core';
import { Pittsburgh } from '../classes/pittsburgh';
import { MainService } from './main.service';

@Injectable({
  providedIn: 'root'
})
export class PittsburghService {

  constructor(private mainService:MainService) { }
  
  public store(data:Pittsburgh){
    return this.mainService.post(`pittsburgh/store`,data,true);
  }
  
  public detail(user_id:number){
    return this.mainService.get(`pittsburgh/detail/${(user_id!=null?user_id.toString():null)}`,true);
  }
}
