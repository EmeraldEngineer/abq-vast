import {Component, OnInit} from "@angular/core";
import {ActivatedRoute, Params} from "@angular/router";
import {CheckbookService} from "../services/checkbook-service";
import {Checkbook} from "../classes/checkbook";
import "rxjs/add/operator/switchMap";
import {Status} from "../classes/status";
import DateTimeFormat = Intl.DateTimeFormat;

@Component({
	templateUrl: "./templates/checkbook.php"
})

export class CheckbookComponent implements OnInit {
	checkbook: Checkbook = new Checkbook(null, null, null, null, null, null, null, null, null, null, null);
	checkbooks: Checkbook[] = [];
	status: Status = new Status(null, null, null);
	checkbookVendor: string = "";
	checkbookInvoiceAmount: number = 0;
	checkbookSunriseDate: DateTimeFormat;
	checkbookSunsetDate: DateTimeFormat;
	checkbookInvoiceNum: string = "";
	checkbookPaymentSunriseDate: DateTimeFormat;
	checkbookPaymentSunsetDate: DateTimeFormat;
	checkbookReferenceNum: string = "";
	pageNum : number = 0;

	constructor(private checkbookService: CheckbookService, private route: ActivatedRoute) {
	}

	ngOnInit(): void {
		this.getAllCheckbooks();
	}

	getCheckbookByCheckbookId(): void {
		this.route.params
			.switchMap((params: Params) => this.checkbookService.getCheckbookByCheckbookId(params["checkbookId"]))
			.subscribe(checkbook => this.checkbook = checkbook);
	}

	getAllCheckbooks(): void {
		this.checkbookService.getAllCheckbooks(this.pageNum)
			.subscribe(checkbooks => this.checkbooks = checkbooks);
	}

	turnThePage() {
		this.pageNum++;
		this.getAllCheckbooks();
	}

	turnThePageBack() {
		this.pageNum--;
		this.getAllCheckbooks();
	}
}

/*this was a change*/