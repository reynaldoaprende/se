import { Injectable } from '@angular/core';
import { Violence } from '../classes/violence';
import { MainService } from './main.service';

@Injectable({
  providedIn: 'root'
})
export class ViolenceService {

  constructor(private mainService:MainService) { }
  
  public store(data:Violence){
    return this.mainService.post(`violence/store`,data,true);
  }
  
  public detail(user_id:number){
    return this.mainService.get(`violence/detail/${(user_id!=null?user_id.toString():null)}`,true);
  }
  
}
