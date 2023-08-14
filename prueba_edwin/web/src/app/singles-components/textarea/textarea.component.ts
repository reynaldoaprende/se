import { Component, OnInit, Input, ViewChild } from '@angular/core';
import { AbstractControl,ValidationErrors,ControlValueAccessor, NG_VALUE_ACCESSOR, NG_VALIDATORS, Validator} 
from "@angular/forms";
@Component({
  selector: 'app-textarea',
  templateUrl: './textarea.component.html',
  styleUrls: ['./textarea.component.scss'],
  providers:[
    {provide: NG_VALUE_ACCESSOR, useExisting: TextareaComponent, multi: true},
    {
      provide: NG_VALIDATORS,
      useExisting: TextareaComponent,
      multi: true
    }
  ]
})
export class TextareaComponent implements OnInit, ControlValueAccessor, Validator {
  @Input() placeholder;
  @Input() inputIcon;
  @Input() class;
  @Input() min;
  @Input() max;
  @Input() disabled=false;
  @Input() required=false;
  @Input() name;
  @Input() rows;
  @ViewChild('field',null) field;
  @Input() value;
  isDisabled: boolean;
  public isInvalid: boolean = false;
  onChange = (_: any) => { }
  OnValidatorChange = () => { }
  onTouched = () => { }
  constructor() { }

  validate(control: AbstractControl):ValidationErrors {
    let errors:ValidationErrors;
    control.statusChanges.subscribe(data=>{
      this.isInvalid = data=='INVALID'&&control.touched;
    });
    return errors;
  }
  registerOnValidatorChange?(fn: () => void): void {
    this.OnValidatorChange = fn;
  }
  writeValue(value: any): void {
    this.value = value;
  }
  registerOnChange(fn: any): void {
    this.onChange = fn;
  }
  registerOnTouched(fn: any): void {
    this.onTouched = fn;
  }
  setDisabledState?(isDisabled: boolean): void {
    this.isDisabled = isDisabled;
  }

  ngOnInit() {
  }

  onInput(value: string) {
    this.value = value;
    this.onTouched();
    this.onChange(this.value);
  }

  onBlur() {
    this.onTouched();
    this.OnValidatorChange();
  }

}
