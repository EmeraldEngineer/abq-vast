import {Component, OnInit} from "@angular/core";
import {Field} from "../classes/field";
import {FieldService} from "../services/field-service";
import {CriteriaService} from "../services/criteria-service";
import {Criteria} from "../classes/criteria";
import {Status} from "../classes/status";

@Component({
	templateUrl: "./templates/criteria.php"
})

export class CriteriaComponent implements OnInit {
	fields: Field[] = [];
	criteria: Criteria[] = [];
	status: Status = new Status(null, null, null);
	checkbookVendor: string = "";
	checkbookInvoiceAmount: number = 0;
	checkbookSunriseDate: Date;
	checkbookSunsetDate: Date;
	checkbookInvoiceNum: string = "";
	checkbookPaymentSunriseDate: Date;
	checkbookPaymentSunsetDate: Date;
	checkbookReferenceNum: string = "";

	constructor(private fieldService: FieldService, private criteriaService: CriteriaService) {
	}

	ngOnInit(): void {
		this.getAllFields();
	}

	getAllFields(): void {
		this.fieldService.getAllFields()
			.subscribe(fields => this.fields = fields);
	}

	postCriterion(criteria: Criteria) : void {
		this.criteriaService.postCriterion(criteria)
			.subscribe(status => this.status = status);
	}

	postCriteria() : void {
		this.criteria.filter(criterion => criterion.criteriaId === null).map(criterion => this.postCriterion(criterion));
	}


}