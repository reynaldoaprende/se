import { Injectable } from '@angular/core';
import { MainService } from './main.service';

@Injectable({
  providedIn: 'root'
})
export class MessagesServices {

  constructor(private mainService:MainService) { }
  
  public list(){
    return this.mainService.get(`messages/list`,true);
  }
}
