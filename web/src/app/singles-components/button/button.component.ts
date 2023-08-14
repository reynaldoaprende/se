import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-button',
  templateUrl: './button.component.html',
  styleUrls: ['./button.component.scss']
})
export class ButtonComponent implements OnInit {
  @Input() class;
  @Input() text;
  @Input() type="button";
  @Input() icon;
  @Input() disabled:boolean=false;
  constructor() { }

  ngOnInit() {
  }

}
