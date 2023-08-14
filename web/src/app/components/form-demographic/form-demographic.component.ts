import { Component, OnInit, Input, Output, EventEmitter, ViewChild, ElementRef } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { MainService } from 'src/app/services/main.service';
import { NgForm } from '@angular/forms';
import { DetailsService } from 'src/app/services/details.service';
import { Detail } from 'src/app/classes/detail';
import { DtoDetail } from 'src/app/dto/dto-detail';
import { Demographic } from 'src/app/classes/demographic';
import { DemographicsService } from 'src/app/services/demographics.service';
import { Family } from 'src/app/classes/family';
import { UsersService } from 'src/app/services/users.service';
import { Country } from 'src/app/classes/country';
import { State } from 'src/app/classes/state';
import { Location } from 'src/app/classes/location';
import { StateService } from 'src/app/services/state.service';
import { LocationService } from 'src/app/services/location.service';
import { CountryService } from 'src/app/services/country.service';

@Component({
  selector: 'app-form-demographic',
  templateUrl: './form-demographic.component.html',
  styleUrls: ['./form-demographic.component.scss']
})
export class FormDemographicComponent implements OnInit {
  public loading = false;
  public data: Demographic = new Demographic();
  public confirmOptions = [{ id: 1, name: 'Sí' }, { id: 0, name: 'No' }];

  public general: Array<DtoDetail> = new Array<DtoDetail>();

  public documents_types: Array<Detail> = new Array<Detail>();
  public genders: Array<Detail> = new Array<Detail>();
  public civil_states: Array<Detail> = new Array<Detail>();
  public scholarshipes: Array<Detail> = new Array<Detail>();
  public pandemic_affectation_ways: Array<Detail> = new Array<Detail>();
  public applied_vaccine: Array<Detail> = new Array<Detail>();
  public reason_not_vaccinated: Array<Detail> = new Array<Detail>();
  public disability_type: Array<Detail> = new Array<Detail>();
  public psychoactive_substances: Array<Detail> = new Array<Detail>();
  public symptoms_last_week: Array<Detail> = new Array<Detail>();
  public families: Array<Family> = new Array<Family>();
  @Input() document: string = "";
  @Output() finish: EventEmitter<boolean> = new EventEmitter<boolean>();
  @Output() getIdUser: EventEmitter<number> = new EventEmitter<number>();
  @ViewChild('top', null) top: ElementRef;
  public admin: boolean = null;
  public activeConfirmDeleteFamily: boolean = false;
  @Input() user_id: number = null;
  public countries: Array<Country> = new Array<Country>();
  public states: Array<State> = new Array<State>();
  public locations: Array<Location> = new Array<Location>();
  public statesResidence: Array<State> = new Array<State>();
  public locationsResidence: Array<Location> = new Array<Location>();
  public country_id: String = null;
  public state_id: String = null;
  public country_residence_id: String = null;
  public state_residence_id: String = null;
  public current_date:any;
  constructor(public mainService: MainService, private countryService: CountryService, private stateService: StateService, private locationService: LocationService, private userService: UsersService, private toastr: ToastrService, public router: Router, private detailsService: DetailsService, public demographicsService: DemographicsService) { }

  ngOnInit() {
    this.current_date = Date();
    if (localStorage.getItem("idUser")) this.user_id = Number(localStorage.getItem("idUser"));
    this.loadDetails();
    this.loadDetailDemographic();
    this.loadCountries();
  }

  validBirthdate(form:NgForm){
    let birthdate:Date = new Date(this.data.birthdate.toString());
    let current:Date = new Date(this.current_date.toString());
    let year = current.getFullYear()-18;
    if(birthdate.getFullYear()<(current.getFullYear()-110)){
      form.controls["birthdate"].setErrors({birthdate:true});
      form.controls["birthdate"].markAsTouched();
    }else{
      form.controls["birthdate"].setErrors(null);
    }
  }

  store(form: NgForm) {
    // Muestra mensaje de error en los campos que son obligatorios
    if (form.invalid) {
      Object.values(form.controls).forEach(control => {
        control.markAsTouched();
      });

      this.top.nativeElement.scrollIntoView({ behavior: 'smooth' });
      this.toastr.warning("Por favor, completa los campos y revisa que los campos sean válidos", "Guardar");
      return;
    }
    if (!this.data.demographic_symptoms || !this.data.demographic_symptoms.length) {
      this.toastr.warning("Por favor, diligencie si siente algún sintoma.", "Guardar");
      return;
    }
    this.loading = true;
    this.demographicsService.store(this.data).subscribe((data: any) => {
      this.loading = false;
      if (data.success) {
        this.data = data.data;
        this.getIdUser.emit(Number(this.data.user_id));
      }
      this.finish.emit(true);
    }, error => {
      this.loading = false;
    });
  }

  loadCountries() {
    this.countryService.list().subscribe(data => {
      if (data.success) {
        this.countries = JSON.parse(JSON.stringify(data.data));
      }
    }, error => {
    });
  }

