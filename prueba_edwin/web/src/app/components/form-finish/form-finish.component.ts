import { Component, OnInit, Output, EventEmitter, Input } from '@angular/core';
import { MainService } from 'src/app/services/main.service';
import { ToastrService } from 'ngx-toastr';
import { User } from 'src/app/classes/user';
import { Router } from '@angular/router';
import { UsersService } from 'src/app/services/users.service';
import { DtoReport } from 'src/app/dto/dto-report';

@Component({
  selector: 'app-form-finish',
  templateUrl: './form-finish.component.html',
  styleUrls: ['./form-finish.component.scss']
})
export class FormFinishComponent implements OnInit {
  @Output() loading = new EventEmitter();
  public report:DtoReport = new DtoReport();
  public listReport:Array<DtoReport> = new Array<DtoReport>();
  @Input() user_id: number = null;
  public isAdmin:boolean = false;
  constructor(public mainService:MainService,private toastr: ToastrService, private router:Router, private userService:UsersService) { }

  ngOnInit() {
    this.mainService.tokenValid().subscribe(data=>{
      if(localStorage.getItem("idUser"))this.user_id = Number(localStorage.getItem("idUser"));
      this.userService.report({user_id: (this.user_id?this.user_id:data.user.id)}).subscribe((data:any)=>{
        if(data.success){
          this.listReport=data.data;
          if(this.listReport.length)this.report = this.listReport[0];
        }
        this.isAdmin = data.isAdmin;
      },error=>{
  
      });
    },error=>{
    })
  }

  finish(){
    this.loading.emit(true);
    this.mainService.logout().subscribe(data=>{
      this.loading.emit(false);
      localStorage.clear();
      this.toastr.success("Cerrando sesión","")
      this.router.navigate(['/login']);
    },error=>{
      this.loading.emit(false);
    });
  }

  newRow(){
    var date = new Date();
    localStorage.removeItem("idUser");
    localStorage.removeItem("last_form_code");
    this.router.navigate(["/home/" + date.getTime().toString()]);
  }

}
