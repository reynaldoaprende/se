import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class MainService {
	public APIEndpoint = `${environment.APIEndpoint}/`;
	public APIServer = environment.APIServer;
  public Images = {loading:"../../../assets/images/loading.gif",
    Modules: this.APIServer +'images/modules/',
    Modules_Introductions: this.APIServer +'images/modules_introductions/',
    Activities: this.APIServer +'images/activities/',
    Steps: this.APIServer +'images/steps/',
    Editor_Gallery: this.APIServer +'editor/gallery/',
    Editor_Gallery_Endpoint: this.APIServer +'topic/gallery',
    Questions: this.APIServer +'images/questions/',
    AppDefault: this.APIServer +'images/app/default.png'
  };
  public Files = {
    Steps: this.APIServer +'files/steps/',
  };
  public Audios = {
    Steps: this.APIServer +'audios/steps/',
    Activities: this.APIServer +'audios/activities/'
  };
  constructor(private http: HttpClient) { }

  public getHeader(token?){
    let headers: HttpHeaders = new HttpHeaders();
    let params: HttpParams = new HttpParams();
    token&&this.getToken()?headers = headers.append("Authorization", 'Bearer '+ this.getToken()):'';
    return {"headers":headers, "params":params};
  }

  public get(route,token?:boolean): Observable<any> {
    return this.http.get(this.APIEndpoint + route,this.getHeader(token));
  }

  public post(route,data,token?:boolean): Observable<any> {
    return this.http.post(this.APIEndpoint + route,data,this.getHeader(token));
  }

  public put(route,data,token?:boolean): Observable<any> {
    return this.http.put(this.APIEndpoint + route,data,this.getHeader(token));
  }

  public delete(route,token?:boolean): Observable<any> {
    return this.http.delete(this.APIEndpoint + route,this.getHeader(token));
  }

  public tokenValid(){
    return this.get('valid',true);
  }

  public getToken(){
    return localStorage.getItem('token')?localStorage.getItem('token'):null;
  }

  public getUser(){
    return localStorage.getItem('user')?JSON.parse(localStorage.getItem('user')):null;
  }

  public login(data){
    return this.post(`login`,data);
  }

  public signup(data){
    return this.post(`signup`,data);
  }

  public logout(){
    return this.get(`logout`,true);
  }
}
