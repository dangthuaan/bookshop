<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
</footer>

@include('admin.includes.control-sidebar')

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ asset('/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->

<!-- REQUIRED JS FOR DATA-TABLE -->
<!-- DataTables -->
<script src="{{ asset('/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/bower_components/admin-lte/dist/js/demo.js') }}"></script>

<!-- datepicker js -->
<script src="{{asset('/js/bootstrap-datepicker.min.js') }}"></script>
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

    $('#uploadimage').imageupload({
        allowedFormats: [ 'jpg' ],
        maxFileSizeKb: 512,
        imgSrc: "http://www.gstatic.com/webp/gallery/5.jpg"
    });
  })
  
</script>
