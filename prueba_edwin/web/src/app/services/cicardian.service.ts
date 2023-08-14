import { Injectable } from '@angular/core';
import { Cicardian } from '../classes/cicardian';
import { MainService } from './main.service';

@Injectable({
  providedIn: 'root'
})
export class CicardianService {

  constructor(private mainService:MainService) { }
  
  public store(data:Cicardian){
    return this.mainService.post(`cicardian/store`,data,true);
  }
  
  public detail(user_id:number){
    return this.mainService.get(`cicardian/detail/${(user_id!=null?user_id.toString():null)}`,true);
  }
}
