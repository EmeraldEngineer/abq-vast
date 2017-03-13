/*
Angular 2/Typescript Line Chart
 */
import {Component, OnInit} from "@angular/core";
import {CheckbookService} from "../services/checkbook-service";
import {Checkbook} from "../classes/checkbook";

@Component({
	// selector: "line-chart-draw",
	templateUrl: "./templates/line-template.php"

})

export class LineComponent implements OnInit {
	/* Fake line data, replace with link to actual data */
	public lineChartData : Array<any> = [];

	/* Fake labels, replace with link to actual data */
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

	// checkbookVendorAlreadyGraphed(checkbookVendor : string) {
	// 	return(this.lineChartData.some(checkbook => checkbookVendor === checkbook.checkbookVendor));
	// }
	// public lineChartColors:Array<any> = [
	// 	{
	// 		//red (chile?)
	// 		backgroundColor: "rgba(247, 136, 156, 0.2)",
	// 		borderColor: "rgba(255, 0, 0, 1)",
	// 		pointBackgroundColor: "rgba(247,136,156, 1)",
	// 		pointBorderColor: "rgba(255, 0, 0, 1)",
	// 	},
	// 	{
	// 		//green (chile?)
	// 		backgroundColor: "rgba(173, 255, 178, 0.2)",
	// 		borderColor: "rgba(0, 255, 0, 1)",
	// 		pointBackgroundColor: "rgba(173, 255, 178, 1)",
	// 		pointBorderColor: "rgba(0, 255, 0, 1)",
	// 	}
	// ];

	public lineChartLegend:boolean = true;
	public lineChartType:string = 'line';

}