import { DemographicSymptom } from "./demographic-symptom";
import { Location } from "./location";
import { State } from "./state";

export class Demographic {
    public id: String;
    public family_id: String;
    public user_id: String;
    public name: String;
    public age: String;
    public document_type_id: String;
    public document: String;
    public gender_id: String;
    public birthdate_place_id: String;
    public birthdate: String;
    public civil_status_id: String;
    public occupation: String;
    public scholarship_id: String;
    public city_id: String;
    public email: String;
    public socioeconomic: String;
    public pandemic_affectation_way_id: String;
    public sick_covid: any;
    public vaccinate_covid: any;
    public relative_covid: any;
    public applied_vaccine_id: String;
    public full_dose: any;
    public reason_not_vaccinated_id: String;
    public disability: any;
    public disability_type_id: String;
    public psychoactive_substances_id: String;
    public symptoms_last_week_id: String;
    public demographic_symptoms:Array<DemographicSymptom>;

    public location:Location;

    public created_user_at: String;
    public deleted_user_at: String;
    public updated_user_at: String;
    public created_at: String;
    public deleted_at: String;
    public updated_at: String;
    constructor() {
        this.id = null;
        this.family_id = null;
        this.user_id = null;
        this.name = null;
        this.age = null;
        this.document_type_id = null;
        this.document = null;
        this.gender_id = null;
        this.birthdate_place_id = null;
        this.birthdate = null;
        this.civil_status_id = null;
        this.occupation = null;
        this.scholarship_id = null;
        this.city_id = null;
        this.email = null;
        this.socioeconomic = null;
        this.pandemic_affectation_way_id = null;
        this.sick_covid = null;
        this.vaccinate_covid = null;
        this.relative_covid = null;
        this.applied_vaccine_id = null;
        this.full_dose = null;
        this.reason_not_vaccinated_id = null;
        this.disability = null;
        this.disability_type_id = null;
        this.psychoactive_substances_id = null;
        this.symptoms_last_week_id = null;
        this.demographic_symptoms = new Array<DemographicSymptom>();

        this.location = new Location();

        this.created_user_at = null;
        this.deleted_user_at = null;
        this.updated_user_at = null;
        this.created_at = null;
        this.deleted_at = null;
        this.updated_at = null;
    }
}