<!-- composer require arielmejiadev/larapex-charts
 <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/datatables.min.css"
        rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-2.1.8/af-2.7.0/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/datatables.min.js">
    </script>
php artisan vendor:publish --tag=larapex-charts-config
new DataTable('#myTable', {
    layout: {
        topStart: {
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        }
    }
});

new DataTable('#myTable', {
    buttons: [
        'copy', 'excel', 'pdf'
    ],
    layout: {
        topStart: 'buttons'
    }
});

$('#myTable').DataTable({
    dom: 'Bftip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
});

table.buttons().container()
    .appendTo( '#toolbar' );

    let table = new DataTable('#myTable');

new DataTable.Buttons(table, {
    buttons: [
        'copy', 'excel', 'pdf'
    ]
}); -->
