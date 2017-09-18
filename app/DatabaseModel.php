<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PDO;

class DatabaseModel extends Model
{
   static public function getTablesFromDB(){
   		
      $tables = array_map('reset', \DB::select('SHOW TABLES'));
    
  	return $tables;
   }
   static public function saveColumninDB($table_name, $request){


   		  	Schema::table($table_name, function (Blueprint $table) use ($request,$table_name) {

   		  		$null=$request->input('null');
   		  
   		  		$name=str_replace(" ","",$request->input('name'));
   		  		$type=$request->input('type');
   		  		$num=$request->input('number');
   		  		$def=str_replace(" ","",$request->input('default'));

   		  	$sql="ALTER TABLE $table_name ADD  `$name` $type ".($num!='' ? '('.$num.')': '') ." ".($null==1 ? 'NULL': 'NOT NULL') ." ".($def!='' ? 'DEFAULT '.$def.'' : '') ." ";
   				
   		 
   		  DB::connection()->getPdo()->exec($sql);
  	
	});
   }

   static public function updateColumninDB($table_name, $request){

   		  	Schema::table($table_name, function (Blueprint $table) use ($request,$table_name) {
   		  		$null=$request->input('null');
   		  		$old=$request->input('old');
   		  		$name=str_replace(" ","",$request->input('name'));
   		  		$type=$request->input('type');
   		  		$num=$request->input('number');
   		  		$def=str_replace(" ","",$request->input('default'));

        	$sql="ALTER TABLE $table_name CHANGE `$old` `$name` $type ".($num!='' ? '('.$num.')': '') ." ".($null==1 ? 'NULL': 'NOT NULL') ." ".($def!='' ? 'DEFAULT '.$def.'' : '') ." ";

   		 
   		  DB::connection()->getPdo()->exec($sql);
  	
	});
   }


   static public function saveFormName($request){

      DB::table('forms')->insert(array(
        'name'=>$request->input('form_name'),
        'tables'=>$request->input('tables'),
        'can_edit'=>1,
        'created_at'=>date('Y-m-d H:i:s'),
        ));

      return DB::getPdo()->lastInsertId();
   }


   static public function getFormToEdit($id){

    return DB::table('forms')->where('id',$id)->first();

   }

   static public function getTableColumns($table){

      return Schema::getColumnListing($table);
   }

   static public function checkColumn($form_id,$table,$column){

     return DB::table('form_property')
                ->where('table_name',$table)
                ->where('column_name',$column)
                ->where('form_id',$form_id)
                
                ->first();
   }

   static public function addFormProperty($id,$request){

      $tables=DB::table('forms')->where('id',$id)->first();

      DB::table('forms')->where('id',$id)->update(array(
        'primary_table'=>$request->input('primary'),
        'name'=>$request->input('name'),
        'type'=>$request->input('type'),
        'redirect'=>$request->input('redirect'),
        'run_function'=>$request->input('run_function'),
        'can_edit'=>$request->input('edit'),
        ));

       $tbl=explode(',',$tables->tables);
      DB::table('form_property')->where('form_id',$id)->update(array('active'=>0));
      foreach($tbl as $tb){
        if($request->input($tb))
              foreach($request->input($tb) as $cl){
      $bool=DB::table('form_property')->where('form_id',$id)->where('table_name',$tb)->where('column_name',$cl)->count();
     
      if($bool){
     
$update=array( 'form_id'=>$id,
        'table_name'=>$tb,
        'column_name'=>$cl,
        'dynamic_table'=>NULL,
        'session'=>$request->input($tb.'_'.$cl.'_session'),
        'updated_at'=>date('Y-m-d H:i:s'),
        'active'=>1,);
          
        DB::table('form_property')
            ->where('form_id',$id)
            ->where('table_name',$tb)
            ->where('column_name',$cl)
            ->update($update);
      }else{
      DB::table('form_property')->insert(array(
        'form_id'=>$id,
        'table_name'=>$tb,
        'column_name'=>$cl,
        'dynamic_table'=>NULL,
        'session'=>$request->input($tb.'_'.$cl.'_session'),
        'created_at'=>date('Y-m-d H:i:s'),
        'active'=>1,
        ));
        }
         if($request->input($tb.'_'.$cl.'_id_get')==1){
        DB::table('form_property')
            ->where('form_id',$id)
            ->where('table_name',$tb)
         
            ->where('column_name',$cl)
            ->delete();
      }elseif($request->input($tb.'_'.$cl.'_id_get')==0){
         DB::table('form_property')
            ->where('form_id',$id)
            ->where('table_name',$tb)
            
            ->where('column_name',$cl)
            ->update(array(
              'dynamic_table'=>$request->input($tb.'_'.$cl.'_dynamic_table'),
            'type'=>'select',
              ));      
         }elseif($request->input($tb.'_'.$cl.'_id_get')==2){
           
         }
      }
 
    }
    DB::table('form_property')->where('form_id',$id)->where('active',0)->delete();
   }

