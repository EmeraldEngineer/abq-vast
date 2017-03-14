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
			<form #criteriaForm="ngForm" class="form-horizontal" name="criteriaForm" id="criteriaForm" (ngSubmit)="getAllFields();">
				<h1>Fields for {{ checkbook.checkbookVendor }}</h1>
				<div class="form-group" [ngClass]="{ 'has-error': criteria.push }">
					<label for="checkbookVendor">Vendor Database</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-users" aria-hidden="true"></i>
						</div>
						<input type="text" id="checkbookVendor" name="checkbookVendor" class="form-control" required min="0"
								 step="1" [(ngModel)]="criteria.push" #criteriaForm="ngModel"/>
					</div>
					<div [hidden]="checkbookVendor.valid || checkbookVendor.pristine" class="alert alert-danger"
						  role="alert">
						<p *ngIf="checkbookVendor.errors?.min">Please add some information.</p>
						<p *ngIf="checkbookVendor.errors?.required">Please add some information.</p>
					</div>
					<div *ngIf="checkbook.checkbookVendor === 0" class="alert alert-warning" role="alert">
						<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria.<i class="fa fa-frown-o"
																															aria-hidden="true"></i>
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