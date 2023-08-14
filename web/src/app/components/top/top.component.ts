import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { MainService } from 'src/app/services/main.service';
import { ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';
import { User } from 'src/app/classes/user';
import { UsersService } from 'src/app/services/users.service';
import { Consent } from 'src/app/classes/consent';
import { Menu } from 'src/app/classes/menu';

@Component({
  selector: 'app-top',
  templateUrl: './top.component.html',
  styleUrls: ['./top.component.scss']
})
export class TopComponent implements OnInit {
  public valid;
  public data:User = new User();
  public active = false;
  public activeForm:boolean;
  public consent:Consent = new Consent();
  public role = null;
  public home = null;
  @Output() loading = new EventEmitter();
  public menu:Array<Menu> = new Array<Menu>();
  constructor(public mainService:MainService, private userService:UsersService,private toastr:ToastrService, private router:Router) { }

  ngOnInit() {
    if(localStorage.getItem("menu"))this.menu = JSON.parse(localStorage.getItem("menu"));
    this.valid=this.mainService.getUser()!=null;
    this.mainService.tokenValid().subscribe(data=>{
      this.data = data.user;
      if(!this.data.consent_id){
        if(localStorage.getItem("consent"))this.consent = JSON.parse(localStorage.getItem("consent"));
        this.active = true;
      }
    },error=>{
      this.valid = false;
      this.router.navigate(["/login"]);
      localStorage.clear();
    })
  }

  logout(){
    this.mainService.logout().subscribe(data=>{
      this.valid=false;
      localStorage.clear();
      this.toastr.success("Cerrando sesión","")
      this.router.navigate(['/login']);
    },error=>{
      this.valid=false;
    });
  }

  confirm(){
    this.loading.emit(true);
    this.userService.confirmConsent(this.consent).subscribe(data=>{
      this.active = false;
      this.data.consent_id = this.consent.id;
      this.data.consent_date = data.consent_date;
      localStorage.setItem("user",JSON.stringify(this.data));
      this.loading.emit(false);
    },error=>{
      this.loading.emit(false);
    })
  }

  goMenu(m:Menu){
    if(m.random_param){
      var date = new Date();
      localStorage.removeItem("idUser");
      localStorage.removeItem("last_form_code");
      this.router.navigate(["/" + m.route + "/" + date.getTime().toString()]);
    }else{
      this.router.navigate(["/" + m.route]);
    }
  }
}
