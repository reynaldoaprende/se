import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-link',
  templateUrl: './link.component.html',
  styleUrls: ['./link.component.scss']
})
export class LinkComponent implements OnInit {
  @Input() route;
  @Input() text;
  @Input() class;
  @Input() icon;
  constructor() { }

  ngOnInit() {
  }

}
