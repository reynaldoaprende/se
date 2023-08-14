import { State } from "./state";

export class Location {
    public id: String;
    public name: String;
    public code: String;
    public state_id: String;
    public state:State;
    constructor() {
        this.id = null;
        this.name = null;
        this.code = null;
        this.state_id = null;
        this.state = new State();
    }
}