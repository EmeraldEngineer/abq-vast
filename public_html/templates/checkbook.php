<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<main-nav></main-nav>

<main>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">ABQ City Data: Vendor Checkbook</div>
					<div class="panel-body">
						<p>The city's data is updated on a daily basis with the previous day's transactions. This application processes the city's data two days previous to this date. To contact ABQ Data directly, visit <a href="https://www.cabq.gov/abq-data/contact-abq-data" target="_blank">www.cabq.gov</a></p>
					</div>
					<!-- Table -->
				<table class="table table-responsive table-condensed" *ngFor="let d of checkbook">
				<th>Checkbook</th>
					<td><em>Invoice Amount:</em> {{ checkbook.checkbookInvoiceAmount }}</td>
					<em>Invoice Date:</em> {{ checkbook.checkbookInvoiceDate }}<br/>
					<em>Invoice Number:</em> {{ checkbook.checkbookInvoiceNum }}<br/>
					<em>Payment Date::</em> {{ checkbook.checkbookPaymentDate }}<br/>
					<em>Reference Number:</em> {{ checkbook.checkbookReferenceNum }} <br/>
					<em>Vendor:</em> {{ checkbook.checkbookVendor }} <br/>
				</table>
			</div>
		</div>
	</div>
	</div>
</main>