@extends('layouts.layoutadminTable')
@section('content')

<script>
   
  function getAllCheckbox(){

 var vals=[];
var checkboxes = document.getElementsByClassName('tablesList');

for (var i=0, n=checkboxes.length;i<n;i++) 
{
    if (checkboxes[i].checked) 
    { 
       var bool=vals.indexOf(checkboxes[i]);
       console.log(bool);
       if(bool>-1){
                   
                  }else{
                    vals.push(checkboxes[i].value);
                    
                  }
           
    }
}
 document.getElementById('tbl').value=vals;


 }

 </script>

<div class="col-md-12" >

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Table List</h3>

                    <a title="Add Table"   style="font-size: 35px;cursor: pointer;" class="fa fa-plus-circle pull-right margin" data-toggle="modal" data-target="#myModalAddTable" ></a>

            </div>
            <form  action="{{Route('getTablesForForm')}}" method="post" accept-charset="utf-8">
              
          {{csrf_field()}}
       <label style="color:#9e200a;font-size: 17px;" onclick="ForForm()" class="col-xs-4  ">
              Select Table to make form
            </label>
            <input type="hidden" id="tbl" name="tables" value="">
            
            <button  type="button" onclick="getAllCheckbox()" class="btn bg-purple"  data-toggle="modal" data-target="#myModalMakeForm">Make Form</button>
       
        <div id="myModalMakeForm" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4>Create Form</h4>

       </div>
        <div class="modal-body">
      <div class="form-group margin">
    <label class="col-xs-3 control-label">Form Name   <span class="required">*</span></label>
    <div class="col-xs-8">
 <input type="text" class="form-control" name="form_name" value="" required placeholder="Name of Form">      
    </div>
   
    </div>
    <div >
      
    </div>
    </div>
     
  <div class="modal-footer">
        <button type="submit"  class="btn bg-green margin">Save</button>
      </div>
      </div>
          
      </div>
      </div>
            </form>
             
            
           
            @include('admin.tableModal.modal_addTable')
            
            <div class="box-body  table-responsive">
           
              <table id="accessTable" class="text-center table-horizantal table table-bordered table-striped">

                <thead>
                <tr>
                <th>#</th>
                  <th>Name</th>
                  <th>Action</th>

                </tr>
                </thead>
                <tbody>
                <?php $num=1; ?>
         @foreach($list as $data)
    		
                <tr>
                <td>
            <input type="checkbox" class="tablesList" onclick="getAllCheckbox()" name="tablesList[]" value="{{$data}}">&nbsp;


                {{$num}}</td>
                  <td>{{$data}}</td>
                  <td style="font-size: 20px;">
                        
          
                  <a title="Table Column" href="{{Route('tableColumnlist',$data)}}"><i style="color:#0073b7;" class="fa fa-list-ul" aria-hidden="true"></i></a>&nbsp;
                   
                  <a title="Edit"><i style="color:green;cursor: pointer;" class="fa fa-pencil-square-o" data-toggle="modal" data-target="#myModalEditTable{{$data}}" aria-hidden="true"></i></a>&nbsp;
                 
                   
                  <a title="Empty Table" onclick="return confirm('Are You sure?')" href="{{Route('emptyTable',$data)}}"><i style="color:#f4645f;" class="fa fa-trash" aria-hidden="true" ></i></a>&nbsp;
              
                   
                  <a title="Delete Table" onclick="return confirm('Are You sure?')" href="{{Route('deleteTable',$data)}}"><i style="color:red;" class="fa fa-times" aria-hidden="true"></i></a>
                  
                  </td>

                </tr>
                <?php $num++; ?>
                  <div id="myModalEditTable{{$data}}" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Table Edit</h4>
      </div>
      <div class="modal-body">
      <form action="{{Route('updateTable')}}" method="post" accept-charset="utf-8">
 
	{{csrf_field()}}
       <div class="form-group">
       <input type="hidden" name="old" value="{{$data}}">
   <label class="col-xs-3 control-label">Table Name <span class="required">*</span></label> 
   <div class="col-xs-8">
    <input type="text" name="name" class="form-control" required value="{{$data}}"> 
   </div>
   <div style="clear:both;">
</div>
</div>  

      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn bg-green margin">Update</button>
      </div>

      </form>
    </div>

  </div>
</div>
 @endforeach
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
  
</div>

@endsection