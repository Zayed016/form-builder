@extends('layouts.layoutadminTable')
@section('content')

      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
    
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Form List</h3>
                <a href="{{Route('tableList')}}" style="font-size: 35px;" class="fa fa-plus-circle pull-right margin"></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table  class="table dataTb table-bordered  table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Tables</th>
                  <th>Action</th>
                   
                </tr>
                </thead>
                <tbody>
                <?php $num=0; ?>
         @foreach($list as $data)
   
                <tr>
                  <td>{{++$num}}</td>
                  <td>{{$data->name}}&nbsp;&nbsp;
                  
                  </td>
                  <td>{{$data->tables}}</td>
                  <td style="font-size: 20px;">


                  <a title="Select Column For Form" href="{{Route('selectColumnforForm',$data->id)}}"><i style="color:#0073b7;" class="fa fa-list-ul" aria-hidden="true"></i></a>&nbsp;
                
                
                  <a title="Edit Form Property"  href="{{Route('editformInputType',$data->id)}}" > <i style="color:green;" class="fa fa-pencil-square-o" aria-hidden="true" ></i></a>&nbsp;
                  

                  <a title="Add Form Data"  href="{{Route('formAddData',$data->id)}}"><i class="fa fa-plus" aria-hidden="true"></i></a>&nbsp;
                  <a title="Form History"  href="{{Route('formHistory',$data->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>

              
                  <a title="Delete" onclick="return confirm('Are You sure?')"  href="{{Route('deleteData',['forms',$data->id])}}">&nbsp;<i style="color:red;" class="fa fa-times" aria-hidden="true"></i></a>
               
                  </td>
                </tr>
      @endforeach
                </tbody>
           
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection