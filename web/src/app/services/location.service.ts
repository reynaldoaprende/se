import { Injectable } from '@angular/core';
import { Location } from '../classes/location';
import { MainService } from './main.service';
@Injectable({
  providedIn: 'root'
})
export class LocationService {

  constructor(private mainService:MainService) { }
  
  public list(data:Location){
    return this.mainService.post(`location/list`,data,true);
  }
}
