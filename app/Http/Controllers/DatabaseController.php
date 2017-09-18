<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\AdminModel;
use App\DatabaseModel;
use App\DutyModel;
use App\CommonModel;
use Session;
use View;
use Auth;
use DB;
use Route;

class DatabaseController extends Controller
{
     protected $projects;



    public function __construct()
    { 

       $this->middleware(function ($request, $next) {

            $this->projects = Auth::user()->projects;

            return $next($request);
        });
   
    
    }

  	public function tableList(){

  		 
  	$get=DatabaseModel::getTablesFromDB();
    
    Session::flash('active', 'database');
  	return view('admin.database.tableList',['list'=>$get]);
  	}


  	public function saveTable(Request $request){
  	
    Session::flash('active', 'database');

  	$get=DatabaseModel::getTablesFromDB();

  	if(in_array(strtolower($request->input('name')),$get)){
  		return redirect()->Route('tableList')->with('fail', 'Table Already Exist');	
  	}
  	//print_r($get);
  		Schema::create($request->input('name'), function (Blueprint $table) {
			    $table->increments('id');
          $table->integer('creator')->nullable();
          $table->integer('updater')->nullable();
			   $table->timestamps();
        
			});

  		return redirect()->Route('tableList')->with('success', 'Table Name Added Successfully');
  	}

  	public function updateTable(Request $request){

      Session::flash('active', 'database');

  		$get=DatabaseModel::getTablesFromDB();

  	if(in_array(strtolower($request->input('name')),$get)){
  		return redirect()->Route('tableList')->with('fail', 'Table Already Exist');	
  	}
  	//print_r($get);
  		Schema::rename($request->input('old'), $request->input('name'));
  		return redirect()->Route('tableList')->with('success', 'Table Name Updated Successfully');
  	}

  	public function emptyTable($table){
  		DB::table($table)->truncate();
  		return redirect()->Route('tableList')->with('success', 'Table Truncate Successfully');
  	}

  	public function deleteTable($table){
  		Schema::dropIfExists($table);
  		
  		return redirect()->Route('tableList')->with('success', 'Table Deleted Successfully');
  	}

  	public function tableColumnlist($table){

     Session::flash('active', 'database');
      
  	$get=Schema::getColumnListing($table);

  	$columns = DatabaseModel::getTableColumnDetails($table);

  	return view('admin.database.tableColumnlist',['data'=>$columns]);
  	}

  	public function saveColumn($table_name,Request $request){

      Session::flash('active', 'database');

  		DatabaseModel::saveColumninDB($table_name, $request);

  		return redirect()->Route('tableColumnlist',$table_name)->with('success', 'Table Column Added Successfully');
  	}

  	public function updateColumn($table_name,Request $request){

      Session::flash('active', 'database');

  		DatabaseModel::updateColumninDB($table_name, $request);

  		return redirect()->Route('tableColumnlist',$table_name)->with('success', 'Table Column Added Successfully');
  	}

  	public function deleteTableColumn($table_name,$column_name){
  		
  		Schema::table($table_name, function (Blueprint $table) use($column_name) {
   	 	$table->dropColumn($column_name);
		});
      Session::flash('active', 'database');

		return redirect()->Route('tableColumnlist',$table_name)->with('success', 'Table Column Deleted Successfully');
  	}

    public function getTablesForForm(Request $request){

      Session::flash('active', 'database');

      if($request->input('tables')=='') return redirect()->route('tableList')->with('fail','Must Select at least one table');
      $id=DatabaseModel::saveFormName($request);

      return redirect()->route('selectColumnforForm',$id)->with('success','Form Created, Select Table Column');

    }

    public function selectColumnforForm($id){

      $get=DatabaseModel::getFormToEdit($id);

      Session::flash('active', 'database');

      return view('admin.database.selectColumnforForm',['data'=>$get]);
    }

    public function makeForm($id,Request $request){

      DatabaseModel::addFormProperty($id,$request);
  
      Session::flash('active', 'database');

      return redirect()->route('editformInputType',$id)->with('success','Column Successfully Added, Select Input Type');

    }

    public function editformInputType($id){

      $get=DB::table('form_property')->where('form_id',$id)->orderby('order','asc')->get();

      Session::flash('active', 'database');
      
     return view('admin.database.editformInputType',['data'=>$get]);

    }

    public function updateFormInputField($id,Request $request){

      DatabaseModel::updateFormProperty($id,$request);

      Session::flash('active', 'database');
      
      return redirect()->back()->with('success','Form field updated Successfully');
    }

