import { Component, OnInit, Input, Output, EventEmitter} from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';
import { MainService } from 'src/app/services/main.service';
import { NgForm } from '@angular/forms';
import { FamilyService } from 'src/app/services/family.service';
import { Family } from 'src/app/classes/family';

@Component({
  selector: 'app-form-family',
  templateUrl: './form-family.component.html',
  styleUrls: ['./form-family.component.scss']
})
export class FormFamilyComponent implements OnInit {
  @Input() data = new Family();
  @Output() cancel:EventEmitter<boolean> = new EventEmitter<boolean>();
  @Output() success:EventEmitter<boolean> = new EventEmitter<boolean>();
  public loading=false;
  constructor(public mainService:MainService, private familyService:FamilyService,private toastr: ToastrService, public router:Router) { }

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
    this.familyService.store(this.data).subscribe(data=>{
      if(data.success){
        this.toastr.success(data.message,"Guardar");
        form.resetForm();
        this.success.emit(true);
      } else {
        Object.keys(data.validators).forEach(e => {
          this.toastr.warning(data.validators[e][0], "Psicosalud");
        });
      }
      this.loading = false;
    },error=>{
      this.loading = false;

    })
  }

  cancelForm(form:NgForm){
    form.resetForm();
    this.cancel.emit(true);
  }
}
