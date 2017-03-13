import {Component, OnInit} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import {CheckbookService} from "../services/checkbook-service";
import {Checkbook} from "../classes/checkbook";
import "rxjs/add/operator/switchMap";

@Component({
	templateUrl: "./templates/checkbook.php"
})

export class CheckbookComponent implements OnInit {
	checkbook: Checkbook = new Checkbook(null, null, null, null, null, null, null);

	constructor(private checkbookService: CheckbookService, private route: ActivatedRoute) {
	}

	ngOnInit(): void {
		this.getCheckbookByCheckbookId();
	}

	getCheckbookByCheckbookId(): void {
		this.route.params
			.switchMap((params: Params) => this.checkbookService.getCheckbookByCheckbookId(params["checkbookId"]))
			.subscribe(checkbook => this.checkbook = checkbook);
	}


}
