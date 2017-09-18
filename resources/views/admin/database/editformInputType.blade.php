@extends('layouts.layoutadminTable')
@section('content')

<div class="col-md-12" >

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Input Field List</h3>
                   
            </div>
      
            <div class="box-body  table-responsive">
           
              <table id="example1" class="text-center table-horizantal table table-bordered table-striped">

                <thead>
                <tr>
                <th>#</th>
                  <th>Column Name</th>
                  <th>Type</th>
                  <th>Order</th>
                  <th>Label</th>
                  <th>Place Holder</th>
                  <th>Required</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=1; ?>
         @foreach($data as $show)

      		
                <tr>
                <td>{{$num}}</td>
                  <td>{{$show->column_name}}</td>
               
                  <td>{{$show->type}}
                  @if($show->type=='select' || $show->type=='radio') &nbsp;&nbsp;
                  @if($show->dynamic_table=='' || $show->dynamic_table==NULL )
                  <a href="#" data-toggle="modal" data-target="#SelectOption{{$show->id}}" title="Add Options"><i class="fa fa-plus" aria-hidden="true"></i></a>
                          <div id="SelectOption{{$show->id}}" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form action="{{Route('saveOption',$show->id)}}" method="post" accept-charset="utf-8">
  {{csrf_field()}}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Options</h4>
      </div>
      <div class="modal-body">

 
        <?php $op=App\DatabaseModel::getFormOptions($show->id) ?>
      @foreach($op as $view) 
      <div class="form-group col-md-8">
      <input type="text" class="form-control" style="width:100%;" name="oldoption,{{$view->id}}"  value="{{$view->name}}" placeholder="">
        </div>
        @endforeach
        
           <div class="form-group col-md-8">
        <input type="text" class="form-control" style="width:100%;" name="options"  value="" placeholder="">
    </div>
      <div style="clear:both;"></div>
        </div>
      
         
        <div class="modal-footer" style="clear:both;">
        <button type="submit"  class="btn bg-green margin">Save</button>
      </div>
 </div>
    </form>
  

  </div>
</div>
</div>
                  @else
                  <span>From:{{$show->dynamic_table}} </span>
                  <a href="#" data-toggle="modal" data-target="#SelectDynamicOption{{$show->id}}" title="Which Column"><i class="fa fa-plus" aria-hidden="true"></i></a>
                   <div id="SelectDynamicOption{{$show->id}}" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form action="{{Route('saveDynamicOption',$show->id)}}" method="post" accept-charset="utf-8">
  {{csrf_field()}}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Which Column To Show</h4>
      </div>
      <div class="modal-body">

   
      
        <?php $op=App\DatabaseModel::getTableColumns($show->dynamic_table) ?>
      
      <div class="form-group col-md-8">
      <select  class="select2 pull-left" name="dynamic_column" style="width: 70%;">
      @foreach($op as $view) 
      <option @if($show->dynamic_column==$view) selected @endif value="{{$view}}">{{$view}}</option>    
        @endforeach
        </select><br>
       
        <br>
        </div>
       <label class="col-xs-3 margin"><input type="checkbox" {{$show->multiple==1 ? 'checked' : ''}} name="multiple" value="1"><span>&nbsp;&nbsp;</span>Multiple</label>
        
      
        </div>
        <div class="modal-footer" style="clear:both;">
        <button type="submit"  class="btn bg-green margin">Save</button>
      </div>

    </form>
    </div>
    


  </div>
</div>
                  @endif
                  @endif
                  </td>
                  <td>{{$show->order}}</td>
                  <td>{{$show->label}}</td>
                  <td>{{$show->placeholder}}</td>
                  
                  <td>{{$show->required == 1 ? 'Yes' : 'No'}}</td>
                     <td style="font-size: 20px;">
              
                  <a title="Edit" style="cursor: pointer;"><i style="color:green;" class="fa fa-pencil-square-o" data-toggle="modal" data-target="#myModalinputField{{$show->id}}" aria-hidden="true"></i></a>&nbsp;
                 
                  </td>

                </tr>
                <?php $num++; ?>
                
                  <div id="myModalinputField{{$show->id}}" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Edit</h4>
      </div>
        <form  action="{{Route('updateFormInputField',$show->id)}}" method="post" accept-charset="utf-8">
      <div class="modal-body">
    
 
	{{csrf_field()}}
   
     
       
           <div class="form-group ">
         <label class="col-xs-3 control-label">Field Type<span class="required">*</span></label>
       <div class="col-xs-8">
         <select name='field_type' class="form-control select2" style="width: 100%;">
         <option {{$show->type=="text" ? 'selected' : ''}} value="text">Text</option>
         <option {{$show->type=="email" ? 'selected' : ''}} value="email">Email</option>
         <option {{$show->type=="password" ? 'selected' : ''}} value="password">Password</option>
         <option {{$show->type=="number" ? 'selected' : ''}} value="number">Number</option>
         <option {{$show->type=="checkbox" ? 'selected' : ''}} value="checkbox">CheckBox</option>
         <option {{$show->type=="radio" ? 'selected' : ''}} value="radio">Radio</option>
         <option {{$show->type=="textarea" ? 'selected' : ''}} value="textarea">Text Area</option>
         <option {{$show->type=="select" ? 'selected' : ''}} value="select">Select</option>
         <option {{$show->type=="date" ? 'selected' : ''}} value="date">Date</option>
         <option {{$show->type=="datetime" ? 'selected' : ''}} value="datetime">Date & Time</option>
         <option {{$show->type=="file" ? 'selected' : ''}} value="file">File</option>
         
         
         </select>
          </div>
             <div  style="clear:both;">
       
     </div>
       </div>
      <div class="form-group  ">
         <label class="col-xs-3 control-label">Order</label>
       <div class="col-xs-5">
        <input type="number" name="order" class="form-control" required value="{{$show->order}}">
          </div>
  
         <label class="col-xs-3 "><input type="checkbox" {{$show->required==1 ? 'checked' : ''}} name="required" value="1"><span>&nbsp;&nbsp;</span>Required</label>


               <div  style="clear:both;">
       
     </div>
       </div>
          <div class="form-group ">
         <label class="col-xs-3 control-label">Label</label>
       <div class="col-xs-8">
         
      
         <input type="text" name="label" class="form-control"  value="{{$show->label}}">
          </div>
            <div  style="clear:both;">
       
     </div>
       </div>
           <div class="form-group ">
         <label class="col-xs-3 control-label">Place Holder</label>
       <div class="col-xs-8">
         
      
         <input type="text" name="placeholder" class="form-control"  value="{{$show->placeholder}}">
          </div>
              <div  style="clear:both;">
       
     </div>
       </div>
                <div class="form-group col-xs-12 col-xs-offset-3">
    <label class="col-xs-3 "><input type="checkbox" {{$show->in_form==1 ? 'checked' : ''}} name="in_form" value="1"><span>&nbsp;&nbsp;</span>In Form</label>
 <label class="col-xs-3 "><input type="checkbox" {{$show->in_list==1 ? 'checked' : ''}} name="in_list" value="1"><span>&nbsp;&nbsp;</span>In List</label>

     <div  style="clear:both;">
       
     </div>
      </div>
      <div class="modal-footer" style="clear:both;">
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