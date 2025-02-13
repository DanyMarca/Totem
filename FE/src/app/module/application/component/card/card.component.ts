import { Component, Input,OnInit } from '@angular/core';

@Component({
  selector: 'app-card',
  templateUrl: './card.component.html',
  styleUrls: ['./card.component.css']
})
export class CardComponent {
  @Input() data!: any ;
  coverHorizontal: string = '';
  coverVertical: string = '';
  isOpened: boolean = false;

  constructor() {
    // console.log(this.data.name);
    

  }


  ngOnInit(): void {
    this.coverHorizontal = this.genereateCover("horizontal");
    this.coverVertical = this.genereateCover("vertical");
    console.log(this.coverHorizontal)
    console.log(this.coverVertical)
    console.log("fine oninit")
  }

  openCard(): void {this.isOpened = true;}
  closeCard(): void {this.isOpened = false;}

  genereateCover(orientamento:string): string {
    for (let i = 0; i < this.data.image.length; i++) {
      if (this.data.image[i].orientation==='horizontal' && orientamento==='horizontal') {
        return this.data.image[i].path;
      } else if (this.data.image[i].orientation==='vertical' && orientamento==='vertical') {
        return this.data.image[i].path;
      }

    }
    return ''; // Default return statement
  }
}
