import { Injectable } from '@angular/core';
import { MainService } from './main.service';

@Injectable({
  providedIn: 'root'
})
export class DetailsService {

  constructor(private mainService:MainService) { }
  
  public detail(code:string){
    return this.mainService.get(`details/detail/${code}`,true);
  }
}
