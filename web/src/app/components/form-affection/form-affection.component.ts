import { Component, OnInit, Input, Output, EventEmitter, ViewChild, ElementRef } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import {  Router } from '@angular/router';
import { MainService } from 'src/app/services/main.service';
import { NgForm } from '@angular/forms';
import { DetailsService } from 'src/app/services/details.service';
import { DtoDetail } from 'src/app/dto/dto-detail';
import { Affection } from 'src/app/classes/affection';
import { AffectionService } from 'src/app/services/affection.service';

@Component({
  selector: 'app-form-affection',
  templateUrl: './form-affection.component.html',
  styleUrls: ['./form-affection.component.scss']
})
export class FormAffectionComponent implements OnInit {
  public loading = false;
  public data: Affection = new Affection();
  public confirmOptions = [{ id: 1, name: 'Sí' }, { id: 0, name: 'No' }];

  public general: Array<DtoDetail> = new Array<DtoDetail>();
  @Input() document: string = "";
  @Output() finish: EventEmitter<boolean> = new EventEmitter<boolean>();
  @ViewChild('top', null) top: ElementRef;
  @Input() user_id: number = null;
  constructor(public mainService: MainService, private toastr: ToastrService, public router: Router, private detailsService: DetailsService, public affectionService: AffectionService) { }

  ngOnInit() {
    if(localStorage.getItem("idUser"))this.user_id = Number(localStorage.getItem("idUser"));
    this.loadDetails();
    this.loadDetailAffection();
  }

  store(form: NgForm) {
    // Muestra mensaje de error en los campos que son obligatorios
    if (form.invalid) {
      Object.values(form.controls).forEach(control => {
        control.markAsTouched();
      });
      this.top.nativeElement.scrollIntoView({ behavior: 'smooth' });
      this.toastr.warning("Por favor, completa los campos", "Guardar");
      return;
    }
    this.loading = true;
    if(this.user_id)this.data.user_id = this.user_id.toString();
    this.affectionService.store(this.data).subscribe((data: any) => {
      this.loading = false;
      if (data.success) this.finish.emit(true);
    }, error => {
      this.loading = false;
    });
  }

  loadDetails() {
    this.detailsService.detail("affection").subscribe(data => {
      this.general = data.data;
    }, error => {

    });
  }

  loadDetailAffection() {
    this.affectionService.detail(this.user_id).subscribe((data: any) => {
      if (data.success && data.data) {
        this.data = data.data;
      }
    }, error => {

    });
  }
}
