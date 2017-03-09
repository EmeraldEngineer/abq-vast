$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function (i) {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" data-index="'+i+'" />' );
    } );

    // DataTable
    var table = $('#example').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   true
    } );

    // Filter event handler
    $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
} );

$(document).ready(function() {
    $('#example').DataTable( {
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            leftColumns: 2
        },
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]
    } );
} );