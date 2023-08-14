import { Component, OnInit, Input, Output, EventEmitter, ViewChild, ElementRef } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { MainService } from 'src/app/services/main.service';
import { NgForm } from '@angular/forms';
import { DetailsService } from 'src/app/services/details.service';
import { Detail } from 'src/app/classes/detail';
import { DtoDetail } from 'src/app/dto/dto-detail';
import { Unity } from 'src/app/classes/unity';
import { UnityService } from 'src/app/services/unity.service';

@Component({
  selector: 'app-form-unity',
  templateUrl: './form-unity.component.html',
  styleUrls: ['./form-unity.component.scss']
})
export class FormUnityComponent implements OnInit {
  public loading = false;
  public data: Unity = new Unity();
  public confirmOptions = [{ id: 1, name: 'Sí' }, { id: 0, name: 'No' }];

  public general: Array<DtoDetail> = new Array<DtoDetail>();

  public likert_never_always: Array<Detail> = new Array<Detail>();
  public likert_never_always_inverted: Array<Detail> = new Array<Detail>();
  @Input() document: string = "";
  @Output() finish:EventEmitter<boolean> = new EventEmitter<boolean>();
  @ViewChild('top', null) top: ElementRef;
  @Input() user_id: number = null;
  constructor(public mainService: MainService, private toastr: ToastrService, public router: Router, private detailsService: DetailsService, public unityService:UnityService) { }

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
    this.unityService.store(this.data).subscribe((data:any)=>{
      this.loading = false;
      if(data.success)this.finish.emit(true);
    },error=>{
      this.loading = false;
    });
  }

  loadDetails() {
    this.detailsService.detail("unity").subscribe(data => {
      this.general = data.data;

      this.likert_never_always = this.general.filter(x => x.detail_type_name == 'Likert Nunca Siempre');
      this.likert_never_always_inverted = this.general.filter(x => x.detail_type_name == 'Likert Nunca Siempre Inversa');
    },error=>{

    });
  }

  loadDetailPittsburgh() {
    this.unityService.detail(this.user_id).subscribe((data:any) => {
      if(data.success&&data.data){
        this.data = data.data;
      }
    },error=>{

    });
  }
}
