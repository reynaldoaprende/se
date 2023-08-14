import { Component, OnInit } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { DtoReport } from 'src/app/dto/dto-report';
import { ExcelService } from 'src/app/services/excel.service';
import { MainService } from 'src/app/services/main.service';
import { UsersService } from 'src/app/services/users.service';

@Component({
  selector: 'app-reports',
  templateUrl: './reports.component.html',
  styleUrls: ['./reports.component.scss']
})
export class ReportsComponent implements OnInit {
  public data:Array<DtoReport> = new Array<DtoReport>();
  public loading= false;
  constructor(public mainService:MainService, private userService:UsersService, private toastr:ToastrService, private excelService:ExcelService) { }

  ngOnInit(): void {
    this.list();
  }

  list(){
    this.loading = true;
    this.userService.report({}).subscribe((data:any)=>{
      if(data.success)this.data=data.data;
      this.loading = false;
    },error=>{
      this.loading = false;
    });
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
}
