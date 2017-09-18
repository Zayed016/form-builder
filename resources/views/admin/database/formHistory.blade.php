@extends('layouts.layoutadminTable')
@section('content')
      <!-- Main content -->
    
    <section class="content">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
    
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$form->name}} History</h3>
               @if($form->type==1)
                <a href="{{Route('formAddData',Request::segment(3))}}" style="font-size: 35px;" class="fa fa-plus-circle pull-right margin"></a>
               @elseif($form->type==2)
                <a data-toggle="modal" data-target="#formAddData" style="font-size: 35px;cursor: pointer;" class="fa fa-plus-circle pull-right margin"></a>
                @endif
            </div>
            @if($form->type==2)
               <div id="formAddData" class="modal fade" role="dialog">

  <div class="modal-dialog">
            <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{$form->name}}</h4>
      </div>
      <div class="modal-body">
         <!-- /.box-header -->
             <form  role="form" method="POST" enctype="multipart/form-data" action="{{Route('submitForm',Request::segment(3))}}">
            @include('admin.component.formview')
 </form>
      </div>
      </div>
      </div>
      </div>
      @endif
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table  class="table table-bordered dataTb  table-striped">
                <thead>
                <?php $cols=array(); ?>
                <tr>
                  <th>#</th>

                     @foreach($tables as $table)
                  <?php $columns=App\DatabaseModel::getFormTableColumn(Request::segment(3),$table); ?>
                
                  @foreach($columns as $col)
                     
             <?php array_push($cols,$col->column_name); ?>
             @if($col->label!=''||$col->label!=NULL)
             <th>{{$col->label}}</th>
             @else 
                  <th>{{$table}}_{{$col->column_name}}</th>
            @endif
                  @php 
                  $flag["$col->column_name"]=$col->dynamic_column;
                  $flag["$col->column_name"."table"]=$col->dynamic_table;
                  @endphp
              
                    @endforeach
                     @endforeach
                     <th>Created At</th>
                      @if($form->can_edit==1)
                     <th>Action</th>
                     @endif
                   
                </tr>
                </thead>
                <tbody>
                <?php $num=0; ?>
                 <?php $data=App\DatabaseModel::getFormTableColumnItems($tables) ?>
        
                  @foreach($data as $show)
                
                   @php 
                    $x=$form->column_need;
                    if($x!=NULL || $x!='')
                    if($show->$x!=NULL || $show->$x!=''){
                     
                    }else{
                    continue;
                    } 
                    @endphp
               
                  <tr>
                 
                 <td>{{++$num}}</td>

                  @foreach($cols as  $view)
                    
                  <?php $sel = @unserialize($show->$view); ?>
              @if ($sel !== false) 
              <td>
     
              @if(is_array($sel))
                @foreach($sel as $doc)
              @if (strpos($doc, '_;') !== false)
              <a target="_blank" class="fa fa-download" href="{{asset('public/documents/'.$doc)}}">  </a>&nbsp;&nbsp;{{strstr($doc, '_;', true)}}<br>
              @else

                @if($flag[$view]!='' || $flag[$view]!=NULL)

              {{App\DatabaseModel::getForignKeyValue($doc,$flag[$view.'table'],$flag[$view])}} <br>
              @else
                {{$doc}} 
                @endif
              @endif
                @endforeach
                @endif
              </td>
              @else 

              @php

              if($flag[$view]!='' || $flag[$view]!=NULL){ 
              $val=App\DatabaseModel::getForignKeyValue($show->$view,$flag[$view.'table'],$flag[$view]); 
              }else{
                $val=$show->$view;
                }


              @endphp 

              
                  <td>{{$val}} </td>
                

                
                     @endif
                 @endforeach
                 <td>{{date('d-M-Y h:i A',strtotime($show->created_at))}}</td>
                 
                 <td style="font-size: 20px;">
                 @if($form->can_edit==1)
                 <a title="Edit Form Data" href="{{Route('editFormHistory',[Request::segment(3),$show->primary_id])}}"><i   style="color:green;" class="fa fa-pencil-square-o" ></i></a>
                    @endif
                    @if($form->can_delete==1)
                <a title="Delete Form Data" onclick="return confirm('Are you sure?')" href="{{Route('deleteFormData',[Request::segment(3),$show->primary_id])}}"><i   style="color:red;" class="fa fa-times"></i></a>
                    @endif
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