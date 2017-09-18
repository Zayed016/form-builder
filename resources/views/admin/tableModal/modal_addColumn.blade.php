 
<div id="myModalAddColumn" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Table Column Add</h4>
      </div>
      <div class="modal-body">
	<form action="{{Route('saveColumn',Request::segment(3))}}" method="post" accept-charset="utf-8">
{{csrf_field()}}
           <div class="form-group">
       <input type="text" value="{{old('name')}}" class="form-control" required name="name" placeholder="Column Name...">
       </div>
        <div class="form-group col-md-6 col-xs-12">
       <select name="type" class="form-control select2" style="width: 100%;">
      <option value="int">Integer</option>
      <option value="varchar">String</option>
      <option value="text">Text</option>
      <option value="date">Date</option>
      <option value="datetime">Date & Time</option>
      
       </select>
         </div>
      <div class="form-group col-md-6 col-xs-12">
        
      
       <input type="number" value="{{old('number')}}" class="form-control" required name="number" placeholder="Column length...">
</div> 
   <div class="form-group col-md-6 col-xs-12">
        
      
       <input type="text" value="" class="form-control"  name="default" placeholder="Column default value...">
</div> 
  <div class="form-group col-md-6 col-xs-12">
       <label>Null</label>&nbsp; &nbsp;
      <input  type="checkbox"  name="null" value="1" >
</div> 
      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn bg-green margin">Save</button>
      </div>

	</form>
    </div>

  </div>
</div>
