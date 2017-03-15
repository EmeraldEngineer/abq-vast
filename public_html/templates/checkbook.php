<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<main-nav></main-nav>

<main>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">ABQ City Data: Vendor Checkbook</div>
					<div class="panel-body">
						<p>The city's data is updated on a daily basis with the previous day's transactions. This application processes the city's data two days previous to this date. To contact ABQ Data directly, visit <a href="https://www.cabq.gov/abq-data/contact-abq-data" target="_blank">www.cabq.gov</a></p>
					</div>
					<!-- Table -->
					<table class="table table-responsive table-condensed" *ngFor="let checkbook of checkbooks">
						<tr>
							<th><em>Vendor</em></th>
							<th><em>Invoice Amount</em></th>
							<th><em>Invoice Date</em></th>
							<th><em>Invoice Number</em></th>
							<th><em>Payment Date</em></th>
							<th><em>Reference Number</em></th>
						</tr>
						<tr>
							<td>{{ checkbook.checkbookVendor }}</td>
							<td>{{ checkbook.checkbookInvoiceAmount }}</td>
							<td>{{ checkbook.checkbookInvoiceDate | date }}</td>
							<td>{{ checkbook.checkbookInvoiceNum }}</td>
							<td>{{ checkbook.checkbookPaymentDate | date }}</td>
							<td>{{ checkbook.checkbookReferenceNum }}</td>
						</tr>
					</table>
					<button><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
	</div>
</main>