import { Injectable } from '@angular/core';
import { MainService } from './main.service';
@Injectable({
  providedIn: 'root'
})
export class CountryService {

  constructor(private mainService:MainService) { }

  public list(){
    return this.mainService.get(`country/list`,true);
  }
}
