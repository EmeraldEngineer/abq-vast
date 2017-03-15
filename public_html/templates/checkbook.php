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
				<th>Checkbook</th>
                    <tr>
					<td><em>Invoice Amount:</em> {{ checkbook.checkbookInvoiceAmount }}</td>
                    <td><em>Invoice Date:</em> {{ checkbook.checkbookInvoiceDate }}</td>
                    <td><em>Invoice Number:</em> {{ checkbook.checkbookInvoiceNum }}</td>
                    <td><em>Payment Date:</em> {{ checkbook.checkbookPaymentDate }}</td>
                    <td><em>Reference Number:</em> {{ checkbook.checkbookReferenceNum }} </td>
                    <td><em>Vendor:</em> {{ checkbook.checkbookVendor }} </td>
                    </tr>
					</table>
			</div>
		</div>
	</div>
	</div>
</main>