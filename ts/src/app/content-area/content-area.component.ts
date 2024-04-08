import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-content-area',
  templateUrl: './content-area.component.html',
  styleUrls: ['./content-area.component.scss']
})
export class ContentAreaComponent implements OnInit {


  constructor() { }

  ngOnInit(): void {
  }
  inicialText: boolean = true;
  expandedText: boolean = false;
  criarText: boolean = false;
  mostrarBotaoCriar: boolean = true;
  mostrarConclusao: boolean = false;
  mostrarPergunta: boolean = false;

  expandirTexto() {
    this.expandedText = true;
  }

  mostrarElementos() {
    this. inicialText = false;
    this.criarText = !this.criarText;
    this.mostrarBotaoCriar = !this.mostrarBotaoCriar;
    this.mostrarConclusao = false; 
    this.mostrarPergunta = false;
  }
  mostrarConcluido() {
    this.criarText = !this.criarText;
    this.mostrarConclusao = !this.mostrarConclusao; 
    this.mostrarBotaoCriar = !this.mostrarBotaoCriar;
    this.mostrarPergunta = true;
    }
   


}

