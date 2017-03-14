<h1>Bar Chart</h1>
<!-- Bar chart stuff goes here -->


<div *ngIf="barChartData.length > 0">
	<div>
		<canvas baseChart
				  [datasets]="barChartData"
				  [labels]="barChartLabels"
				  [options]="barChartOptions"
				  [legend]="barChartLegend"
				  [chartType]="barChartType">
		</canvas>
	</div>
</div>

