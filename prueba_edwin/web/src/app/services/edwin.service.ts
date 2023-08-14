import { Injectable } from '@angular/core';
import { Edwin } from '../classes/edwin';
import { MainService } from './main.service';

@Injectable({
  providedIn: 'root'
})
export class EdwinService {

  constructor(private mainService:MainService) { }
  
  public store(data:Edwin){
    return this.mainService.post(`edwin/store`,data,true);
  }
  
  public detail(user_id:number){
    return this.mainService.get(`edwin/detail/${(user_id!=null?user_id.toString():null)}`,true);
  }
}
