import { Component, OnInit } from '@angular/core';
import { NavigationEnd, Router } from '@angular/router';
import { MainService } from 'src/app/services/main.service';
declare let gtag: Function;
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  public loading = false;
  constructor(public mainService: MainService, private router: Router) { }
  ngOnInit() {
    this.setUpAnalytics();
  }

  setUpAnalytics() {
    this.router.events.subscribe(event => {
      if (event instanceof NavigationEnd) {
        gtag('config', 'G-NCKSFYM6G9', {
          page_path: event.urlAfterRedirects
        });
      }
    });
  }
}
