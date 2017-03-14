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
			<form #criteriaForm="ngForm" class="form-horizontal" name="criteriaForm" id="criteriaForm" (ngSubmit)="postCriteria().push">
				<h1>Fields for {{ checkbook.checkbookVendor }}</h1>
				<div class="form-group" [ngClass]="{ 'has-error': checkbookVendor.touched && checkbookVendor.invalid }">
					<label for="checkbookVendor" class="label">Vendor Name</label>
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

				<h1>Fields for {{ checkbook.checkbookInvoiceAmount }}</h1>
				<div class="form-group" [ngClass]="{ 'has-error': checkbookInvoiceAmount.touched && checkbookInvoiceAmount.invalid }">
					<label for="checkbookInvoiceAmount" class="label">Payment Amount</label>
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

				<h1>Fields for {{ checkbook.checkbookInvoiceDate }}</h1>
				<div class="form-group" [ngClass]="{ 'has-error': checkbookInvoiceDate.touched && checkbookInvoiceDate.invalid }">
					<label for="checkbookInvoiceDate" class="label">Invoice Date</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-file-text-o" aria-hidden="true"></i>
						</div>
						<input type="date" id="checkbookInvoiceDate" name="checkbookInvoiceDate" class="form-control" value="1970-01-01" [(ngModel)]="checkbook.checkbookInvoiceDate" #checkbookInvoiceDate="ngModel"/>
					</div>
					<div [hidden]="checkbookInvoiceDate.valid || checkbookInvoiceDate.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookInvoiceDate.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookInvoiceDate.errors?.required">Please add some information.</p>
					</div>
					<div *ngIf="checkbook.checkbookInvoiceDate === 0" class="alert alert-warning" role="alert">
						<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria.<i class="fa fa-frown-o" aria-hidden="true"></i>
					</div>
				</div>

				<h1>Fields for {{ checkbook.checkbookInvoiceNum }}</h1>
				<div class="form-group" [ngClass]="{ 'has-error': checkbookInvoiceNum.touched && checkbookInvoiceNum.invalid }">
					<label for="checkbookInvoiceNum" class="label">checkbookInvoiceNum</label>
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

				<h1>Fields for {{ checkbook.checkbookPaymentDate }}</h1>
				<div class="form-group" [ngClass]="{ 'has-error': checkbookPaymentDate.touched && checkbookPaymentDate.invalid }">
					<label for="checkbookPaymentDate" class="label">Payment Date</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar" aria-hidden="true"></i>
						</div>
						<input type="date" id="checkbookPaymentDate" name="checkbookPaymentDate" class="form-control" value="1970-01-01" [(ngModel)]="checkbook.checkbookPaymentDate" #checkbookPaymentDate="ngModel"/>
					</div>
					<div [hidden]="checkbookPaymentDate.valid || checkbookPaymentDate.pristine" class="alert alert-danger" role="alert">
						<p *ngIf="checkbookPaymentDate.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookPaymentDate.errors?.required">Please add some information.</p>
					</div>
					<div *ngIf="checkbook.checkbookPaymentDate === 0" class="alert alert-warning" role="alert">
						<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria.<i class="fa fa-frown-o" aria-hidden="true"></i>
					</div>
				</div>


			</form>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-3 col-md-3 col-md-offset-3">
<button class="btn btn-warning" type="reset"><i class="fa fa-ban"></i>&nbsp;Reset</button><button class="btn btn-info" type="submit" [disabled]="criteriaForm.invalid"><i class="fa fa-pencil"></i>&nbsp;Graph Me</button>
		</div>
	</div>
</div>
<!--		<div *ngIf="status !== null" class="alert alert-dismissible" [ngClass]="status.type" role="alert">-->
<!--			<button type="button" class="close" aria-label="Close" (click)="status = null;"><span-->
<!--					aria-hidden="true">&times;</span></button>-->
<!--			{{ status.message }}-->
<!--		</div>-->