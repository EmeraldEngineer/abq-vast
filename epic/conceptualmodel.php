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
                    <li>checkbookReferenceNum</li>
                    <li>checkbookInvoiceNum</li>
                    <li>checkbookInvoiceDate</li>
                    <li>checkbookPaymtDate</li>
                    <li>checkbookInvoiceAmount</li>
                </ul>
            <h2>Criteria</h2>
                <ul>
                    <li>criteriaId(primary key)</li>
                    <li>criteriaFieldId(foreign key)</li>
                    <li>criteriaShareId(foreign key)</li>
                    <li>criteriaOperator</li>
                    <li>criteriaValue</li>
                </ul>
            <h2>Field</h2>
                <ul>
                    <li>fieldId(primary key)</li>
                    <li>fieldName</li>
                    <li>fieldType</li>
                </ul>
            <h2>Share</h2>
                <ul>
                    <li>shareId(foreign key)</li>
                    <li>shareUrl(foreign key)</li>
                    <li>shareImage</li>
                </ul>
            <h2>Relations</h2>
                <ul>
                    <li>One Checkbook can have many criteria(s) - (1 to n)</li>
                    <li>Many criteria(s) can create many field(s) - (m to n)</li>
                    <li>One field can be shared many times - (1 to n)</li>
                    <li>One share can have many criteria - (1 to n)</li>
                </ul>
            <a href="index.php">Index</a>
            <a href="interaction-flow.php">Interaction</a>
            <a href="persona-aaron.php">Aaron</a>
            <a href="persona-adriana.php">Adriana</a>
            <a href="persona-maricela.php">Maricela</a>
            <a href="use-cases.php">Use Case</a>
            <img src="../images/abqvastERD.svg" />
        </main>
    </body>
</html>