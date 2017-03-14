<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<main-nav></main-nav>

<main class="bg">
	<h1>Checkbook</h1>
	<p>
		<em>Invoice Amount:</em> {{ checkbook.checkbookInvoiceAmount }}<br/>
		<em>Invoice Date:</em> {{ checkbook.checkbookInvoiceDate }}<br/>
		<em>Invoice Number:</em> {{ checkbook.checkbookInvoiceNum }}<br/>
		<em>Payment Date::</em> {{ checkbook.checkbookPaymentDate }}<br/>
		<em>Reference Number:</em> {{ checkbook.checkbookReferenceNum }} <br/>
		<em>Vendor:</em> {{ checkbook.checkbookVendor }} <br/>
	</p>
</main>