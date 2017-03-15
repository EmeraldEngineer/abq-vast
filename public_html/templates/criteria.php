<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<main-nav></main-nav>



<div *ngIf="fields === undefined">
	<h1>Information Not Found</h1>
	<div class="alert alert-danger" role="alert">
		Information not found. Please verify the link and try again.
	</div>
</div>
<div *ngIf="fields !== undefined && fields !== null"></div>

<div *ngIf="criteria === undefined">
	<h1>Information Not Found</h1>
	<div class="alert alert-danger" role="alert">
		Information not found. Please verify the link and try again.
	</div>
</div>
<div *ngIf="criteria !== undefined && criteria !== null"></div>


<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
			<form #criteriaForm="ngForm" class="form-horizontal well" name="criteriaForm" id="criteriaForm" (ngSubmit)="postCriteria().push">
				<div class="form-group">
					<label for="checkbookVendor">Vendor Name</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-users" aria-hidden="true"></i>
						</div>
						<input type="text" id="checkbookVendor" name="checkbookVendor" class="form-control" required min="0" step="1" [(ngModel)]="checkbookVendor" #checkbookVendorReference="ngModel"/>
					</div>
					<div [hidden]="checkbookVendorReference.valid || checkbookVendorReference.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookVendorReference.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookVendorReference.errors?.required">Please add some information.</p>
					</div>
				</div>

				<div class="form-group">
					<label for="checkbookInvoiceAmount">Invoice Amount</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-money" aria-hidden="true"></i>
						</div>
						<input type="range" id="checkbookInvoiceAmount" name="checkbookInvoiceAmount" class="form-control" required min="0" max="10000" step="1000" [(ngModel)]="checkbookInvoiceAmount" #checkbookInvoiceAmountReference="ngModel"/>
						<div>{{ "$" + checkbookInvoiceAmount }}</div>
					</div>
					<div [hidden]="checkbookInvoiceAmountReference.valid || checkbookInvoiceAmountReference.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookInvoiceAmountReference.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookInvoiceAmountReference.errors?.required">Please add some information.</p>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6 col-md-4">
							<div class="form-group">
					<label for="checkbookInvoiceSunriseDate">Invoice Start Date</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-file-text-o" aria-hidden="true"></i>
						</div>
						<input type="date" id="checkbookInvoiceSunriseDate" name="checkbookInvoiceSunriseDate" class="form-control" value="1970-01-01" [(ngModel)]="checkbookInvoiceSunriseDate" #checkbookInvoiceSunriseDateReference="ngModel"/>
					</div>
					<div [hidden]="checkbookInvoiceSunriseDateReference.valid || checkbookInvoiceSunriseDateReference.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookInvoiceSunriseDateReference.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookInvoiceSunriseDateReference.errors?.required">Please add some information.</p>
					</div>
				</div>
					</div>
					<div class="col-xs-6 col-md-4">
							<div class="form-group">
					<label for="checkbookInvoiceSunsetDate">Invoice End Date</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-file-text-o" aria-hidden="true"></i>
						</div>
						<input type="date" id="checkbookInvoiceSunsetDate" name="checkbookInvoiceSunsetDate" class="form-control" value="1970-01-01" [(ngModel)]="checkbookInvoiceSunsetDate" #checkbookInvoiceSunsetDateReference="ngModel"/>
					</div>
					<div [hidden]="checkbookInvoiceSunsetDateReference.valid || checkbookInvoiceSunsetDateReference.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookInvoiceSunsetDateReference.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookInvoiceSunsetDateReference.errors?.required">Please add some information.</p>
					</div>
				</div>
					</div>
				</div>

				<div class="form-group">
					<label for="checkbookInvoiceNum">Invoice Number</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-file-text-o" aria-hidden="true"></i>
						</div>
						<input type="text" id="checkbookInvoiceNum" name="checkbookInvoiceNum" class="form-control" required min="0" step="1" [(ngModel)]="checkbookInvoiceDate" #checkbookInvoiceDateReference="ngModel"/>
					</div>
					<div [hidden]="checkbookInvoiceDateReference.valid || checkbookInvoiceDateReference.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookInvoiceDateReference.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookInvoiceDateReference.errors?.required">Please add some information.</p>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6 col-md-4">
					<div class="form-group">
					<label for="checkbookPaymentSunriseDate">Payment Start Date</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar" aria-hidden="true"></i>
						</div>
						<input type="date" id="checkbookPaymentSunriseDate" name="checkbookPaymentSunriseDate" class="form-control" value="1970-01-01" [(ngModel)]="checkbookPaymentSunriseDate" #checkbookPaymentSunriseDateReference="ngModel"/>
					</div>
					<div [hidden]="checkbookPaymentSunriseDateReference.valid || checkbookPaymentSunriseDateReference.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookPaymentSunriseDateReference.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookPaymentSunriseDateReference.errors?.required">Please add some information.</p>
					</div>
				</div>
					</div>
					<div class="col-xs-6 col-md-4">
							<div class="form-group">
					<label for="checkbookPaymentSunsetDate">Payment End Date</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar" aria-hidden="true"></i>
						</div>
						<input type="date" id="checkbookPaymentSunsetDate" name="checkbookPaymentSunsetDate" class="form-control" value="1970-01-01" [(ngModel)]="checkbookPaymentSunsetDate" #checkbookPaymentSunsetDateReference="ngModel"/>
					</div>
					<div [hidden]="checkbookPaymentSunsetDateReference.valid || checkbookPaymentSunsetDateReference.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookPaymentSunsetDateReference.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookPaymentSunsetDateReference.errors?.required">Please add some information.</p>
					</div>
				</div>
					</div>
				</div>

				<div class="form-group">
					<label for="checkbookReferenceNum">Reference Number</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-file-text-o" aria-hidden="true"></i>
						</div>
						<input type="text" id="checkbookReferenceNum" name="checkbookReferenceNum" class="form-control" required min="0" step="1" [(ngModel)]="checkbookReferenceNum" #checkbookReferenceNumReference="ngModel"/>
					</div>
					<div [hidden]="checkbookReferenceNumReference.valid || checkbookReferenceNumReference.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookReferenceNumReference.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookReferenceNumReference.errors?.required">Please add some information.</p>
					</div>
				</div>
				<button class="btn btn-warning" type="reset"><i class="fa fa-ban"></i>&nbsp;Reset</button><button class="btn btn-info" type="submit" (ngSubmit)="postCriteria().push"><i class="fa fa-pencil"></i>&nbsp;Graph Me</button>
			</form>
		</div>
	</div>
</div>