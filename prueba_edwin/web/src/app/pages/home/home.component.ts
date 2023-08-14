import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { Message } from 'src/app/classes/message';
import { User } from 'src/app/classes/user';
import { MainService } from 'src/app/services/main.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {
  public list: Array<any> = new Array<any>();
  public data: any;
  public loading = false;
  public document: String = null;
  public current: string = "";
  public messages: Array<Message> = new Array<Message>();
  public currentMessage: Message = new Message();
  public userCurrent: User = new User();
  @ViewChild('top', null) top: ElementRef;
  public idUser: number = null;
  
  public classess = [
    "toastcharacter-glad",
    "toastcharacter-mind",
    "toastcharacter-walk",
    "toastcharacter-joy",
    "toastcharacter-smile"
  ];
  constructor(private router: Router, public mainService: MainService, private activatedRoute: ActivatedRoute, private toastr: ToastrService) { }

  ngOnInit(): void {

    this.mainService.tokenValid().subscribe(data => {
      this.userCurrent = data.user;
      if (this.userCurrent.role_id != 1) {
        this.document = this.userCurrent.document;
      } else {
        this.document = "";
      }
      this.activatedRoute.params.subscribe((data: any) => {
        if (data.time) {
          this.router.navigate(["/home"]);
        }
      }, (error: any) => {

      });
    }, error => {
    });

    this.messages = JSON.parse(localStorage.getItem("messages"));
    if (localStorage.getItem("last_form_code")) this.current = localStorage.getItem("last_form_code");
    if (this.current == "" || this.current == null || this.current == 'null' || this.current == 'undefined') this.current = "demographic";
    this.activatedRoute.params.subscribe((data: any) => {
      if (data.document) {
        this.document = data.document;
      }
      if (data.time) {
        this.router.navigate(["/home"]);
      }
    }, (error: any) => {

    });
  }

  showMessage(){
    const indexMessage = Math.floor(Math.random() * this.messages.length);
    this.currentMessage = this.messages[indexMessage];
    let title="Estimado usuario,";
    let message = this.currentMessage.name;
    this.toastr.show(message,title,{timeOut: 5000,extendedTimeOut:5000, positionClass: "toast-center-center"},"toastcharacter " + this.classess[Math.floor(Math.random() * 5)]);
  }

  finishDemographic() {
    this.current = "edwin";
    localStorage.setItem("last_form_code", "edwin");
    this.showMessage();
    this.top.nativeElement.scrollIntoView({ behavior: 'smooth' });
  }

  finishEdwin() {
    this.current = "cicardian";
    localStorage.setItem("last_form_code", "cicardian");
    this.showMessage();
    this.top.nativeElement.scrollIntoView({ behavior: 'smooth' });
  }

  finishUnit() {
    this.current = "pittsburgh";
    localStorage.setItem("last_form_code", "pittsburgh");
    this.showMessage();
    this.top.nativeElement.scrollIntoView({ behavior: 'smooth' });
  }

  finishPittsburgh() {
    this.current = "cicardian";
    localStorage.setItem("last_form_code", "cicardian");
    this.showMessage();
    this.top.nativeElement.scrollIntoView({ behavior: 'smooth' });
  }

  finishCicardian() {
    this.current = "affection";
    localStorage.setItem("last_form_code", "affection");
    this.showMessage();
    this.top.nativeElement.scrollIntoView({ behavior: 'smooth' });
  }

  finishAffection() {
    this.current = "violence";
    localStorage.setItem("last_form_code", "violence");
    this.showMessage();
    this.top.nativeElement.scrollIntoView({ behavior: 'smooth' });
  }

  finishViolence() {
    this.current = "finish";
    localStorage.setItem("last_form_code", "finish");
    this.showMessage();
    this.top.nativeElement.scrollIntoView({ behavior: 'smooth' });
  }

  getIdUser(id: any) {
    this.idUser = id;
    localStorage.setItem("idUser", this.idUser.toString());
  }
}
