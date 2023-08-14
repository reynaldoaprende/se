import { Injectable } from '@angular/core';
import { Affection } from '../classes/affection';
import { MainService } from './main.service';

@Injectable({
  providedIn: 'root'
})
export class AffectionService {

  constructor(private mainService:MainService) { }
  
  public store(data:Affection){
    return this.mainService.post(`affection/store`,data,true);
  }
  
  public detail(user_id:number){
    return this.mainService.get(`affection/detail/${(user_id!=null?user_id.toString():null)}`,true);
  }
}
