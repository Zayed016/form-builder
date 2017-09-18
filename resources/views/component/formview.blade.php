       {{csrf_field()}}
        

<div class="box-body">
      
         @foreach($list as $data)
      
   @php
   $ses=NULL;
   if($data->session!='' || $data->session!=NULL )
       if(Session::has($data->session))   $ses=Session($data->session);

   @endphp

         <div class="form-group @if($data->type=='textarea') col-xs-12 @else  col-xs-12 col-md-6 @endif @if($data->session!='' || $data->session!=NULL ) hidden @endif"  >
    
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
        
    <select class="form-control select2" style="width: 100%;" @if($data->required==1) required @endif @if($data->multiple==1) multiple name="{{$data->table_name}}_{{$data->column_name}}[]" @else name="{{$data->table_name}}_{{$data->column_name}}" @endif    >
    <option value="">Select Option</option>
    @if($data->dynamic_table==Null || $data->dynamic_table=='')
    <?php $options=App\DatabaseModel::getFormOptions($data->id) ?>
    
    @foreach($options as $option)
    <option value="{{$option->name}}"  @if($ses==$option->name) selected @endif  >{{$option->name}}</option>
    @endforeach
    @else
     <?php $options=App\DatabaseModel::getDynamicOptions($data->dynamic_table); ?>
      @foreach($options as $option)
      @php if($data->dynamic_column=='' || $data->dynamic_column==NULL ) $name='id'; else $name=$data->dynamic_column; @endphp
    <option value="{{$option->id}}" >{{$option->$name}}</option>
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
         @if($data->required==1)
        <span class="required">*</span>
        @endif
        </label>
        <br>
    <?php $radios=App\DatabaseModel::getFormOptions($data->id) ?>

    @foreach($radios as $radio)
    <label><input type="radio" name="{{$data->table_name}}_{{$data->column_name}}"  @if($ses==$option->id) Checked @endif value="{{$radio->name}}">&nbsp;&nbsp;{{$radio->name}}</label>&nbsp;&nbsp;&nbsp;
    @endforeach
    @elseif($data->type=='checkbox')
    <h3></h3>
    <label ><input  name="{{$data->table_name}}_{{$data->column_name}}" type="{{$data->type}}" value="1" >  @if($data->label!='' || $data->label!=NULL )
        {{$data->label}}
        @else
        {{$data->column_name}}
        @endif</label>
    <h3></h3>
     @elseif($data->type=='textarea')
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
         
    <textarea class="form-control" rows="4"  name="{{$data->table_name}}_{{$data->column_name}}"  placeholder="{{$data->placeholder}}">{{$ses}}</textarea>
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
         
      <input class="form-control" name="{{$data->table_name}}_{{$data->column_name}}[]" multiple="true" type="file" @if($data->required==1) required @endif >
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

   <input class="form-control @if($data->type=='date')  datepicker @endif @if($data->type=='datetime') datetimepick @endif " name="{{$data->table_name}}_{{$data->column_name}}"  value="{{$ses}}"  placeholder="{{$data->placeholder}}"  type="{{$type}}" @if($data->required==1) required @endif >
    
   @endif
   </div>

 @endforeach
        </div>


            <!-- /.box-body -->
             <div class="box-footer" >
                <button type="submit" class="btn btn-primary pull-right" >Submit</button>
              </div>
