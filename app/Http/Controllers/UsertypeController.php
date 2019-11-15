<?php

/*
  Hardik Ponkiya
  Date:24-8-18
*/

namespace App\Http\Controllers;

use App\Model\Usertype;
use App\Model\Accesstype;
use App\Model\Allowuser;
use Illuminate\Http\Request;

class UsertypeController extends Controller
{
    public $route = 'usertype';
    public $view = 'usertype';
	public $primaryId = 'id';
    public $moduleName = 'User Type';

    public function index()
    {
        $usertypes = Usertype::get();
        $title = $this->moduleName;
        $module='modal';
        $tabletype='';
        $dataurl = 'usertypedata';
        $validateurl ='checkusertype';
        $checkremote=true;
        $action = 'insert';
        $route=$this->route;
        $accesstype = Accesstype::get();
        return view($this->view.'/index',compact('usertypes','title','module','tabletype','dataurl','validateurl','checkremote','action','route','accesstype'));
    }


    /* to get data will refreshing datatable **/
    public function usertypedata()
    {
        $usertypes = Usertype::get();
        foreach($usertypes as $key=>$value)
        {
            if($value->id > 3){
                $action="<a data-toggle='modal' id='edit' data-target='#AddEditModal' data-backdrop='static' data-id='$value->id' class='btn  btn-warning  btn-xs'><i class='fa fa-pencil'></i> Edit</a>";
            }else{
                $action="";
            }

            $usertype['data'][$key]=array($key+1,$value->name,$action);
        }
        echo json_encode($usertype);
    }

    /* Duplicate Check */
    public function checkusertype(Request $request)
    {
        if($request->id==''){
            $rows = Usertype::where('name',$request->name)->count();
        }else{
            $rows = Usertype::where('name',$request->name)->where('id','!=',$request->id)->count();
        }
        if($rows > 0){
            echo json_encode(false);
        }else{
            echo json_encode(true);
        }
    }

    public function store(Request $request)
    {
        $accesstype_id = $request->accesstype_id;

        $created_by = auth()->user()->id;
        if($data = Usertype::create(array_merge($request->all(),['created_by'=>$created_by]))){
            /* to insert data in allowuser by sneha doshi on 12-09-2018 */
            $userTypeId =  $data->id;
            $allowdata = array(
                array('usertype_id'=> $userTypeId, 'accesstype_id'=>$accesstype_id,'no_of_users'=>'1','created_by'=>$created_by),
            );
            if(Allowuser::insert($allowdata)){
                echo json_encode(true);
            }else{
                echo json_encode(false);
            }
            /* end  to insert data in allowuser by sneha doshi on 12-09-2018 */
        }else{
            echo json_encode(false);
        }
    }

    public function edit($id)
    {
        $usertype = Usertype::findOrFail($id);
        $usertype['action']='update';
        $usertype['button']='Update';
        $usertype['popuptitle']='Update'.$this->moduleName;
        return $usertype;
    }

    public function update(Request $request, Usertype $usertype)
    {
        $updated_by = auth()->user()->id;
        if($usertype->update(array_merge($request->all(),['updated_by'=>$updated_by]))){
            echo json_encode(true);
        }else{
            echo json_decode(false);
        }

    }



}
