require('./bootstrap');

require('alpinejs');

$(function() {
    var table = $('#employees-datatable').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#employees-datatable_wrapper .col-md-6:eq(0)' );
} );

$(function() {
    var table = $('#schedules-datatable').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#schedules-datatable_wrapper .col-md-6:eq(0)' );
} );