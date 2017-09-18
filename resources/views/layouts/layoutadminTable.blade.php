<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image" href=""/>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('public/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/plugins/datatables/dataTables.bootstrap.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/dist/css/AdminLTE.min.css')}}">
  <!-- ChartJS 1.0.1 -->
 
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('public/plugins/datepicker/datepicker3.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('public/plugins/iCheck/all.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('public/plugins/colorpicker/bootstrap-colorpicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('public/plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- Bootstrap DateTime Picker -->
  <link rel="stylesheet" href="{{asset('public/plugins/datetimepicker/bootstrap-datetimepicker.min.css')}}">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('public/dist/css/skins/_all-skins.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <link rel="stylesheet" href="{{asset('public/css/custom.css')}}">

</head>

<body class="hold-transition skin-blue sidebar-mini">

 @extends('component.header')

  <div class="control-sidebar-bg">
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('public/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('public/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('public/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('public/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('public/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/dist/js/app.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/dist/js/demo.js')}}"></script>

<!-- bootstrap datepicker -->
<script src="{{asset('public/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('public/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('public/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- bootstrap Date time picker -->
<script src="{{asset('public/plugins/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<!-- Select2 -->
  <link rel="stylesheet" href="{{asset('public/plugins/select2/select2.min.css')}}">
  <!-- Theme style -->
<link rel="stylesheet" href="{{asset('public/dist/css/AdminLTE.min.css')}}">

  <script src="{{asset('public/plugins/select2/select2.full.min.js')}}"></script>

<script>
  $(function () {

    $(".dataTb").DataTable();
    $(".dataTb-Nosort").DataTable({
       "order": [],
    });
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    $("#accessTable").DataTable({
     "lengthMenu": [[-1], ["All"]],
    });
  });
</script>

<script>
  $(function () {

    $('.datetimepicker').datetimepicker({
       autoclose: true,
    format: 'dd-MM-yyyy HH:ii P',
    showMeridian: true,
    todayBtn: true,
    minuteStep:15,
    });
    $('.datetimepicker1').datetimepicker({
       autoclose: true,
    format: 'dd-MM-yyyy HH:ii P',
    showMeridian: true,
    todayBtn: true,
   minView: 1,
    });
    $('.datetimepick').datetimepicker({
       autoclose: true,
    format: 'yyyy-mm-dd HH:ii P',
    showMeridian: true,
    todayBtn: true,
   minView: 1,
    });
    //Initialize Select2 Elements
    $(".select2").select2();

    $(".selectT").select2({ tags: true});

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
       format: 'yyyy-mm-dd',

    });

    $('.datepicker').datepicker({
      autoclose: true,
       format: 'yyyy-mm-dd',
      yearRange: '1990:9999'

    });

   

 
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>

</body>
</html>
