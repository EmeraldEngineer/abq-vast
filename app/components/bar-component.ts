import { Component } from '@angular/core';

@Component({
	/*selector: 'bar-chart-demo',*/
	templateUrl: "./templates/bar-template.php"
})

export class BarComponent {
	public barChartOptions:any = {
		scaleShowVericalLines: false,
		responsive: true
	};
	/* Fake labels, replace with link to actual data */
	public barChartLabels:string[] = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

	public barChartType:string = "bar";
	public barChartLegend:boolean = true;

	/* Fake line data, replace with link to actual data */
	public barChartData:any[] = [
		{data: [150, 325, 470, 531, 505, 828, 962, 1001, 1111, 1212, 1313], label: "Big Data"},
		{data: [15, 32, 47, 53, 50, 82, 96, 101, 111, 121, 131], label: "Small Data"}
	];


}