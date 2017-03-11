<h1>Bar Chart</h1>
<!-- Bar chart stuff goes here -->


<div>
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

