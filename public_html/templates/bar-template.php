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

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<!-- vendor name input form -->
					<form #vendorSearchForm="ngForm" class="form-horizontal" name="vendorSearchForm" id="vendorSearchForm"
							(ngSubmit)="redirectToTomWu();">
						<div class="form-group">
							<label for="checkbookVendor">Vendor Name</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-users" aria-hidden="true"></i>
								</div>
								<input type="text" id="checkbookVendor" name="checkbookVendor" class="form-control" required min="0"
										 step="1" [(ngModel)]="checkbookVendor" #checkbookVendorReference="ngModel"/>
							</div>
							<div [hidden]="checkbookVendorReference.valid || checkbookVendorReference.pristine"
								  class="alert alert-danger" role="alert">
								<p *ngIf="checkbookVendorReference.errors?.min">Please add some information.</p>
								<p *ngIf="checkbookVendorReference.errors?.required">Please add some information.</p>
							</div>
						</div>
						<!-- submit button -->
						<button class="btn btn-warning" type="reset"><i class="fa fa-ban"></i>&nbsp;Reset</button>
						<button class="btn btn-info" type="submit"><i class="fa fa-pencil"></i>&nbsp;Graph Me</button>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>

