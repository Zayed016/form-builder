@extends('layouts.layoutadminForm')
@section('content')
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
    
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Form Submit </h3>
              
            </div>
            <!-- /.box-header -->
             <form  role="form" method="POST" enctype="multipart/form-data" action="{{Route('updateSubmitedForm',[Request::segment(3),Request::segment(4)])}}">
             {{csrf_field()}}
            <div class="box-body">
     
         @foreach($list as $data)
         

         <div class=" form-group @if($data->type=='textarea') col-xs-12 @else  col-xs-12 col-md-6 @endif">
     
   @if($data->type=='select')
       <label>
          @if($data->label!='' || $data->label!=NULL )
        {{$data->label}}
        @else
        {{$data->column_name}}
        @endif
        @if($data->required==1)
        <span class="required">*</span>
        @endif
        </label>
    <select class="form-control select2" style="width: 100%;" @if($data->multiple==1) name="{{$data->table_name}}_{{$data->column_name}}[]" multiple  @else  name="{{$data->table_name}}_{{$data->column_name}}" @endif placeholder="{{$data->placeholder}}" >
    @if($data->dynamic_table==NULL || $data->dynamic_table=='')
    <?php $options=App\DatabaseModel::getFormOptions($data->id) ?>
    @foreach($options as $option)
    <option value="{{$option->name}}" 
    @if($data->multiple==0)
    @if(App\DatabaseModel::formInputValue($data->table_name,$property->primary_table,$data->column_name,Request::segment(4))==$option->name) selected
      @endif 
    @elseif($data->multiple==1)
    @if(in_array($option->name,App\DatabaseModel::formSerilizeInputValue($data->table_name,$property->primary_table,$data->column_name,Request::segment(4)))) selected
      @endif     @endif
   
      >{{$option->name}}</option>
    @endforeach
    @else
     <?php $options=App\DatabaseModel::getDynamicOptions($data->dynamic_table); ?>
     @foreach($options as $option)
     <option value="{{$option->id}}" 
          @if($data->multiple==0)
    @if(App\DatabaseModel::formInputValue($data->table_name,$property->primary_table,$data->column_name,Request::segment(4))==$option->id) selected
      @endif 
    @elseif($data->multiple==1)
    @if(@in_array($option->id,App\DatabaseModel::formSerilizeInputValue($data->table_name,$property->primary_table,$data->column_name,Request::segment(4)))) selected
      @endif 
    @endif >
      @php $dc=$data->dynamic_column; @endphp
      @if($dc) {{$option->$dc}} @else {{$option->id}} @endif
      </option>
     @endforeach
    @endif

    </select>

   @elseif($data->type=='radio')
        <label>
          @if($data->label!='' || $data->label!=NULL )
        {{$data->label}}
        @else
        {{$data->column_name}}
        @endif
        </label>
        <br>
    <?php $radios=App\DatabaseModel::getFormOptions($data->id) ?>

    @foreach($radios as $radio)
    <label><input type="radio" name="{{$data->table_name}}_{{$data->column_name}}"
     @if(App\DatabaseModel::formInputValue($data->table_name,$property->primary_table,$data->column_name,Request::segment(4))==$radio->name) checked  @endif 
      value="{{$radio->name}}">&nbsp;&nbsp;{{$radio->name}}</label>&nbsp;&nbsp;&nbsp;
    @endforeach
    @elseif($data->type=='checkbox')
    

    <label ><input  name="{{$data->table_name}}_{{$data->column_name}}" type="{{$data->type}}" value="1"
    @if(App\DatabaseModel::formInputValue($data->table_name,$property->primary_table,$data->column_name,Request::segment(4))==1) checked  @endif   >
      @if($data->label!='' || $data->label!=NULL )
        {{$data->label}}
        @else
        {{$data->column_name}}
        @endif</label>

    

     @elseif($data->type=='textarea')
               <label>
          @if($data->label!='' || $data->label!=NULL )
        {{$data->label}}
        @else
        {{$data->column_name}}
        @endif

        </label>
         
    <textarea class="form-control" rows="4"  name="{{$data->table_name}}_{{$data->column_name}}"  placeholder="{{$data->placeholder}}">
    {{App\DatabaseModel::formInputValue($data->table_name,$property->primary_table,$data->column_name,Request::segment(4))}}</textarea>
     @elseif($data->type=='file')
           <label>
          @if($data->label!='' || $data->label!=NULL )
        {{$data->label}}
        @else
        {{$data->column_name}}
        @endif
        @if($data->required==1)
        <span class="required">*</span>
        @endif
        </label>
         
      <input class="form-control" name="{{$data->table_name}}_{{$data->column_name}}[]" multiple="true" type="file"  >
    <small class="pull-right">New Files will replace old files</small>
 <?php $sel = @unserialize(App\DatabaseModel::formInputValue($data->table_name,$property->primary_table,$data->column_name,Request::segment(4))); ?>
@if ($sel !== false) 
<br>
  @foreach($sel as $doc)

 <a target="_blank" class="fa  fa-download" href="{{asset('public/documents/'.$doc)}}">  </a>&nbsp;&nbsp;{{strstr($doc, '_;', true)}}<br>
  @endforeach
  @else
             <b> No Previous File </b>
@endif
   @else
          <label>
          @if($data->label!='' || $data->label!=NULL )
        {{$data->label}}
        @else
        {{$data->column_name}}
        @endif
        @if($data->required==1)
        <span class="required">*</span>
        @endif
        </label>
         
      @if($data->type=='date' || $data->type=='datetime' ) 
        <?php $type='text' ?>
        @else
         <?php $type=$data->type; ?>
      @endif
   <input class="form-control @if($data->type=='date') datepicker @endif @if($data->type=='datetime') datetimepick @endif "
    name="{{$data->table_name}}_{{$data->column_name}}" 
    value="{{App\DatabaseModel::formInputValue($data->table_name,$property->primary_table,$data->column_name,Request::segment(4))}}"
     type="{{$type}}" @if($data->required==1) required @endif >
    
   @endif
   </div>

 @endforeach
        </div>
            <!-- /.box-body -->
             <div class="box-footer" style="padding-right: 130px;">
                <button type="submit" class="btn btn-primary pull-right" >Submit</button>
              </div>


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



