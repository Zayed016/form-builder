<style type="text/css">
  .breadcrumb{
        float: right!important;
    background: transparent!important;
    margin-top: 0!important;
    margin-bottom: 8px!important;
    font-size: 15px!important;
    padding: 0px!important;
    position: relative!important;
    top: 0px!important;
    right: 0px!important;
    border-radius: 2px!important;;
  }
  small{
    font-size:85%!important;
  }
</style>

<div class="wrapper">


 <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">Form</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Form Builder</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu hidden">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
     
  

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
       
            <img class="user-image" src="{{asset('public/documents/')}}" height="100" width="100" alt="Your photo">
              
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu" style="width: 280px!important;">
              <!-- User image -->
              <li class="user-header">
              <img class="img-circle" src="{{asset('public/documents/')}}" height="100" width="100" alt="Your photo">
                

                <p>
                  {{Auth::user()->name}} - 
                  <small>Member since  {{date('d-M-Y', strtotime(Auth::user()->created_at))}}</small>
                </p>
              </li>
              <!-- Menu Body -->
             <!--  <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              </li> -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{Route('logout')}}" class="btn btn-success btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('logout')}}" class="btn btn-danger btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="clear: right;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img class="img-circle"  src="{{asset('public/documents/')}}"  alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
  
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Navigation Panel</li>
        <li class="treeview "  >
          <a href="{{Route('formList')}}">
            <i class="fa fa-dashboard"></i> <span>Form List</span>
            <span class="pull-right-container">
             
            </span>
          </a>
        
        </li>
        <li class="treeview "  >
          <a href="{{Route('tableList')}}">
            <i class="fa fa-dashboard"></i> <span>Table List</span>
            <span class="pull-right-container">
             
            </span>
          </a>
        
        </li>


  
</ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #ECF0F5;">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->


    <style> 
    .big{font-size:15px; }
     </style>
<div class="col-md-12" style="padding: 15px; padding-bottom: 0px;">
     @if (!$errors->isEmpty())
    <div class="alert alert-danger fade in big">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{$errors->first()}}
    </div>
    @endif
     @if (session('fail'))
        <div class="alert alert-danger fade in big">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('fail') }}
        </div>
     @endif
  @if (session('success'))
        <div class="alert alert-success fade in big">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('success') }}
        </div>
     @endif
     </div>
     <br>
<div class="row"  style="background-color: #ECF0F5; margin:10px 10px 0px 10px;">


     @yield('content')

</div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <footer class="main-footer" style="clear:right;">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.0
    </div>
    <strong>Copyright @ {{date('Y')}} <a href="http://softlabbd.com"> Soft Lab BD</a></strong>
  </footer>
<script>
  function seeNotification(val) {

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
            }
        };
        xmlhttp.open("GET","{{url('admin/seeNotification/')}}"+'/'+val);
        xmlhttp.send();
    
}

  function ajaxDelete(id,table) {

   var bool = confirm("Are you sure?");
if (bool) {
 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txt"+id).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","{{url('admin/ajaxDelete/')}}"+'/'+id+'/'+table);
        xmlhttp.send();
    
      }

}
</script>