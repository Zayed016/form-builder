@extends('layouts.layoutadminForm')
@section('content')
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-11">
    
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$name}}</h3>
              
            </div>

            <!-- /.box-header -->
            
             <form  role="form" method="POST" enctype="multipart/form-data" action="{{Route('submitForm',Request::segment(3))}}">
             @include('admin.component.formview')

             </form>
      
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection