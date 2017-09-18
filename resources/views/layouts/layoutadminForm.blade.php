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
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('public/plugins/daterangepicker/daterangepicker.css')}}">
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
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('public/plugins/select2/select2.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('public/dist/css/skins/_all-skins.min.css')}}">

  <!-- HTML5 Shim and Respond.js')}} IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js')}} doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js')}}"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
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
<!-- Select2 -->
<script src="{{asset('public/plugins/select2/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('public/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('public/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('public/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<script src="{{asset('public/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('public/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('public/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('public/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- bootstrap Date time picker -->
<script src="{{asset('public/plugins/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{asset('public/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('public/plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('public/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/dist/js/app.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/dist/js/demo.js')}}"></script>
<!-- Page script -->
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

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

     $('#range').daterangepicker({locale: {
            format: 'DD-MMM-YYYY'
        }});
    //Date range picker
    $('#reservation').daterangepicker({timePicker: true, timePickerIncrement: 30,locale: {
            format: 'DD-MMM-YYYY h:mm A'
        }});
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

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

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
</body>
</html>