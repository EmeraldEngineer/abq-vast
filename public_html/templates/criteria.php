<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<main-nav></main-nav>

	<div *ngIf="field === undefined">
		<h1>Information Not Found</h1>
		<div class="alert alert-danger" role="alert">
			Information not found. Please verify the link and try again.
		</div>
	</div>
	<div *ngIf="field !== undefined && field !== null">
		<form #fieldName="ngForm" class="form-horizontal well" name="fieldName" id="fieldName" (ngSubmit)="getFieldByFieldId();">
			<h1>Field for {{ field.fieldId }}</h1>
			<!--			<div *ngIf="alreadyRsvped" class="alert alert-info" role="alert">-->
			<!--				<i class="fa fa-info" aria-hidden="true"></i> You have already RSVPed. You can edit your RSVP information here.-->
			<!--			</div>-->
			<div class="form-group" [ngClass]="{ 'has-error': fieldName.touched && fieldName.invalid }">
				<label for="fieldName">Vendor Name, Invoice Reference Number, Invoice Amount</label>
				<div class="input-group">
<!--					<div class="input-group-addon">-->
<!--						<i class="fa fa-users" aria-hidden="true"></i>-->
<!--					</div>-->
					<input type="number" id="fieldName" name="fieldName" class="form-control" required min="0" step="1"
							 [(ngModel)]="field.fieldName" #fieldName="ngModel"/>
				</div>
				<div [hidden]="fieldName.valid || fieldName.pristine" class="alert alert-danger" role="alert">
					<p *ngIf="fieldName.errors?.min">Please add some information.</p>
					<p *ngIf="fieldName.errors?.required">Please add some information.</p>
				</div>
				<div *ngIf="field.fieldName === 0" class="alert alert-warning" role="alert">
					<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria.<i class="fa fa-frown-o" aria-hidden="true"></i>
				</div>
<!--					<div *ngIf="rsvp.rsvpNumPeople > 0" class="alert alert-info" role="alert">-->
<!--						<i class="fa fa-smile-o" aria-hidden="true"></i> You are RSVPing for yourself and {{ rsvp.rsvpNumPeople - 1 }} other people. So glad you can make it! <i class="fa fa-smile-o" aria-hidden="true"></i>-->
<!--					</div>-->
			</div>
			<div class="form-group" [ngClass]="{ 'has-error': fieldType.touched && fieldType.invalid }">
				<label for="fieldType">Field Type</label>
				<div class="input-group">
<!--					<div class="input-group-addon">-->
<!--						<i class="fa fa-commenting" aria-hidden="true"></i>-->
<!--					</div>-->
					<input type="text" id="fieldType" name="fieldType" class="form-control" maxlength="255" [(ngModel)]="field.fieldType" #fieldType="ngModel"/>
				</div>
				<div [hidden]="fieldType.valid || fieldType.pristine" class="alert alert-danger" role="alert">
					<p *ngIf="fieldType.errors?.maxlength">Needs a field type.</p>
				</div>
			</div>
			<button class="btn btn-lg btn-warning" type="reset"><i class="fa fa-ban"></i>&nbsp;Reset</button>
		</form>

	<div *ngIf="criteria === undefined">
		<h1>Information Not Found</h1>
		<div class="alert alert-danger" role="alert">
			Information not found. Please verify the link and try again.
		</div>
	</div>
	<div *ngIf="criteria !== undefined && criteria !== null">
		<form #criteriaOperator="ngForm" class="form-horizontal well" name="criteriaOperator" id="criteriaOperator" (ngSubmit)="getCriteriaByCriteriaId();">
			<h1>Criteria for {{ criteria.criteriaId }}</h1>
<!--			<div *ngIf="alreadyRsvped" class="alert alert-info" role="alert">-->
<!--				<i class="fa fa-info" aria-hidden="true"></i> You have already RSVPed. You can edit your RSVP information here.-->
<!--			</div>-->
			<div class="form-group" [ngClass]="{ 'has-error': criteriaOperator.touched && criteriaOperator.invalid }">
				<label for="criteriaOperator">Operator (=, <, >)</label>
				<div class="input-group">
					<div class="input-group-addon">
<!--						<i class="fa fa-users" aria-hidden="true"></i>-->
					</div>
					<input type="number" id="criteriaOperator" name="criteriaOperator" class="form-control" required min="0" step="1" [(ngModel)]="criteria.criteriaOperator" #criteriaOperator="ngModel"/>
				</div>
				<div [hidden]="criteriaOperator.valid || criteriaOperator.pristine" class="alert alert-danger" role="alert">
					<p *ngIf="criteriaOperator.errors?.min">Please select an operation.</p>
					<p *ngIf="criteriaOperator.errors?.required">Please select an operation.</p>
				</div>
				<div *ngIf="criteria.criteriaForm === 0" class="alert alert-warning" role="alert">
					<i class="fa fa-frown-o" aria-hidden="true"></i> Please select criteria. <i
						class="fa fa-frown-o" aria-hidden="true"></i>
				</div>
<!--				<div *ngIf="rsvp.rsvpNumPeople > 0" class="alert alert-info" role="alert">-->
<!--					<i class="fa fa-smile-o" aria-hidden="true"></i> You are RSVPing for yourself and {{ rsvp.rsvpNumPeople --->
<!--					1 }} other people. So glad you can make it! <i class="fa fa-smile-o" aria-hidden="true"></i>-->
<!--				</div>-->
			</div>
		</form>

		<button class="btn btn-lg btn-info" type="submit" [disabled]="rsvpForm.invalid"><i class="fa fa-pencil"></i>&nbsp;Graph Me
		</button>
<!--		<div *ngIf="status !== null" class="alert alert-dismissible" [ngClass]="status.type" role="alert">-->
<!--			<button type="button" class="close" aria-label="Close" (click)="status = null;"><span-->
<!--					aria-hidden="true">&times;</span></button>-->
<!--			{{ status.message }}-->
<!--		</div>-->
	</div>


<!--<h1>Enter the data you would like to graph</h1>-->
<!--<p>-->
<!--	<em>Criteria Operator</em> {{criteria.criteriaOperator}}<br />-->
<!--	<em>Criteria Value</em> {{criteria.criteriaValue}}<br />-->
<!---->
<!---->
<!--</p>-->
<!---->
<!--<p>-->
<!--	<a routerLink=""><i class="fa fa-home" aria-hidden="true"></i> Return Home</a>-->
<!--</p>-->

