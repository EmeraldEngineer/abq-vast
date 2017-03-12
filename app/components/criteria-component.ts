import {Component, OnInit} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import {CriteriaService} from "../services/criteria-service";
import {Criteria} from "../classes/criteria";
import "rxjs/add/operator/switchMap";

@Component({
	templateUrl: "./templates/criteria.php"
})

export class CriteriaComponent implements OnInit {
	criteria: Criteria = new Criteria(null, null, null, null, null);

	constructor(private criteriaService: CriteriaService, private route: ActivatedRoute) {
	}

	ngOnInit(): void {
		this.getCriteriaByCriteriaId();
	}

	getCriteriaByCriteriaId(): void {
		this.route.params
			.switchMap((params: Params) => this.criteriaService.getCriteriaByCriteriaId(params["criteriaId"]))
			.subscribe(criteria => this.criteria = criteria);
	}
}
