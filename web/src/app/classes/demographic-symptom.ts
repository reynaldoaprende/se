export class DemographicSymptom {
    public id: String;
    public demographic_id: String;
    public symptoms_last_week_id: String;
    public checked: boolean;
    constructor() {
        this.id = null;
        this.demographic_id = null;
        this.symptoms_last_week_id = null;
        this.checked = false;
    }
}