    public function saveOption($id,Request $request){
      
      //$delOld=DB::table('form_options')->where('form_property_id',$id)->delete();
  
      foreach($request->input() as $key => $value){
       if($key!='_token'){
        if( strpos( $key, 'old' ) !== false ) {
        $get=explode(',',$key);
        if($value==''){
            DB::table('form_options')->where('id',$get[1])->where('form_property_id',$id)->delete();
        }else{
        DB::table('form_options')->where('id',$get[1])->where('form_property_id',$id)->update(array(
            'name'=>$value,
            'updated_at'=>date('Y-m-d H:i:s'),
          ));
          }
        }elseif( $value!=''){
          
          DB::table('form_options')->insert(array(
            'form_property_id'=>$id,
            'name'=>$value,
            'created_at'=>date('Y-m-d H:i:s'),
          ));
        }
      }
    }
      
      Session::flash('active', 'database');
      
      return redirect()->back()->with('success','Select options updated Successfully');
    }

    public function formList(){

      $get=DB::table('forms')->get();

      Session::flash('active', 'database');
      
      return view('admin.database.formList',['list'=>$get]);
    }

    public function formAddData($id){

        $get=DB::table('form_property')->where('form_id',$id)->where('in_form',1)->orderby('order','asc')->get();

        $name=DB::table('forms')->where('id',$id)->value('name');
      
      Session::flash('active', 'database');

      if($id<6)  Session::flash('active', 'finance');

        return view('admin.database.formAddData',['list'=>$get,'name'=>$name]);

    }

    public function submitForm($id,Request $request){

      
      Session::flash('active', 'database');
      if($id==4){
        if($request->input('transactions_receivable_amount')<$request->input('transactions_paid_amount'))
         return redirect()->back()->with('fail','Receivable Amount Can not be less than Paid amount');
      }
      if($id==5){
        if($request->input('transactions_payable_amount')<$request->input('transactions_paid_amount'))
         return redirect()->back()->with('fail','Payable Amount Can not be less than Paid amount');
      }

      $get=DB::table('forms')->where('id',$id)->first();

      
      $tables=explode(',',$get->tables);

      if(($key = array_search($get->primary_table, $tables)) !== false) {
        unset($tables[$key]);
      }
     
      array_unshift($tables,$get->primary_table);

      
      foreach($tables as  $key => $table){

      $check=Schema::getColumnListing($table);
      
        $into=array(
            'created_at'=>date('Y-m-d H:i:s'),

            );
        if(Auth::user()){
          $into['creator']=Auth::user()->id;
          $into['updater']=Auth::user()->id;
        }
      foreach($request->file() as  $key3 => $val){

            if($files = $request->hasFile($key3) && strpos($key3, $table.'_') !== false )
            {

              $fileArr=array();
                $files = $request->file($key3);
                $destinationPath = 'public/documents';
                foreach ($files as $file) {
                     $orginalName=$file->getClientOriginalName();
                     $filename =$orginalName.'_;'.time().'.'.$file->getClientOriginalExtension();
                     $upload_success = $file->move($destinationPath, $filename);

                  array_push($fileArr,$filename);
                     
                }
                $into[str_replace($table.'_','',$key3)]=serialize($fileArr);                 
             }
      }
  
      foreach($request->input() as $key2 => $value){
     
          if ($key2!='_token'){
           if(is_array($value)) $value=serialize($value);
          $into[str_replace($table.'_','',$key2)] = $value;
            
          }

      
       } 
      if($key == 1){ 
      if(in_array(rtrim($get->primary_table,'s').'_id',$check)){
       $into[$get->primary_table.'_id']=$last;

      };

      DB::table($table)->insert($into);

                 
      }else{
        DB::table($table)->insert($into);
        $last=DB::getPdo()->lastInsertId();
      }

      
     

    }
       $foo = new DatabaseController;
    if(method_exists($foo, $get->run_function)){
      $f=$get->run_function;
      self::$f($request,0,$last);
      
    }
 
    
    if($get->redirect!='' || $get->redirect!=NULL){

          if (Route::has($get->redirect))
        {
         return redirect()->route($get->redirect)->with('success','Form Submited Successfully!');
        }elseif($get->redirect=='back'){
          
          return redirect()->back()->with('success','Form Submited Successfully!');
        }
        }
 
    return redirect()->route('formHistory',$id)->with('success','Form Submited Successfully!');
       
    }


