/*
 * Angular2/Typescript Pie Chart
 */

import {Component} from "@angular/core";

/* creates custom selector tag and links to template file */
@Component({
	/*selector: "pie-chart-draw",*/
	templateUrl: "./templates/pie-template.php"
})

export class PieComponent {
	// Alt-data, replace with real data
	public pieChartLabels: string[] = ["January", "February", "March", "April"];

	public pieChartDatasets: any[] = [
		{
			data: [15, 32, 47, 53]
		}
	];
	public pieChartType: string = "pie";
}