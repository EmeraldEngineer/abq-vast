import {Component, OnInit} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import "rxjs/add/operator/switchMap";
import {Field} from "../classes/field";
import {FieldService} from "../services/field-service";

@Component({
	templateUrl: "./templates/share.php"
})

export class ShareComponent implements OnInit {
	fields: Field[] = [];
	shareUrl: string = "";

	constructor(private route: ActivatedRoute, private fieldService: FieldService) {
	}

	ngOnInit(): void {
		this.getShareByShareUrl();
	}

	getShareByShareUrl(): void {
		this.route.params
			.switchMap((params: Params) => this.shareUrl = params["shareUrl"]);
	}

	getAllFields(): void {
		this.fieldService.getAllFields()
			.subscribe(fields => this.fields = fields);
	}
}