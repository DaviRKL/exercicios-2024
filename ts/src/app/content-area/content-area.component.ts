import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-content-area',
  templateUrl: './content-area.component.html',
  styleUrls: ['./content-area.component.scss']
})
export class ContentAreaComponent implements OnInit {

  expandedText: boolean = false;

  constructor() { }

  ngOnInit(): void {
  }

  expandirTexto() {
    this.expandedText = true;
  }

}