    public function formHistory($id){

      Session::flash('active', 'database');
      
      $get=DB::table('forms')->where('id',$id)->first();

      if($id<=7)  Session::flash('active', 'finance');

      $tables=explode(',',$get->tables);
  

      if(($key = array_search($get->primary_table, $tables)) !== false) {
        unset($tables[$key]);
    }
     
      array_unshift($tables,$get->primary_table);
      
      $property=DB::table('form_property')->where('form_id',$id)->orderby('order','asc')->where('in_form',1)->get();
      

     return view('admin.database.formHistory',['tables'=>$tables,'list'=>$property,'form'=>$get]);
    }

    public function editFormHistory($form_id,$primary_id){

      Session::flash('active', 'database');
      
       $form=DB::table('form_property')->where('form_id',$form_id)->where('in_form',1)->orderby('order','asc')->get();

       $get=DB::table('forms')->where('id',$form_id)->first();

       $tables=explode(',',$get->tables);

      if(($key = array_search($get->primary_table, $tables)) !== false) {
        unset($tables[$key]);
      }
      
       if($form_id<6)  Session::flash('active', 'finance');

      array_unshift($tables,$get->primary_table);

      return view('admin.database.editFormHistory',['list'=>$form,'property'=>$get]);    

    }

    public function updateSubmitedForm($id,$primary_id,Request $request){

      Session::flash('active', 'database');
      
      $get=DB::table('forms')->where('id',$id)->first();

      $tables=explode(',',$get->tables);

      if(($key = array_search($get->primary_table, $tables)) !== false) {
        unset($tables[$key]);
      }
     
      array_unshift($tables,$get->primary_table);

         $foo = new DatabaseController;
    if(method_exists($foo, $get->run_function)){
      $f=$get->run_function;
      self::$f($request,$primary_id,0);
      
    }
      
      foreach($tables as  $key => $table){

      $check=Schema::getColumnListing($table);
      
        $into=array(
            'updated_at'=>date('Y-m-d H:i:s'),

            );
         if(Auth::user()){
          $into['creator']=Auth::user()->id;
          $into['updater']=Auth::user()->id;
        }
      foreach($request->file() as  $key3 => $val){

            if($files = $request->hasFile($key3) && strpos($key3, $table.'_') !== false )
            {

              $fileArr=array();
                $files = $request->file($key3);
                $destinationPath = 'public/documents';
                foreach ($files as $file) {
                     $orginalName=$file->getClientOriginalName();
                     $filename =$orginalName.'_;'.time().'.'.$file->getClientOriginalExtension();
                     $upload_success = $file->move($destinationPath, $filename);

                  array_push($fileArr,$filename);
                     
                }
                $into[str_replace($table.'_','',$key3)]=serialize($fileArr);                 
             }
      }
  
      foreach($request->input() as $key2 => $value){
        
          if (strpos($key2, $table.'_') !== false) {
         
              if(is_array($value)) $value=serialize($value);

          $into[str_replace($table.'_','',$key2)] = $value;
            
          }

      
       } 
      if($key !== 0){ 
      if(in_array(rtrim($get->primary_table,'s').'_id',$check)){
       //$into[$get->primary_table.'_id']=$primary_id;

      };

      DB::table($table)->where(rtrim($get->primary_table,'s').'_id',$primary_id)->update($into);

                 
      }else{
        DB::table($table)->where('id',$primary_id)->update($into);
        
      }

   
    }

    if($get->redirect!='' || $get->redirect!=NULL){
      if (Route::has($get->redirect))
    {
     return redirect()->route($get->redirect)->with('success','Form Submited Successfully!');
    }elseif($get->redirect=='back'){
      
      return redirect()->back()->with('success','Form Submited Successfully!');
    }
    }

return redirect()->route('formHistory',$id)->with('success','Form Data Updated Successfully!');
    }

    public function deleteFormData($form_id,$primary_id){
      
            $table=DB::table('forms')->where('id',$form_id)->value('tables');
      
            $get=DB::table($table)->where('id',$primary_id)->delete();
      
            Session::flash('active', 'database');
            
            return redirect()->route('formHistory',$form_id)->with('success','Form Data Deleted Successfully!');
      
    }

    public function saveDynamicOption($id,Request $request){


      Session::flash('active', 'database');
      if($request->input('multiple')){
        $multiple=1;
      }else{
        $multiple=0;
      }
      DB::table('form_property')->where('id',$id)->update(array(
        'dynamic_column'=>$request->input('dynamic_column'),
        'multiple'=>$multiple,
        ));

      return redirect()->back()->with('success','Form Data Updated Successfully!');

    }

}
