<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<main-nav></main-nav>

<input #checkbookVendor placeholder="checkbookVendor">
<input #checkbookInvoiceAmount placeholder="checkbookInvoiceAmount">
<input #checkbookSunriseDate placeholder="checkbookSunriseDate">
<input #checkbookSunsetDate placeholder="checkbookSunsetDate">
<input #checkbookInvoiceNum placeholder="checkbookInvoiceNum">
<input #checkbookPaymentSunriseDate placeholder="checkbookPaymentSunriseDate">
<input #checkbookPaymentSunsetDate placeholder="checkbookPaymentSunsetDate">
<input #checkbookReferenceNum placeholder="checkbookReferenceNum">

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
						<input type="text" id="checkbookVendor" name="checkbookVendor" class="form-control" required min="0" step="1" [(ngModel)]="checkbook.checkbookVendor" #checkbookVendor="ngModel"/>
					</div>
					<div [hidden]="checkbookVendor.valid || checkbookVendor.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookVendor.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookVendor.errors?.required">Please add some information.</p>
					</div>
					<div *ngIf="checkbook.checkbookVendor === 0" class="alert alert-warning" role="alert">
						<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria.<i class="fa fa-frown-o" aria-hidden="true"></i>
					</div>
				</div>

				<div class="form-group">
					<label for="checkbookInvoiceAmount">Invoice Amount</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-money" aria-hidden="true"></i>
						</div>
						<input type="range" id="checkbookInvoiceAmount" name="checkbookInvoiceAmount" class="form-control" required min="0" max="1000" step="10" [(ngModel)]="checkbook.checkbookInvoiceAmount" #checkbookInvoiceAmount="ngModel"/>
					</div>
					<div [hidden]="checkbookInvoiceAmount.valid || checkbookInvoiceAmount.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookInvoiceAmount.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookInvoiceAmount.errors?.required">Please add some information.</p>
					</div>
					<div *ngIf="checkbook.checkbookInvoiceAmount === 0" class="alert alert-warning" role="alert">
						<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria.<i class="fa fa-frown-o" aria-hidden="true"></i>
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
						<input type="date" id="checkbookInvoiceSunriseDate" name="checkbookInvoiceSunriseDate" class="form-control" value="1970-01-01" [(ngModel)]="checkbook.checkbookInvoiceSunriseDate" #checkbookInvoiceSunriseDate="ngModel"/>
					</div>
					<div [hidden]="checkbookInvoiceSunriseDate.valid || checkbookInvoiceSunriseDate.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookInvoiceSunriseDate.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookInvoiceSunriseDate.errors?.required">Please add some information.</p>
					</div>
					<div *ngIf="checkbook.checkbookInvoiceSunriseDate === 0" class="alert alert-warning" role="alert">
						<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria.<i class="fa fa-frown-o" aria-hidden="true"></i>
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
						<input type="date" id="checkbookInvoiceSunsetDate" name="checkbookInvoiceSunsetDate" class="form-control" value="1970-01-01" [(ngModel)]="checkbook.checkbookInvoiceSunsetDate" #checkbookInvoiceSunsetDate="ngModel"/>
					</div>
					<div [hidden]="checkbookInvoiceSunsetDate.valid || checkbookInvoiceSunsetDate.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookInvoiceSunsetDate.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookInvoiceSunsetDate.errors?.required">Please add some information.</p>
					</div>
					<div *ngIf="checkbook.checkbookInvoiceSunsetDate === 0" class="alert alert-warning" role="alert">
						<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria.<i class="fa fa-frown-o" aria-hidden="true"></i>
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
						<input type="text" id="checkbookInvoiceNum" name="checkbookInvoiceNum" class="form-control" required min="0" step="1" [(ngModel)]="checkbook.checkbookInvoiceDate" #checkbookInvoiceDate="ngModel"/>
					</div>
					<div [hidden]="checkbookInvoiceNum.valid || checkbookInvoiceNum.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookInvoiceNum.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookInvoiceNum.errors?.required">Please add some information.</p>
					</div>
					<div *ngIf="checkbook.checkbookInvoiceNum === 0" class="alert alert-warning" role="alert">
						<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria.<i class="fa fa-frown-o" aria-hidden="true"></i>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6 col-md-4">
					<div class="form-group" [ngClass]="{ 'has-error': checkbookPaymentSunriseDate.touched && checkbookPaymentSunriseDate.invalid }">
					<label for="checkbookPaymentSunriseDate">Payment Start Date</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar" aria-hidden="true"></i>
						</div>
						<input type="date" id="checkbookPaymentSunriseDate" name="checkbookPaymentSunriseDate" class="form-control" value="1970-01-01" [(ngModel)]="checkbook.checkbookPaymentSunriseDate" #checkbookPaymentSunriseDate="ngModel"/>
					</div>
					<div [hidden]="checkbookPaymentSunriseDate.valid || checkbookPaymentSunriseDate.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookPaymentSunriseDate.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookPaymentSunriseDate.errors?.required">Please add some information.</p>
					</div>
					<div *ngIf="checkbook.checkbookPaymentSunriseDate === 0" class="alert alert-warning" role="alert">
						<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria.<i class="fa fa-frown-o" aria-hidden="true"></i>
					</div>
				</div>
					</div>
					<div class="col-xs-6 col-md-4">
							<div class="form-group" [ngClass]="{ 'has-error': checkbookPaymentSunsetDate.touched && checkbookPaymentSunsetDate.invalid }">
					<label for="checkbookPaymentSunsetDate">Payment End Date</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar" aria-hidden="true"></i>
						</div>
						<input type="date" id="checkbookPaymentSunsetDate" name="checkbookPaymentSunsetDate" class="form-control" value="1970-01-01" [(ngModel)]="checkbook.checkbookPaymentSunsetDate" #checkbookPaymentSunsetDate="ngModel"/>
					</div>
					<div [hidden]="checkbookPaymentSunsetDate.valid || checkbookPaymentSunsetDate.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookPaymentSunsetDate.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookPaymentSunsetDate.errors?.required">Please add some information.</p>
					</div>
					<div *ngIf="checkbook.checkbookPaymentSunsetDate === 0" class="alert alert-warning" role="alert">
						<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria.<i class="fa fa-frown-o" aria-hidden="true"></i>
					</div>
				</div>
					</div>
				</div>

				<div class="form-group">
					<label for="checkbookReferenceNum">Checkbook Reference Number</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-file-text-o" aria-hidden="true"></i>
						</div>
						<input type="text" id="checkbookReferenceNum" name="checkbookReferenceNum" class="form-control" required min="0" step="1" [(ngModel)]="checkbook.checkbookReferenceNum" #checkbookReferenceNum="ngModel"/>
					</div>
					<div [hidden]="checkbookReferenceNum.valid || checkbookReferenceNum.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookReferenceNum.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookReferenceNum.errors?.required">Please add some information.</p>
					</div>
					<div *ngIf="checkbook.checkbookReferenceNum === 0" class="alert alert-warning" role="alert">
						<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria.<i class="fa fa-frown-o" aria-hidden="true"></i>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-3 col-md-10 col-md-offset-2">
<button class="btn btn-warning" type="reset"><i class="fa fa-ban"></i>&nbsp;Reset</button><button class="btn btn-info" type="submit" 	(ngSubmit)="postCriteria().push"><i class="fa fa-pencil"></i>&nbsp;Graph Me</button>
		</div>
	</div>
</div>