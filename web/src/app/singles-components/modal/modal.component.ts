import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-modal',
  templateUrl: './modal.component.html',
  styleUrls: ['./modal.component.scss']
})
export class ModalComponent implements OnInit {
  @Input() active:boolean;
  @Input() allowClose:boolean;
  @Input() type:string;
  @Output() activeChange:EventEmitter<boolean> = new EventEmitter<boolean>();
  constructor() { }

  ngOnInit() {
  }

  close(){
    this.active=false;
    this.activeChange.emit(false);
  }
}
