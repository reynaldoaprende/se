import { Component, OnInit, Output, Input, EventEmitter, ViewChild, Renderer2, ElementRef } from '@angular/core';
import { Validator, ControlValueAccessor, AbstractControl, ValidationErrors, NG_VALUE_ACCESSOR, NG_VALIDATORS } from '@angular/forms';

@Component({
  selector: 'app-select',
  templateUrl: './select.component.html',
  styleUrls: ['./select.component.scss'],
  providers:[
    {provide: NG_VALUE_ACCESSOR, useExisting: SelectComponent, multi: true},
    {
      provide: NG_VALIDATORS,
      useExisting: SelectComponent,
      multi: true
    }
  ]
})
export class SelectComponent implements OnInit, ControlValueAccessor, Validator {
  @Input() name_field="name";
  @Input() value_field="id";
  @Input() data;
  @Input() placeholder;
  @Input() class;
  @Input() required;
  @Input() name;
  @Input() disabled: boolean;  
  @Input() value;
  isDisabled: boolean;
  public isInvalid: boolean = false;
  onChange = (_: any) => { }
  OnValidatorChange = () => { }
  onTouched = () => { }
  constructor() { }
  validate(control: AbstractControl): ValidationErrors {
    let errors: ValidationErrors;
    control.statusChanges.subscribe(data => {
      this.isInvalid = data == 'INVALID' && control.touched;
      errors = control.errors;
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
