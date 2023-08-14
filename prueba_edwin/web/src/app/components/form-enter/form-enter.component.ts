import { Component, OnInit, Input, Output, EventEmitter, ViewChildren, ElementRef } from '@angular/core';
import { MainService } from 'src/app/services/main.service';
import { ToastrService } from 'ngx-toastr';
import { User } from 'src/app/classes/user';
import { Router } from '@angular/router';
import { UsersService } from 'src/app/services/users.service';
import { throwToolbarMixedModesError } from '@angular/material';

@Component({
  selector: 'app-form-enter',
  templateUrl: './form-enter.component.html',
  styleUrls: ['./form-enter.component.scss']
})
export class FormEnterComponent implements OnInit {
  public data = new User();
  @Output() loading = new EventEmitter();
  public message:string="";
  public check:boolean=null;
  public success:boolean=null;
  public exist:boolean=null;
  public admin:boolean=null;
  @ViewChildren('passwordControl') passwordControl: HTMLElement;

  constructor(private userService:UsersService,public mainService:MainService,private toastr: ToastrService, public router:Router) { 
  }

  ngOnInit() {
    this.mainService.tokenValid().subscribe(data=>{
      this.data = data.user;
      this.router.navigate(["/home"]);
    },error=>{
    })
  }

  enterSession(form){
    if(form&&!form.valid)return;
    this.loading.emit(true);
    this.userService.init(this.data).subscribe(data=>{
      this.success = data.success;
      this.check = true;
      this.admin = data.admin;
      this.message = data.message;
      this.loading.emit(false);
      // if(this.admin)this.passwordControl.nativeElement.focus();
    },error=>{
      this.loading.emit(false);
    });
  }
  
  cancelEnter(){
    this.check = false;
    this.success = false;
    this.exist = false;
    this.message = null;
    this.admin = null;
    this.data = new User();
  }

  goEnter(){
    this.loading.emit(true);
    if(!this.admin){

      this.userService.enter(this.data).subscribe(data=>{
        if(data.success){
          localStorage.clear();
          localStorage.setItem("user",JSON.stringify(data.user));
          localStorage.setItem("token",data.token);
          localStorage.setItem("messages",JSON.stringify(data.messages));
          localStorage.setItem("menu",JSON.stringify(data.menu));
          localStorage.setItem("consent",JSON.stringify(data.consent));
          localStorage.setItem("last_form_code",data.user.last_form_code);
          this.router.navigate(["/home"]);
          this.toastr.success(data.message, 'Iniciar sesión');
        }else{
          this.toastr.warning(data.message, 'Iniciar sesión');
        }
        this.loading.emit(false);
      },error=>{
        this.loading.emit(false);
      });
    }else{
      this.mainService.login(this.data).subscribe(data=>{
        if(data.success){
          localStorage.clear();
          localStorage.setItem("user",JSON.stringify(data.user));
          localStorage.setItem("token",data.token);
          localStorage.setItem("messages",JSON.stringify(data.messages));
          localStorage.setItem("menu",JSON.stringify(data.menu));
          localStorage.setItem("consent",JSON.stringify(data.consent));
          this.toastr.success(data.message, 'Iniciar sesión');
          this.router.navigate(['/home']);
        }else{
          this.toastr.show(data.message, 'Iniciar sesión',{timeOut: 9000},"prueba");
        }
        this.loading.emit(false);
      },error=>{
        this.loading.emit(false);
      });
    }
  }

}
