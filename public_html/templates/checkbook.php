<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<main-nav></main-nav>

<main class="bg">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<h1>Checkbook</h1><br/>
				<p>
					<em>Invoice Amount:</em> {{ checkbook.checkbookInvoiceAmount }}<br/>
					<em>Invoice Date:</em> {{ checkbook.checkbookInvoiceDate }}<br/>
					<em>Invoice Number:</em> {{ checkbook.checkbookInvoiceNum }}<br/>
					<em>Payment Date::</em> {{ checkbook.checkbookPaymentDate }}<br/>
					<em>Reference Number:</em> {{ checkbook.checkbookReferenceNum }} <br/>
					<em>Vendor:</em> {{ checkbook.checkbookVendor }} <br/>
                    To search<br/>
                    pick a number between 1 and 1,000,000 and enter it in url.<br/>
				</p>
			</div>
		</div>
	</div>
</main>