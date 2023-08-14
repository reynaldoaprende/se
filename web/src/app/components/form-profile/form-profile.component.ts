import { Component, OnInit, Input, Output, EventEmitter, ViewChild } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';
import { MainService } from 'src/app/services/main.service';
import { User } from 'src/app/classes/user';
import { NgForm } from '@angular/forms';
import { UsersService } from 'src/app/services/users.service';

@Component({
  selector: 'app-form-profile',
  templateUrl: './form-profile.component.html',
  styleUrls: ['./form-profile.component.scss']
})
export class FormProfileComponent implements OnInit {
  @Input() data = new User();
  public loading=false;
  public documents_types = [];
  public genders = [];
  constructor(public mainService:MainService, private usersService:UsersService,private toastr: ToastrService, public router:Router) { }

  ngOnInit() {
  }

  store(form:NgForm){
    // Muestra mensaje de error en los campos que son obligatorios
    if (form.invalid) {
      Object.values(form.controls).forEach(control => {
        control.markAsTouched();
      });
      this.toastr.warning("Por favor, completa los campos","Guardar");
      return;
    }
    this.loading = true;
    this.usersService.store(this.data).subscribe(data=>{
      this.loading = false;
      if(data.success){
        this.toastr.success(data.message,"Guardar");
      } else {
        Object.keys(data.validators).forEach(e => {
          this.toastr.warning(data.validators[e][0], "Psicosalud");
        });
      }
    },error=>{
      this.loading = false;

    })
  }

}
