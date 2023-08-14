import { Component, OnInit, Input, ViewChild } from '@angular/core';
import { AbstractControl, ValidationErrors, ControlValueAccessor, NG_VALUE_ACCESSOR, NG_VALIDATORS, Validator }
  from "@angular/forms";
@Component({
  selector: 'app-input',
  templateUrl: './input.component.html',
  styleUrls: ['./input.component.scss'],
  providers: [
    { provide: NG_VALUE_ACCESSOR, useExisting: InputComponent, multi: true },
    { provide: NG_VALIDATORS, useExisting: InputComponent, multi: true }
  ]
})
export class InputComponent implements OnInit, ControlValueAccessor, Validator {
  @Input() type = "text";
  @Input() placeholder;
  @Input() inputIcon;
  @Input() class;
  @Input() min = null;
  @Input() max=null;
  @Input() maxlength;
  @Input() disabled;
  @Input() required;
  @Input() name;
  @ViewChild('field', null) field;
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
    if(value==undefined)value=null;
    this.value = value;
    this.onTouched();
    this.onChange(this.value);
  }

  onBlur() {
    this.onTouched();
    this.OnValidatorChange();
  }

}
