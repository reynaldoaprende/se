import { Component, OnInit, Input, Output, EventEmitter, ViewChild, ElementRef } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { MainService } from 'src/app/services/main.service';
import { NgForm } from '@angular/forms';
import { DetailsService } from 'src/app/services/details.service';
import { Detail } from 'src/app/classes/detail';
import { DtoDetail } from 'src/app/dto/dto-detail';
import { Cicardian } from 'src/app/classes/cicardian';
import { CicardianService } from 'src/app/services/cicardian.service';

@Component({
  selector: 'app-form-cicardian',
  templateUrl: './form-cicardian.component.html',
  styleUrls: ['./form-cicardian.component.scss']
})
export class FormCicardianComponent implements OnInit {
  public loading = false;
  public data: Cicardian = new Cicardian();
  public confirmOptions = [{ id: 1, name: 'Sí' }, { id: 0, name: 'No' }];

  public general: Array<DtoDetail> = new Array<DtoDetail>();
  public likert_awake_hour: Array<Detail> = new Array<Detail>();
  public likert_bed_down_hour: Array<Detail> = new Array<Detail>();
  public likert_warning_alarm_clock: Array<Detail> = new Array<Detail>();
  public likert_easy_awake: Array<Detail> = new Array<Detail>();
  public likert_awake_first_half_hour: Array<Detail> = new Array<Detail>();
  public likert_awake_appetite_first_half_hour: Array<Detail> = new Array<Detail>();
  public likert_awake_feeling_first_half_hour: Array<Detail> = new Array<Detail>();
  public likert_awake_not_commited_bed_down: Array<Detail> = new Array<Detail>();
  public likert_awake_exercise_internal_clock: Array<Detail> = new Array<Detail>();
  public likert_tired_bed_down_hour: Array<Detail> = new Array<Detail>();
  public likert_performance_plan_test_hour: Array<Detail> = new Array<Detail>();
  public likert_tired_sleep: Array<Detail> = new Array<Detail>();
  public likert_bed_down_later_habitual_awake: Array<Detail> = new Array<Detail>();
  public likert_stay_awake_guard: Array<Detail> = new Array<Detail>();
  public likert_heavy_labor: Array<Detail> = new Array<Detail>();
  public likert_heavy_exercise: Array<Detail> = new Array<Detail>();
  public likert_choose_schedule: Array<Detail> = new Array<Detail>();
  public likert_max_welfare: Array<Detail> = new Array<Detail>();
  public likert_morning_evening: Array<Detail> = new Array<Detail>();

  @Input() document: string = "";
  @Output() finish: EventEmitter<boolean> = new EventEmitter<boolean>();
  @ViewChild('top', null) top: ElementRef;
  @Input() user_id: number = null;
  constructor(public mainService: MainService, private toastr: ToastrService, public router: Router, private detailsService: DetailsService, public cicardianService: CicardianService) { }

  ngOnInit() {
    if(localStorage.getItem("idUser"))this.user_id = Number(localStorage.getItem("idUser"));
    this.loadDetails();
    this.loadDetailCicardian();
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
    this.cicardianService.store(this.data).subscribe((data: any) => {
      this.loading = false;
      if (data.success) this.finish.emit(true);
    }, error => {
      this.loading = false;
    });
  }

  loadDetails() {
    this.detailsService.detail("cicardiana").subscribe(data => {
      this.general = data.data;
      this.likert_awake_hour = this.general.filter(x => x.detail_type_name == 'Likert Levantarse');
      this.likert_bed_down_hour = this.general.filter(x => x.detail_type_name == 'Likert Acostarse');
      this.likert_warning_alarm_clock = this.general.filter(x => x.detail_type_name == 'Likert Aviso Despertador');
      this.likert_easy_awake = this.general.filter(x => x.detail_type_name == 'Likert Facil Levantarse');
      this.likert_awake_first_half_hour = this.general.filter(x => x.detail_type_name == 'Likert Levantarse Primera Media Hora');
      this.likert_awake_appetite_first_half_hour = this.general.filter(x => x.detail_type_name == 'Likert Levantarse Apetito Media Hora');
      this.likert_awake_feeling_first_half_hour = this.general.filter(x => x.detail_type_name == 'Likert Levantarse Sentirse Media Hora');
      this.likert_awake_not_commited_bed_down = this.general.filter(x => x.detail_type_name == 'Likert Levantarse No Compromisos Acostarse');
      this.likert_awake_exercise_internal_clock = this.general.filter(x => x.detail_type_name == 'Likert Ejercicio Reloj Interno');
      this.likert_tired_bed_down_hour = this.general.filter(x => x.detail_type_name == 'Likert Cansado Dormir');
      this.likert_performance_plan_test_hour = this.general.filter(x => x.detail_type_name == 'Likert Rendimiento Planificar Prueba');
      this.likert_tired_sleep = this.general.filter(x => x.detail_type_name == 'Likert Cansado 11 Dormir');
      this.likert_bed_down_later_habitual_awake = this.general.filter(x => x.detail_type_name == 'Likert Acostarse Tarde Levantarse Habitual');
      this.likert_stay_awake_guard = this.general.filter(x => x.detail_type_name == 'Likert Permanecer Despierto Guardia');
      this.likert_heavy_labor = this.general.filter(x => x.detail_type_name == 'Likert Trabajo Fisico Pesado');
      this.likert_heavy_exercise = this.general.filter(x => x.detail_type_name == 'Likert Ejercicio Fisico Intenso');
      this.likert_choose_schedule = this.general.filter(x => x.detail_type_name == 'Likert Escoger Horario');
      this.likert_max_welfare = this.general.filter(x => x.detail_type_name == 'Likert Maximo Bienestar');
      this.likert_morning_evening = this.general.filter(x => x.detail_type_name == 'Likert Matunino Vespertino');
    }, error => {

    });
  }

  loadDetailCicardian() {
    this.cicardianService.detail(this.user_id).subscribe((data: any) => {
      if (data.success && data.data) {
        this.data = data.data;
      }
    }, error => {

    });
  }
}
