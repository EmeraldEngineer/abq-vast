import {Component, OnInit} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import {FieldService} from "../services/field-service";
import {Field} from "../classes/field";
import "rxjs/add/operator/switchMap";

@Component({
	templateUrl: "./templates/field.php"
})

export class FieldsComponent implements OnInit {
	field: Field = new Field(null, null, null);

	constructor(private fieldService: FieldService, private route: ActivatedRoute) {
	}

	ngOnInit(): void {
		this.getFieldByFieldId();
	}

	getFieldByFieldId(): void {
		this.route.params
			.switchMap((params: Params) => this.fieldService.getFieldByFieldId(params["fieldId"]))
			.subscribe(field => this.field = field);
	}
}