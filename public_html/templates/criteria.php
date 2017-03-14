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
		<form #fieldForm="ngForm" class="form-horizontal well" name="fieldForm" id="fieldForm" (ngSubmit)="getAllFields();">
			<h1>Fields for {{ field.fieldName }}</h1>
			<div class="form-group" [ngClass]="{ 'has-error': fieldName.touched && fieldName.invalid }">
				<label for="fieldName">Vendor Name, Invoice Reference Number, Invoice Amount</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-users" aria-hidden="true"></i>
					</div>
					<input type="text" id="fieldName" name="fieldName" class="form-control" required min="0" step="1" [(ngModel)]="field.fieldName" #fieldName="ngModel"/>
				</div>
				<div [hidden]="fieldName.valid || fieldName.pristine" class="alert alert-danger" role="alert">
					<p *ngIf="fieldName.errors?.min">Please add some information.</p>
					<p *ngIf="fieldName.errors?.required">Please add some information.</p>
				</div>
				<div *ngIf="field.fieldName === 0" class="alert alert-warning" role="alert">
					<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria.<i class="fa fa-frown-o" aria-hidden="true"></i>
				</div>
			</div>
			<div class="form-group" [ngClass]="{ 'has-error': fieldType.touched && fieldType.invalid }">
				<label for="fieldType">Field Type</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-bomb" aria-hidden="true"></i>
					</div>
					<input type="text" id="fieldType" name="fieldType" class="form-control" maxlength="1" [(ngModel)]="field.fieldType" #fieldType="ngModel"/>
				</div>
				<div [hidden]="fieldType.valid || fieldType.pristine" class="alert alert-danger" role="alert">
					<p *ngIf="fieldType.errors?.maxlength">Can only be one letter. </p>
				</div>
			</div>
		</form>


		<form #criteriaForm="ngForm" class="form-horizontal well" name="criteriaForm" id="criteriaForm" (ngSubmit)="postCriteria();">
			<h1>Criteria for {{ criteria.criteriaId }}</h1>
			<div class="form-group" [ngClass]="{ 'has-error': criteriaOperator.touched && criteriaOperator.invalid }">
				<label for="criteriaOperator">Operator (=, <, >)</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-bug" aria-hidden="true"></i>
					</div>
					<input type="text" id="criteriaOperator" name="criteriaOperator" class="form-control" [(ngModel)]="criteria.criteriaOperator" #criteriaOperator="ngModel"/>
				</div>
				<div [hidden]="criteriaOperator.valid || criteriaOperator.pristine" class="alert alert-danger" role="alert">
					<p *ngIf="criteriaOperator.errors?.min">Please select an operation.</p>
					<p *ngIf="criteriaOperator.errors?.required">Please select an operation.</p>
				</div>
				<div *ngIf="criteria.criteriaForm === 0" class="alert alert-warning" role="alert">
					<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria. <i
						class="fa fa-frown-o" aria-hidden="true"></i>
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