import {Component} from "@angular/core";

@Component({
	selector: 'abq-vast-app',
	templateUrl: './templates/abq-vast-app.php'
})

export class AppComponent {
	navCollapse = true;

	toggleCollapse() {
		this.navCollapse = !this.navCollapse;
	}
}