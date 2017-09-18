 
<div id="myModalAddTable" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Table Add</h4>
      </div>
      <div class="modal-body">
	<form action="{{Route('saveTable')}}" method="post" accept-charset="utf-8">
{{csrf_field()}}
       <div class="form-group">
       <input type="text" value="{{old('name')}}" class="form-control" required name="name" placeholder="Table Name...">
</div>  
      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn bg-green margin">Save</button>
      </div>

	</form>
    </div>

  </div>
</div>
