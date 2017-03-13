<h1>Line Chart</h1>
<!--Line chart stuff goes here-->


<div class="row">
	<div class="col-md-6">
		<div style="display: block;">
			<canvas baseChart width="400" height="400"
					  [datasets]="lineChartData"
					  [labels]="lineChartLabels"
					  [options]="lineChartOptions"
					  [colors]="lineChartColors"
					  [legend]="lineChartLegend"
					  [chartType]="lineChartType"></canvas>
		</div>
	</div>
</div>