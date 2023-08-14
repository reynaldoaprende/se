import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';
import { User } from 'src/app/classes/user';
import { UsersService } from 'src/app/services/users.service';
import { MainService } from 'src/app/services/main.service';
import { ToastrService } from 'ngx-toastr';
import { ExcelService } from 'src/app/services/excel.service';

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.scss']
})
export class UsersComponent implements OnInit {
  public data:Array<User> = new Array<User>();
  public loading= false;
  public activeConfirm=false;
  public row:User = new User();
  public modules = [];
  public headers = [];
  @ViewChild('table',null) table: ElementRef;
  constructor(private usersServices:UsersService, private excelService:ExcelService, private mainService:MainService,private toastr:ToastrService) { }

  ngOnInit(): void {
  }

  search(){
    if(!this.row.module_id||this.row.module_id==''){
      this.toastr.warning('Informe', "Selecciona primero un programa");
      return;
    }
    this.loading = true;
    this.usersServices.search(this.row).subscribe(data=>{
      this.loading = false;
      if(data.success){
        this.data = data.data;
        this.headers = data.headers;
      }
    },error=>{
      this.loading = false;
    })
  }

  confirmEvent(){
    this.loading = true;
    this.usersServices.enabled(this.row).subscribe(data=>{
      this.loading = false;
      if(data.success){
        this.data = data.data;
        this.search();
      }
    },error=>{
      this.loading = false;
    })
  }

  enabled(x){
    this.row = x;
    this.activeConfirm = true;
  }

  print_report(x) {
    if(!x["complete_report"])
   {
    this.toastr.warning('Informe', "No ha respondido los formularios correspondientes, no se puede ver el informe");
   }else{
     this.loading = true;
    this.usersServices.report(x).subscribe(data => {
      if (data.success) {
        this.toastr.success('Informe', data.message);
        var string = data.data;
        var iframe = "<iframe width='100%' height='100%' src='" + string + "'></iframe>"
        var a = window.open();
        a.document.open();
        a.document.write(iframe);
        a.document.close();
      } else {
        this.toastr.error('Informe', data.message);
      }
      this.loading = false;
    }, error => {
      this.loading = false;
    }, () => {
    });
   } 
  }

  exportAsXLSX() {
    if(!this.data.length)
      this.toastr.warning("El contenido esta vacio");
    else{
      this.toastr.success("Exportación realizada correctamente");
      let element = document.getElementById('excel-table'); 
      this.excelService.ExportTableToExcel(element, "Usuarios");
    }
  }

  findModule(e){
  }
  
}
