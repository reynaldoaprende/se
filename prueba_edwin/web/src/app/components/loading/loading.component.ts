import { Component, OnInit, Input } from '@angular/core';
import { MainService } from 'src/app/services/main.service';

@Component({
  selector: 'app-loading',
  templateUrl: './loading.component.html',
  styleUrls: ['./loading.component.scss']
})
export class LoadingComponent implements OnInit {
  @Input() active=false;
  @Input() image = "";
  constructor(private mainService: MainService) { }

  ngOnInit() {
    this.image = this.mainService.Images.loading;
  }


}
