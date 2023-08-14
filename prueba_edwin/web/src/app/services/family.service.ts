import { Injectable } from '@angular/core';
import { Family } from '../classes/family';
import { MainService } from './main.service';

@Injectable({
  providedIn: 'root'
})
export class FamilyService {

  constructor(private mainService:MainService) { }
  
  public store(data:Family){
    return this.mainService.post(`family/store`,data,true);
  }
  
  public list(){
    return this.mainService.get(`family/list`,true);
  }
  
  public remove(data:Family){
    return this.mainService.post(`family/remove`,data,true);
  }
}
