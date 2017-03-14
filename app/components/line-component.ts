


import {Component, OnInit} from "@angular/core";
import {CheckbookService} from "../services/checkbook-service";
import {Checkbook} from "../classes/checkbook";

@Component({
	// selector: "line-chart-draw",
	templateUrl: "./templates/line-template.php"
})

export class LineComponent implements OnInit {

	public lineChartData : Array<any> = [];

	public lineChartLabels : Array<any> = [];

	public lineChartOptions:any = {
		responsive: true,
		spanGaps: true
	};

	constructor(private checkbookService: CheckbookService) {}

	ngOnInit(): void {
		this.getCheckbookByCheckbookVendor();
	}

	getCheckbookByCheckbookVendor(): void {
		this.checkbookService.getCheckbookByCheckbookVendor("building", 0)
			.subscribe(cityData => {
				let checkbooks : Checkbook[] = cityData;
				this.lineChartData = [];
				this.lineChartLabels = [];

				let vendors = checkbooks.map(checkbookEntry => checkbookEntry.checkbookVendor).filter((checkbookEntry, index, self) => self.indexOf(checkbookEntry) === index);

				for(let vendor of vendors) {
					let xAxis = checkbooks.filter(checkbookEntry => checkbookEntry.checkbookVendor === vendor).map(checkbookEntry => checkbookEntry.checkbookInvoiceDate);
					let yAxis = checkbooks.filter(checkbookEntry => checkbookEntry.checkbookVendor === vendor).map(checkbookEntry => checkbookEntry.checkbookInvoiceAmount);
					this.lineChartData.push({data: yAxis, label: vendor});
					this.lineChartLabels.push(xAxis);
				}
			});
	}

	public lineChartLegend:boolean = true;
	public lineChartType:string = 'line';

}