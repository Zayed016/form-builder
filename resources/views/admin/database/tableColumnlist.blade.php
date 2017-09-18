@extends('layouts.layoutadminTable')
@section('content')

<div class="col-md-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Table Column List</h3>
        
                 <a title="Add Column"  style="font-size: 35px;cursor: pointer;" class="fa fa-plus-circle pull-right margin" data-toggle="modal" data-target="#myModalAddColumn"></a>
         
            </div>
  
           @include('admin.tableModal.modal_addColumn')
          
            <div class="box-body  table-responsive">
           
              <table id="example1" class="text-center table-horizantal table table-bordered table-striped">

                <thead>
                <tr>
                <th>#</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Null</th>
                  <th>Default</th>

                <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                <?php $num=1; ?>
         @foreach($data as $show)
         @if($show->Field!='id' && $show->Field!='created_at' && $show->Field!='updated_at' && $show->Field!='creator' && $show->Field!='updater')
    		<div id="myModalEditColumn{{$num}}" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Table Column Add</h4>
      </div>
      <div class="modal-body">
  <form action="{{Route('updateColumn',Request::segment(3))}}" method="post" accept-charset="utf-8">
{{csrf_field()}}
<input type="hidden" value="{{$show->Field}}" class="form-control" required name="old" placeholder="Column Name...">
           <div class="form-group">
       <input type="text" value="{{$show->Field}}" class="form-control" required name="name" placeholder="Column Name...">
       </div>
        <div class="form-group col-md-6 col-xs-12">
       <select name="type" class="form-control">
      <option @if(strpos($show->Type, 'int') !== false) selected  @endif value="INT" >Integer</option>
      <option @if(strpos($show->Type, 'char') !== false) selected  @endif value="varchar">String</option>
      <option @if(strpos($show->Type, 'text') !== false) selected  @endif  value="text">Text</option>
      <option @if(strpos($show->Type, 'date') !== false) selected  @endif  value="date">Date</option>
      <option   @if(strpos($show->Type, 'datetime') !== false) selected  @endif  value="datetime">Date & Time</option>
      
       </select>
         </div>
      <div class="form-group col-md-6 col-xs-12">
        <?php $length=explode('(',$show->Type);
       
          if(array_key_exists('1',$length))
          $number=rtrim($length[1],')');
          else $number=NULL;
         ?>
        
       <input type="number" value="{{$number}}" max="4294967295" class="form-control"  name="number" placeholder="Column length...">
</div> 
   <div class="form-group col-md-6 col-xs-12">
        
      
       <input type="text" value="{{$show->Default}}" class="form-control" name="default" placeholder="Column default value...">
</div> 
  <div class="form-group col-md-6 col-xs-12">
       <label>Null</label>&nbsp; &nbsp;
      <input  type="checkbox" @if($show->Null=='YES') checked @endif  name="null" value="1" >
</div> 
      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn bg-green margin">Save</button>
      </div>

  </form>
    </div>

  </div>
</div>
                <tr>
                  <td>{{$num}}</td>
                  <td>{{$show->Field}}</td>
                   <td>{{$show->Type}} </td> 
                   <td>{{$show->Null}}</td> 
                   <td>{{$show->Default}}</td>
                   <td style="font-size: 20px;">
                   
                  <i style="color:green;cursor: pointer;" class="fa fa-pencil-square-o" data-toggle="modal" data-target="#myModalEditColumn{{$num}}" aria-hidden="true"></i>
                  
                   
                   <a title="Delete Table" onclick="return confirm('Are You sure?')" href="{{Route('deleteTableColumn',[Request::segment(3),$show->Field])}}"><i style="color:red;" class="fa fa-times" aria-hidden="true"></i></a>
                     
                  
                  </td>
                </tr>
                <?php $num++; ?>
 
     

    </div>

  </div>
</div>
@endif
 @endforeach
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
  
</div>

@endsection