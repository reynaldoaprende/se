import { Component, OnInit, Input, Output, EventEmitter, ViewChild, ElementRef } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { MainService } from 'src/app/services/main.service';
import { NgForm } from '@angular/forms';
import { DetailsService } from 'src/app/services/details.service';
import { Detail } from 'src/app/classes/detail';
import { DtoDetail } from 'src/app/dto/dto-detail';
import { Edwin } from 'src/app/classes/edwin';
import { EdwinService } from 'src/app/services/edwin.service';

@Component({
  selector: 'app-form-edwin',
  templateUrl: './form-edwin.component.html',
  styleUrls: ['./form-edwin.component.scss']
})
export class FormEdwinComponent implements OnInit {
  public loading = false;
  public data: Edwin = new Edwin();

  public general: Array<DtoDetail> = new Array<DtoDetail>();
  public list_xxxx: Array<Detail> = new Array<Detail>();
  public list_yyyy: Array<Detail> = new Array<Detail>();

  @Input() document: string = "";
  @Output() finish: EventEmitter<boolean> = new EventEmitter<boolean>();
  @ViewChild('top', null) top: ElementRef;
  @Input() user_id: number = null;
  constructor(public mainService: MainService, private toastr: ToastrService, public router: Router, private detailsService: DetailsService, public edwinService: EdwinService) { }

  ngOnInit() {
    if(localStorage.getItem("idUser"))this.user_id = Number(localStorage.getItem("idUser"));
    this.loadDetails();
    this.loadDetailEdwin();
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
    this.edwinService.store(this.data).subscribe((data: any) => {
      this.loading = false;
      if (data.success) this.finish.emit(true);
    }, error => {
      this.loading = false;
    });
  }

  loadDetails() {
    this.detailsService.detail("edwin").subscribe(data => {
      this.general = data.data;
      this.list_xxxx = this.general.filter(x => x.detail_type_name == 'xxxx');
      this.list_yyyy = this.general.filter(x => x.detail_type_name == 'yyyy');
    }, error => {

    });
  }

  loadDetailEdwin() {
    this.edwinService.detail(this.user_id).subscribe((data: any) => {
      if (data.success && data.data) {
        this.data = data.data;
      }
    }, error => {

    });
  }
}
