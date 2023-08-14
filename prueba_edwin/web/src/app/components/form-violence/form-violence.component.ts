import { Component, OnInit, Input, Output, EventEmitter, ViewChild, ElementRef } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';
import { MainService } from 'src/app/services/main.service';
import { NgForm } from '@angular/forms';
import { DetailsService } from 'src/app/services/details.service';
import { Detail } from 'src/app/classes/detail';
import { DtoDetail } from 'src/app/dto/dto-detail';
import { Violence } from 'src/app/classes/violence';
import { ViolenceService } from 'src/app/services/violence.service';

@Component({
  selector: 'app-form-violence',
  templateUrl: './form-violence.component.html',
  styleUrls: ['./form-violence.component.scss']
})
export class FormViolenceComponent implements OnInit {
  public loading = false;
  public data: Violence = new Violence();
  public confirmOptions = [{ id: 1, name: 'Sí' }, { id: 0, name: 'No' }];

  public general: Array<DtoDetail> = new Array<DtoDetail>();
  public likert_frequency: Array<Detail> = new Array<Detail>();
  public likert_damage: Array<Detail> = new Array<Detail>();

  @Input() document: string = "";
  @Output() finish: EventEmitter<boolean> = new EventEmitter<boolean>();
  @ViewChild('top', null) top: ElementRef;
  @Input() user_id: number = null;
  constructor(public mainService: MainService, private toastr: ToastrService, public router: Router, private detailsService: DetailsService, public violenceService: ViolenceService) { }

  ngOnInit() {
    if(localStorage.getItem("idUser"))this.user_id = Number(localStorage.getItem("idUser"));
    this.loadDetails();
    this.loadDetailViolence();
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
    this.violenceService.store(this.data).subscribe((data: any) => {
      this.loading = false;
      if (data.success) this.finish.emit(true);
    }, error => {
      this.loading = false;
    });
  }

  loadDetails() {
    this.detailsService.detail("violence").subscribe(data => {
      this.general = data.data;
      this.likert_damage = this.general.filter(x => x.detail_type_name == 'Likert Violence Damage');
      this.likert_frequency = this.general.filter(x => x.detail_type_name == 'Likert Violence Frequency');
    }, error => {

    });
  }

  loadDetailViolence() {
    this.violenceService.detail(this.user_id).subscribe((data: any) => {
      if (data.success && data.data) {
        this.data = data.data;
      }
    }, error => {

    });
  }
}
