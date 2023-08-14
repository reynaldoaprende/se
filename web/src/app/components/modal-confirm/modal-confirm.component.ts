import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { MainService } from 'src/app/services/main.service';
import { ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';

@Component({
  selector: 'app-modal-confirm',
  templateUrl: './modal-confirm.component.html',
  styleUrls: ['./modal-confirm.component.scss']
})
export class ModalConfirmComponent implements OnInit {
  @Input() text;
  @Input() textConfirm="Sí";
  @Input() textCancel="No";
  @Input() active:boolean;
  @Output() activeChange = new EventEmitter();
  @Input() allowClose:boolean;
  @Output() cancel = new EventEmitter();
  @Output() confirm = new EventEmitter();
  constructor(public mainService:MainService,private toastr: ToastrService, public router:Router) { }

  ngOnInit() {
  }

  confirmEvent(){
    this.confirm.emit(true);
    this.active = false;
    this.activeChange.emit(this.active);
  }

  cancelEvent(){
    this.cancel.emit(false);
    this.active = false;
    this.activeChange.emit(this.active);
  }
}
