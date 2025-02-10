import { Component, Input,OnInit } from '@angular/core';

@Component({
  selector: 'app-card',
  templateUrl: './card.component.html',
  styleUrls: ['./card.component.css']
})
export class CardComponent {
  @Input() data!: any ;
  cover: string = '';

  constructor() {
    // console.log(this.data.name);
    
    // this.cover = this.genereateCover();
  }


  ngOnInit(): void {
    this.cover = this.genereateCover();
  }
  openCard(): void {
    console.log('Card opened');
    console.log(this.data.image.length);
  }

  genereateCover(): string {

    for (let i = 0; i < this.data.image.length; i++) {
      if (this.data.image[i].orientation==='orizontal'){
        return this.data.image[i].path;
      } 

    }
    return ''; // Default return statement
  }
}
