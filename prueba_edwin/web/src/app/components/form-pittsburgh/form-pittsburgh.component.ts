import { Component, OnInit, Input, Output, EventEmitter, ViewChild, ElementRef } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { MainService } from 'src/app/services/main.service';
import { NgForm } from '@angular/forms';
import { DetailsService } from 'src/app/services/details.service';
import { Detail } from 'src/app/classes/detail';
import { DtoDetail } from 'src/app/dto/dto-detail';
import { Pittsburgh } from 'src/app/classes/pittsburgh';
import { PittsburghService } from 'src/app/services/pittsburgh.service';

@Component({
  selector: 'app-form-pittsburgh',
  templateUrl: './form-pittsburgh.component.html',
  styleUrls: ['./form-pittsburgh.component.scss']
})
export class FormPittsburghComponent implements OnInit {
  public loading = false;
  public data: Pittsburgh = new Pittsburgh();
  public confirmOptions = [{ id: 1, name: 'Sí' }, { id: 0, name: 'No' }];

  public general: Array<DtoDetail> = new Array<DtoDetail>();

  public asleep_time: Array<Detail> = new Array<Detail>();
  public likert_week_month: Array<Detail> = new Array<Detail>();
  public likert_problems: Array<Detail> = new Array<Detail>();
  public likert_good_bad: Array<Detail> = new Array<Detail>();
  @Input() document: string = "";
  @Output() finish:EventEmitter<boolean> = new EventEmitter<boolean>();
  @ViewChild('top', null) top: ElementRef;
  @Input() user_id: number = null;
  constructor(public mainService: MainService, private activatedRoute:ActivatedRoute, private toastr: ToastrService, public router: Router, private detailsService: DetailsService, public pittsburghService:PittsburghService) { }

  ngOnInit() {
    if(localStorage.getItem("idUser"))this.user_id = Number(localStorage.getItem("idUser"));
    this.loadDetails();
    this.loadDetailPittsburgh();
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
    this.pittsburghService.store(this.data).subscribe((data:any)=>{
      this.loading = false;
      if(data.success)this.finish.emit(true);
    },error=>{
      this.loading = false;
    });
  }

  loadDetails() {
    this.detailsService.detail("pittsburgh").subscribe(data => {
      this.general = data.data;

      this.asleep_time = this.general.filter(x => x.detail_type_name == 'Tiempo en quedarse dormido');
      this.likert_week_month = this.general.filter(x => x.detail_type_name == 'Likert Semana Mes');
      this.likert_problems = this.general.filter(x => x.detail_type_name == 'Likert Problematico');
      this.likert_good_bad = this.general.filter(x => x.detail_type_name == 'Likert Buena Mala');
    },error=>{

    });
  }

  loadDetailPittsburgh() {
    this.pittsburghService.detail(this.user_id).subscribe((data:any) => {
      if(data.success&&data.data){
        this.data = data.data;
      }
    },error=>{

    });
  }
}
