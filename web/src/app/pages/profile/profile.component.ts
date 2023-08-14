import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { User } from 'src/app/classes/user';
import { UsersService } from 'src/app/services/users.service';
import { MainService } from 'src/app/services/main.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.scss']
})
export class ProfileComponent implements OnInit {
  public data:User = new User();
  public loading= false;
  constructor(private usersServices:UsersService, private router:Router, private mainService:MainService) { }

  ngOnInit(): void {
    this.detail();
  }

  detail(){
    this.loading = true;
    this.usersServices.detail(this.mainService.getUser()).subscribe(data=>{
      this.loading = false;
      if(data.success)this.data = data.data;
    },error=>{
      this.loading = false;
    })
  }

}
