import { Role } from './role';

export class User {
    public id: String;
    public name: String;
    public last_name: String;
    public age: String;
    public document_type_id: String;
    public document: String;
    public gender_id: String;
    public birthdate: String;
    public birthdate_location_id: String;
    public socieconomic_id: String;
    public marital_status_id: String;
    public location_id: String;
    public address: String;
    public email: String;
    public phone: String;
    public occupation: String;
    public relationship_university_id: String;
    public academic_program_id: String;
    public academic_semester_id: String;
    public enabled: Date;
    public role_id: any;
    public password: String;
    public module_id: String;

    public created_user_at: String;
    public deleted_user_at: String;
    public updated_user_at: String;
    public created_at: String;
    public deleted_at: String;
    public updated_at: String;
    public external: String;
    public internal: String;
    public role:Role;
    public last_form_code: String;
    public consent_id: String;
    public consent_date: String;
    constructor() {
        this.id = null;
        this.name = null;
        this.last_name = null;
        this.age = null;
        this.document_type_id = null;
        this.document = null;
        this.gender_id = null;
        this.birthdate = null;
        this.birthdate_location_id = null;
        this.socieconomic_id = null;
        this.marital_status_id = null;
        this.location_id = null;
        this.address = null;
        this.email = null;
        this.phone = null;
        this.occupation = null;
        this.relationship_university_id = null;
        this.academic_program_id = null;
        this.academic_semester_id = null;
        this.enabled = null;
        this.role_id = null;
        this.password = null;
        this.module_id = null;
        this.created_user_at = null;
        this.deleted_user_at = null;
        this.updated_user_at = null;
        this.created_at = null;
        this.deleted_at = null;
        this.updated_at = null;

        this.external = null;
        this.internal = null;
        this.role = new Role();
        this.last_form_code = null;
        this.consent_id = null;
        this.consent_date = null;
    }
}