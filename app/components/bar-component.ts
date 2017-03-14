import {Component, OnInit} from "@angular/core";
import {CheckbookService} from "../services/checkbook-service";
import {Checkbook} from "../classes/checkbook";

@Component({
	/*selector: 'bar-chart-demo',*/
	templateUrl: "./templates/bar-template.php"
})

export class BarComponent implements OnInit {

	public barChartData: Array<any> = [];

	public barChartLabels: Array<any> = [];

	public barChartOptions:any = {
		scaleShowVerticalLines: false,
		responsive: true
	};

	constructor(private checkbookService: CheckbookService) {}

	ngOnInit(): void {
		this.getCheckbookByCheckbookVendor();
	}

	getCheckbookByCheckbookVendor(): void {
		this.checkbookService.getCheckbookByCheckbookVendor("building", 0)
			.subscribe(cityData => {
				let checkbooks : Checkbook[] = cityData;
				this.barChartData = [];
				this.barChartLabels = [];

				let vendors = checkbooks.map(checkbookEntry => checkbookEntry.checkbookVendor).filter((checkbookEntry, index, self) => self.indexOf(checkbookEntry) === index);

				for(let vendor of vendors) {
					let xAxis = checkbooks.filter(checkbookEntry => checkbookEntry.checkbookVendor === vendor).map(checkbookEntry => checkbookEntry.checkbookInvoiceDate);
					let yAxis = checkbooks.filter(checkbookEntry => checkbookEntry.checkbookVendor === vendor).map(checkbookEntry => checkbookEntry.checkbookInvoiceAmount);
					this.barChartData.push({data: yAxis, label: vendor});
					this.barChartLabels.push(xAxis);
				}
			});
	}

	public barChartLegend:boolean = true;
	public barChartType:string = "bar";

}