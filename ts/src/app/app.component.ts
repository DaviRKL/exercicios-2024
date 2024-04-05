import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  showResume = false;
  submitted = false;

  toggleResume() {
    this.showResume = !this.showResume;
  }

  createTopic() {
    
  }

  submitComment() {
    
    this.submitted = true;
  }
}
