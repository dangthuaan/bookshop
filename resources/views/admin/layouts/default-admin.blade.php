@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
	  <!-- datepicker css -->
  <link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css') }}">
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>You are logged in!</p>
@stop

<!-- datepicker js -->
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<!-- inputMask Jquery -->
<script src="{{ asset('/js/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('/js/inputmask.numeric.extensions.js') }}"></script>

<!-- page script -->
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('#bookTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });

    $('#createBookModal').on('shown.bs.modal', function () {
        $('.autofocus').trigger('focus')
    });

    $('#datepicker').datepicker({
      format: 'yyyy-mm-dd',
    });

    $("#currency").inputmask({
        alias: 'numeric',
        rightAlign: false,
        digitsOptional: true,
        radixPoint: ',',
        groupSeparator: '.',
        autoGroup: true,
        placeholder: '',
        removeMaskOnSubmit: true
      });
  })
</script>
