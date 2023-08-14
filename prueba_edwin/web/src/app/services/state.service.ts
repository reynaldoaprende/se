import { Injectable } from '@angular/core';
import { State } from '../classes/state';
import { MainService } from './main.service';
@Injectable({
  providedIn: 'root'
})
export class StateService {

  constructor(private mainService:MainService) { }
  
  public list(data:State){
    return this.mainService.post(`state/list`,data,true);
  }
}
