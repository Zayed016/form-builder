@extends('layouts.layoutadminTable')
@section('content')


<?php $tb=explode(',',$data->tables);
 ?>
<script>
    function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
   
 }

 </script>
    <section class="content">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
  
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Form</h3>
            </div>
            <div class="box-body ">
            
            <form action="{{Route('makeForm',Request::segment(3))}}" method="post" accept-charset="utf-8">
            {{csrf_field()}}
       
        
       <div class="form-group col-xs-6">
          <label class="">Form name<span class="required">*</span></label>
      
         <input type="text" name="name" class="form-control" required value="{{$data->name}}">
          </div>
           <div class="form-group col-xs-6">
          <h4 class="">Form Type</h4>      
         <label><input type="radio" name="type" @if($data->type==1) checked @endif required value="1"> General</label>&nbsp;&nbsp;
         <label><input type="radio" name="type" @if($data->type==2) checked @endif  required value="2"> Modal</label>
          </div>

                 <div class="form-group col-xs-6">
          <label class="">Redirect Url</label>
      
         <input type="text" name="redirect" class="form-control"  value="{{$data->redirect}}">
          </div>
                 <div class="form-group col-xs-6">
          <label class="">Run Which Function</label>
      
         <input type="text" name="run_function" class="form-control"  value="{{$data->run_function}}">
          </div>
               <div class="form-group col-xs-6">
          <h4 class="">Can Edit</h4>      
         <label><input type="radio" name="edit" @if($data->can_edit==1) checked @endif required value="1"> Yes</label>&nbsp;&nbsp;
         <label><input type="radio" name="edit" @if($data->can_edit==0) checked @endif  required value="0"> No</label>
          </div>

   
   @php
       $tbnum=count($tb);
       $num=0;

            @endphp
             <label class="col-xs-12 margin" style="clear:both;">
              <input  type="checkbox"  onchange="checkAll(this)" name="chk[]" /> Check All
            </label>
            @foreach($tb as $show)

            <?php $column=App\DatabaseModel::getTableColumnDetails($show); ?>
 
            <div class="table-responsive col-md-6 col-xs-12">
           <center> <label><input type="radio" name="primary" required value="{{$show}}" >{{$show}} as Primary Table</label></center>
            <table class="text-center table table-bordered table-striped">
            	
            	<thead>
            		<tr>
            			<th>Select Column from {{$show}}</th>
            		
                  <th>Data Pulling</th>
                  <th>Session</th>
                </tr>
            	</thead>
            	<tbody>

            	@foreach($column as $col)
        <?php $check=App\DatabaseModel::checkColumn(Request::segment(3),$show,$col->Field);
         ?>

            	@if($col->Field!='id' && $col->Field!='created_at' && $col->Field!='updated_at'  && $col->Field!='creator' && $col->Field!='updater'  )
            		<tr>
            			<td>  <input type="checkbox" @if($col->Null=='NO' && $col->Default=='')  onclick="return false;" onkeydown="return false;" checked @endif @if($check) checked @endif name="{{$show}}[]" value="{{$col->Field}}">&nbsp;{{$col->Field}}@if($col->Null=='NO')<span class="required">*</span> @endif</td>
 <td>
       
       
    <label><input type="radio" @if($check) required="" @endif name="{{$show}}_{{$col->Field}}_id_get" value="1">Get From Primary Table</label>
    @php $isDynamic=App\DatabaseModel::isColumnDynamic(Request::segment(3),$col->Field); @endphp
    <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#myModalTableSelect{{++$num}}"><input type="radio" @if($isDynamic) checked @endif name="{{$show}}_{{$col->Field}}_id_get" value="0">Pull Dynamicly</button>
    <label ><input type="radio" name="{{$show}}_{{$col->Field}}_id_get" value="2" @if(!$isDynamic) checked @endif  >None</label>
     <div id="myModalTableSelect{{$num}}" class="modal fade" role="dialog">

  <div class="modal-dialog">
            <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Table List</h4>
      </div>
      <div class="modal-body">
              @php $selectedTb=App\DatabaseModel::getSelectedDynamiicTable(Request::segment(3),$show,$col->Field) @endphp
      <?php $tables=App\DatabaseModel::getTablesFromDB(); ?>
        <select name="{{$show}}_{{$col->Field}}_dynamic_table" class="select2 form-control" style="width: 100%;">

      @foreach($tables as $table) 
           <option @if($selectedTb==$table) selected @endif value="{{$table}}">{{$table}}</option>
      @endforeach
             </select>
      </div>
      </div>
      </div>
      </div>
    
                    
                               </td>
                     <td>
                       <a class="label label-primary" data-toggle="modal" data-target="#myModalSession{{++$num}}" >Session</a>
                        <div id="myModalSession{{$num}}" class="modal fade" role="dialog">

  <div class="modal-dialog">
            <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Session</h4>
      </div>
      <div class="modal-body">
      <div class="">
       <input class="form-control col-md-10" style="width: 70%;" type="text" name="{{$show}}_{{$col->Field}}_session"   placeholder="">  
      </div>
      <div style="clear: both;">
        
      </div>
      </div>
      </div>
      </div>
      </div>
                     </td>
                  
            		</tr>
                   

            		@endif
            		@endforeach
            	</tbody>
            </table>
            </div>
                         
            @endforeach
          <div class="box-footer">
          <button type="submit"  class="btn bg-green margin pull-right">Save</button>	
          </div>
  
            </form>

            </div>
            </div>
            </div>
            </div>
            </section>
              


@endsection