  loadStatesResidence(event: any) {
    this.country_residence_id = event;
    if (this.country_residence_id) {
      let param: State = new State();
      param.country_id = this.country_residence_id;
      this.stateService.list(param).subscribe(data => {
        if (data.success) {
          this.statesResidence = JSON.parse(JSON.stringify(data.data));
        }
      }, error => {
      });
    }
  }

  loadLocationsResidence(event: any) {
    this.state_residence_id = event;
    if (this.state_residence_id) {
      let param: Location = new Location();
      param.state_id = this.state_residence_id;
      this.locationService.list(param).subscribe(data => {
        if (data.success) {
          this.locationsResidence = JSON.parse(JSON.stringify(data.data));
        }
      }, error => {
      });
    }
  }

  loadStates(event: any) {
    this.country_id = event;
    if (this.country_id) {
      let param: State = new State();
      param.country_id = this.country_id;
      this.stateService.list(param).subscribe(data => {
        if (data.success) {
          this.states = JSON.parse(JSON.stringify(data.data));
        }
      }, error => {
      });
    }
  }

  loadLocations(event: any) {
    this.state_id = event;
    if (this.state_id) {
      let param: Location = new Location();
      param.state_id = this.state_id;
      this.locationService.list(param).subscribe(data => {
        if (data.success) {
          this.locations = JSON.parse(JSON.stringify(data.data));
        }
      }, error => {
      });
    }
  }

  loadDetails() {
    this.loading = true;
    this.detailsService.detail("DEMO").subscribe(data => {
      this.general = data.data;
      this.documents_types = this.general.filter(x => x.detail_type_name == 'Tipo de documento');
      this.genders = this.general.filter(x => x.detail_type_name == 'Sexo');
      this.civil_states = this.general.filter(x => x.detail_type_name == 'Estado civil');
      this.scholarshipes = this.general.filter(x => x.detail_type_name == 'Escolaridad');
      this.pandemic_affectation_ways = this.general.filter(x => x.detail_type_name == 'Manera afectacion pandemia');
      this.applied_vaccine = this.general.filter(x => x.detail_type_name == 'Vacuna aplicada');
      this.reason_not_vaccinated = this.general.filter(x => x.detail_type_name == 'Vacuna razones');
      this.disability_type = this.general.filter(x => x.detail_type_name == 'Tipo de discapacidad');
      this.psychoactive_substances = this.general.filter(x => x.detail_type_name == 'Practica problematica sustancias');
      this.symptoms_last_week = this.general.filter(x => x.detail_type_name == 'Sintomas ultima semana');
      this.loading = false;
    }, error => {
      this.loading = false;
    });
  }

  loadDetailDemographic() {
    this.demographicsService.detail(this.user_id ? this.user_id : null).subscribe((data: any) => {

      if (data.success && data.data) {
        this.data = data.data;
        this.getIdUser.emit(Number(this.data.user_id));
        if(this.data.birthdate_place_id){
          this.country_id = this.data.location.state.country_id;
          this.state_id = this.data.location.state_id;
          this.loadLocations(this.data.location.state_id);
          this.loadStates(this.data.location.state.country_id);
        }
      }
      this.families = data.families;
      this.admin = data.isAdmin;
      if(!this.admin){
        this.data.document = this.document;
      }
    }, error => {

    });
  }

  vaccinateCovidChange(e: any) {
    if (e == 0) {
      this.data.applied_vaccine_id = null;
      this.data.full_dose = null;
    }
  }

  onChangeMultiple(index, value, event) {
    let d: Detail = this.symptoms_last_week[index];
    if (value) {
      if (index == this.symptoms_last_week.length - 1) {
        this.symptoms_last_week.forEach(x => x["checked"] = false && x.id!=this.symptoms_last_week[this.symptoms_last_week.length - 1].id);
        this.data.demographic_symptoms = [];
      }
      if (!this.data.demographic_symptoms) this.data.demographic_symptoms = [];
      let checkNeither = this.data.demographic_symptoms.find(x=>x.symptoms_last_week_id==this.symptoms_last_week[this.symptoms_last_week.length - 1].id);
      console.log(checkNeither);
      if(!checkNeither)
      this.data.demographic_symptoms.push({ symptoms_last_week_id: d.id, demographic_id: null, id: null, checked: true });
      else
      event.preventDefault();
    } else {
      let indexRemove = this.data.demographic_symptoms.findIndex(x => x.symptoms_last_week_id == d.id);
      this.data.demographic_symptoms.splice(indexRemove, 1);
    }
  }

  confirmDeleteFamily() {

  }

  findUser() {
    this.userService.find({ document: this.data.document }).subscribe((data: any) => {
      if (data.success && data.data) {
        this.document = this.data.document.toString();
        this.user_id = data.data.id;
        this.getIdUser.emit(this.user_id);
        this.loadDetailDemographic();
      }
    }, (error: any) => {

    });
  }

}
