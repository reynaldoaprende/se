import { Component, OnInit, Input, EventEmitter, Output } from '@angular/core';
import { MainService } from 'src/app/services/main.service';
import { ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';
import { Consent } from 'src/app/classes/consent';
import { DomSanitizer } from '@angular/platform-browser';

@Component({
  selector: 'app-modal-consent',
  templateUrl: './modal-consent.component.html',
  styleUrls: ['./modal-consent.component.scss']
})
export class ModalConsentComponent implements OnInit {
  @Input() data:Consent = new Consent();
  @Input() active:boolean;
  @Input() allowClose:boolean;
  @Output() activeChanged = new EventEmitter();
  @Output() confirm = new EventEmitter();
  @Output() cancel = new EventEmitter();
  @Output() loading = new EventEmitter();
  constructor(public mainService:MainService,private _sanitizer: DomSanitizer,private toastr: ToastrService, public router:Router) { }

  ngOnInit() {
  }

  store(){
    this.confirm.emit();
    this.active = false;
    this.activeChanged.emit(false);
    this.loading.emit(false);
  }
  logout(){
    this.loading.emit(true);
    this.mainService.logout().subscribe(data=>{
      this.cancel.emit();
      this.loading.emit(false);
      localStorage.clear();
      this.toastr.success("Cerrando sesión","")
      this.router.navigate(['/login']);
    },error=>{
      this.loading.emit(false);
    });
  }

  getVideoIframe(url) {
    var video, results;
 
    if (url === null) {
        return '';
    }
    results = url.match('[\\?&]v=([^&#]*)');
    video   = (results === null) ? url : results[1];
 
    return this._sanitizer.bypassSecurityTrustResourceUrl('https://www.youtube.com/embed/' + video + '?start=0');   
  }
}
