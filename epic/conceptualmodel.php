<!DOCYYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <title>
            Conceptual Model
        </title>
    </head>
        <header>
            <h1>Entities & Attributes</h1>
        </header>
    <body>
        <main>
            <h2>Checkbook</h2>
                <ul>
                    <li>checkbookId(primary key)</li>
                    <li>checkbookVendor</li>
                    <li>checkbookReferenceNumber</li>
                    <li>checkbookInvoiceNumber</li>
                    <li>checkbookInvoiceDate</li>
                    <li>checkbookPaymentDate</li>
                    <li>checkbookInvoiceAmount</li>
                </ul>
            <h2>Criteria</h2>
                <ul>
                    <li>criteriaId</li>
                    <li>criteriaFieldId</li>
                    <li>criteriaShareId</li>
                    <li>criteriaOperator</li>
                    <li>criteriaValue</li>
                </ul>
            <h2>Field</h2>
                <ul>
                    <li>fieldId</li>
                    <li>fieldName</li>
                    <li>fieldType</li>
                </ul>
            <h2>Share</h2>
                <ul>
                    <li>shareId</li>
                    <li>shareUrl</li>
                </ul>
            </main>
    </body>
</html>