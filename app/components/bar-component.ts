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
	public barChartLabelsTemp: Array<any> = [];
	public flattenedLabelsArray: Array<any> = [];

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
				this.barChartLabelsTemp = [];
				this.flattenedLabelsArray = [];


				let vendors = checkbooks.map(checkbookEntry => checkbookEntry.checkbookVendor).filter((checkbookEntry, index, self) => self.indexOf(checkbookEntry) === index);

				for(let vendor of vendors) {
					let xAxis = checkbooks.filter(checkbookEntry => checkbookEntry.checkbookVendor === vendor).map(checkbookEntry => checkbookEntry.checkbookVendor);
					let yAxis = [checkbooks.filter(checkbookEntry => checkbookEntry.checkbookVendor === vendor).reduce((prevValue, checkbookEntry) => prevValue + checkbookEntry.checkbookInvoiceAmount, 0)];
					this.barChartData.push({data: yAxis, label: vendor});
					this.barChartLabelsTemp.push(xAxis);
					console.log(this.barChartData);
				}
				// console.log(this.barChartLabels);
				for(let labelgroup of this.barChartLabelsTemp) {
					for(let label of labelgroup){
						this.flattenedLabelsArray.sort().push(label);
					}
				}
				this.barChartLabels = Array.from(new Set(this.flattenedLabelsArray));
				this.barChartLabels = ["                                            "];

			});
	}

	public barChartLegend:boolean = true;
	public barChartType:string = "bar";

}