   static public function updateFormProperty($id,$request){

  
    $type=$request->input('field_type');
    $placeholder=$request->input('placeholder');
    $label=$request->input('label');
    $order=$request->input('order');
    $required=$request->input('required');
    $In_form=$request->input('in_form');
    $In_list=$request->input('in_list');
    
     DB::statement("UPDATE form_property SET `order` = '$order',  type='$type', placeholder = '$placeholder', label = '$label',   ".($required==1 ? 'required = "1"': 'required = "0"').", ".($In_form==1 ? 'in_form = "1"': 'in_form = "0"').", ".($In_list==1 ? 'in_list = "1"': 'in_list = "0"')." where form_property.id = $id");
   }

   static public function getFormOptions($id){

      return DB::table('form_options')->where('form_property_id',$id)->get();
   }

   static public function getTableColumnDetails($table){

    return DB::select('show columns from ' . $table);

   }

   static public function getFormHistory($table){

    
   }

   static public function getFormTableColumn($id,$table){

    return DB::table('form_property')->where('form_id',$id)->where('table_name',$table)->orderby('order','asc')->where('in_list',1)->get();  

   }

   static public function getFormTableColumnItems($table){
  
     if(count($table)==2){
       $get=DB::table($table[0])->join($table[1],$table[0].'.id','=',$table[1].'.'.rtrim($table[0],"s").'_id')
       ->select($table[1].".*",$table[0].".*",$table[0].".id as primary_id")->orderby($table[0].".id",'desc')->get();
      
     }elseif(count($table)==3){

        $get=DB::table($table[0])->join($table[1],$table[0].'.id','=',$table[1].'.'.rtrim($table[0],"s").'_id')
                                ->join($table[2],$table[0].'.id','=',$table[2].'.'.rtrim($table[0],"s").'_id')
                                ->select($table[2].".*",$table[1].".*",$table[0].".*",$table[0].".id as primary_id")
                                ->orderby($table[0].".id",'desc')->get();

     }elseif(count($table)==1){
         $get=DB::table($table[0])->select($table[0].".*",$table[0].".id as primary_id")->orderby($table[0].".id",'desc')->get();
        
     }else{
      $get=array();
     }

      return  $get;
   }

   static public function formInputValue($table,$primary_table,$column,$primary_id){

    if($table==$primary_table){
      return DB::table($table)->where('id',$primary_id)->value($column);
    }else{
      return DB::table($table)->where($primary_table.'_id',$primary_id)->value($column);
    }

   }  

   static public function formSerilizeInputValue($table,$primary_table,$column,$primary_id){

    if($table==$primary_table){
      return @unserialize(DB::table($table)->where('id',$primary_id)->value($column));
    }else{
      return @unserialize(DB::table($table)->where($primary_table.'_id',$primary_id)->value($column));
    }

   }  

   static public function getDynamicOptions($table){
    return DB::table($table)->get();
   }

   static public function getForignKeyValue($id,$table,$value){

     
      $get=DB::table($table)->where('id',$id)->value($value);
      if($get){
        return $get;
      }else return false;
      
   }

   static public function getSelectedDynamiicTable($form_id,$table,$column){

      return DB::table('form_property')->where('form_id',$form_id)->where('table_name',$table)->where('column_name',$column)->value('dynamic_table');
   }

   static public function isColumnDynamic($form_id,$column){
     return DB::table('form_property')->where('form_id',$form_id)->where('column_name',$column)->where('type','select')->where('dynamic_table','!=',NULL)->first();
   }
}

