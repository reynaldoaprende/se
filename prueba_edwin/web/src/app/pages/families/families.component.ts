import { Component, OnInit } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { Family } from 'src/app/classes/family';
import { FamilyService } from 'src/app/services/family.service';
import { MainService } from 'src/app/services/main.service';

@Component({
  selector: 'app-families',
  templateUrl: './families.component.html',
  styleUrls: ['./families.component.scss']
})
export class FamiliesComponent implements OnInit {
  public data:Array<Family> = new Array<Family>();
  public loading= false;
  public row:Family = new Family();
  public activeModalFamily:boolean = false;
  public indexDeleteRow:number = -1;
  constructor(public mainService:MainService, private familyService:FamilyService, private toastr:ToastrService) { }

  ngOnInit(): void {
    this.list();
  }

  list(){
    this.loading = true;
    this.familyService.list().subscribe((data:any)=>{
      if(data.success)this.data=data.data;
      this.loading = false;
    },error=>{
      this.loading = false;
    });
  }

  add(){
    this.row = new Family();
    this.activeModalFamily=true;
  }

  edit(r:Family){
    this.row = JSON.parse(JSON.stringify(r));
    this.activeModalFamily=true;
  }

  successFamily(){
    this.list();
    this.activeModalFamily = false;
  }

  delete(){
    this.loading = true;
    this.familyService.remove(this.data[this.indexDeleteRow]).subscribe((d:any)=>{
      this.indexDeleteRow = -1;
      this.list();
      this.loading = false;
    },error=>{
      this.loading = false;
    });
  }
}
