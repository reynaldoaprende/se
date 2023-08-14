import { Component, OnInit, Input, Output, EventEmitter} from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-card',
  templateUrl: './card.component.html',
  styleUrls: ['./card.component.scss']
})
export class CardComponent implements OnInit {
  @Input() title;
  @Input() default="../../../assets/images/defaut_card.png";
  @Input() image;
  @Input() subtitle;
  @Input() description;
  @Input() disabled;
  @Input() text_button = "Iniciar";
  @Input() icon = "edit";
  @Input() color = "primary";
  @Output() actionChanged = new EventEmitter();
  constructor(private router:Router) { }

  ngOnInit() {
  }

  action(){
    this.actionChanged.emit(true);
  }

}
