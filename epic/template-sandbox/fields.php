<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <!-- Bootstrap Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"/>

    <!-- Font Awesome -->
    <link type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../../public_html/styles/styles.css" type="text/css"/>

    <!-- HTML5 shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript, all compiled plugins included -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <script src="lib/jquery-2.1.0.min.js"></script>


    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
    <script src="dataset/dataset.js"></script>

    <title>Fields</title>

</head>
<body class="sfooter">
<div class="sfoooter-content">
    <header>Fields</header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group" id="adv-search">
                        <input type="text" class="form-control" placeholder="Search The Checkbook" />
                        <div class="input-group-btn">
                            <div class="btn-group" role="group">
                                <div class="dropdown dropdown-lg">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label for="filter">Filter by</label>
                                                <select class="form-control">
                                                    <option value="0" selected>All Vendors</option>
                                                    <option value="1">Invoice Amount</option>
                                                    <option value="2">Invoice Date</option>
                                                    <option value="3">Invoice Number</option>
                                                    <option value="4">Payment Date</option>
                                                    <option value="5">Reference Number</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="contain">Vendor</label>
                                                <input class="form-control" type="text" />
                                            </div>
                                            <div class="form-group">
                                                <label for="contain">Start Date</label>
                                                <input class="form-control" type="text" />
                                            </div>
                                            <div class="form-group">
                                                <label for="contain">End Date</label>
                                                <input class="form-control" type="text"/>
                                            </div>
                                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                        </form>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12">

            <table id="example" class="stripe row-border order-column" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Vendor</th>
                    <th>Invoice Amount</th>
                    <th>Invoice Number</th>
                    <th>Invoice Date</th>
                    <th>Payment Date</th>
                    <th>Reference Number</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Vendor</th>
                    <th>Invoice Amount</th>
                    <th>Invoice Number</th>
                    <th>Invoice Date</th>
                    <th>Payment Date</th>
                    <th>Reference Number</th>
                </tr>
                </tfoot>
                <tbody>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2606945</td>
                    <td>NMSM110413VG</td>
                    <td>2013-11-04T00:00:00</td>
                    <td>2014-01-10T00:00:00</td>
                    <td>95.05</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2621206</td>
                    <td>COA1361638</td>
                    <td>2014-01-25T00:00:00</td>
                    <td>2014-07-24T00:00:00</td>
                    <td>205.55</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2621440</td>
                    <td>COA1361897</td>
                    <td>2014-01-25T00:00:00</td>
                    <td>2014-07-25T00:00:00</td>
                    <td>119.47</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2621440</td>
                    <td>COA1361899</td>
                    <td>2014-01-25T00:00:00</td>
                    <td>2014-07-25T00:00:00</td>
                    <td>571.1</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2621440</td>
                    <td>COA1361900</td>
                    <td>2014-01-25T00:00:00</td>
                    <td>2014-07-25T00:00:00</td>
                    <td>164.24</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2621440</td>
                    <td>COA1361901</td>
                    <td>2014-02-01T00:00:00</td>
                    <td>2014-07-25T00:00:00</td>
                    <td>221.92</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2621440</td>
                    <td>COA1361902</td>
                    <td>2014-02-01T00:00:00</td>
                    <td>2014-07-25T00:00:00</td>
                    <td>170.8</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2621440</td>
                    <td>COA1361903</td>
                    <td>2014-02-01T00:00:00</td>
                    <td>2014-07-25T00:00:00</td>
                    <td>162.6</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2621440</td>
                    <td>COA1361906</td>
                    <td>2014-02-08T00:00:00</td>
                    <td>2014-07-25T00:00:00</td>
                    <td>118.89</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2621440</td>
                    <td>COA1361907</td>
                    <td>2014-02-08T00:00:00</td>
                    <td>2014-07-25T00:00:00</td>
                    <td>170.8</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2621440</td>
                    <td>COA1361908</td>>
                    <td>2014-02-15T00:00:00</td>
                    <td>2014-07-25T00:00:00</td>
                    <td>96.68</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2621440</td>
                    <td>COA1361909</td>
                    <td>2014-02-22T00:00:00</td>
                    <td>2014-07-25T00:00:00</td>
                    <td>264.07</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2621440</td>
                    <td>COA1361910</td>
                    <td>2014-03-01T00:00:00</td>
                    <td>2014-07-25T00:00:00</td>
                    <td>262.03</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2621440</td>
                    <td>COA1361911</td>
                    <td>2014-03-15T00:00:00</td>
                    <td>2014-07-25T00:00:00</td>
                    <td>137</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2625829</td>
                    <td>COA1366417</td>
                    <td>2014-07-26T00:00:00</td>
                    <td>2014-09-25T00:00:00</td>
                    <td>144.91</td>
                </tr>
                <tr>
                    <td>1 ST HEALTH INC</td>
                    <td>2625829</td>
                    <td>COA1366419</td>
                    <td>2014-08-23T00:00:00</td>
                    <td>2014-09-25T00:00:00</td>
                    <td>96.68</td>
                </tr>
                <tr>
                    <td>10 TANKER</td>
                    <td>0009219219</td>
                    <td>R773298</td>
                    <td>2015-11-11T00:00:00</td>
                    <td>2015-12-24T00:00:00</td>
                    <td>1000</td>
                </tr>
                <tr>
                    <td>10 TANKER</td>
                    <td>0009229167</td>
                    <td>R773476</td>
                    <td>2016-03-24T00:00:00</td>
                    <td>2016-03-31T00:00:00</td>
                    <td>250</td>
                </tr>
                <tr>
                    <td>10 TANKER</td>
                    <td>0009232402</td>
                    <td>R773525</td>
                    <td>2016-04-26T00:00:00</td>
                    <td>2016-04-29T00:00:00</td>
                    <td>500</td>
                </tr>
                <tr>
                    <td>10 TANKER</td>
                    <td>0009234933</td>
                    <td>R773570</td>
                    <td>2016-05-16T00:00:00</td>
                    <td>2016-05-20T00:00:00</td>
                    <td>250</td>
                </tr>
                <tr>
                    <td>10 TANKER</td>
                    <td>0009235522</td>
                    <td>R773583</td>
                    <td>2016-05-19T00:00:00</td>
                    <td>2016-05-27T00:00:00</td>
                    <td>5000</td>
                </tr>
                <tr>
                    <td>10 TANKER</td>
                    <td>0009235522</td>
                    <td>R773584</td>
                    <td>2016-05-19T00:00:00</td>
                    <td>2016-05-27T00:00:00</td>
                    <td>250</td>
                </tr>
                <tr>
                    <td>10 TANKER</td>
                    <td>2606131</td>
                    <td>R772300</td>
                    <td>2013-11-20T00:00:00</td>
                    <td>2013-12-31T00:00:00</td>
                    <td>250</td>
                </tr>
                <tr>
                    <td>10 TANKER</td>
                    <td>2614280</td>
                    <td>R772484</td>
                    <td>2014-04-15T00:00:00</td>
                    <td>2014-04-23T00:00:00</td>
                    <<td>250</td>
                </tr>
                <tr>
                    <td>10 TANKER</td>
                    <td>2618135</td>
                    <td>R772528</td>
                    <td>2014-05-29T00:00:00</td>
                    <td>2014-06-17T00:00:00</td>
                    <td>250</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</main>

</body>