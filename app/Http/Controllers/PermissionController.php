<?php
/*
name:-Pratik
on :- 12-09-18
*/
namespace App\Http\Controllers;

use App\Model\Permission;
use Illuminate\Http\Request;
use App\User;
use App\Model\Usertype;
use App\Http\Requests\PermissionRequest;
use DB;

class PermissionController extends Controller
{
    public $route = 'permission';
    public $view = 'permission';
	public $primaryid = 'id';
    public $modulename = 'Permission';
    public $userid ='0';
    public $msgName = 'Permission';

    public function index(){
        $modulename = $this->modulename;
        $route = $this->route;
        $usertypes = Usertype::where('id','>','3')->get();
        $modules= DB::table('modules')->get();
        return view($this->view.'/create',compact('users','modulename','route','usertypes','modules'));
    }

    public function create(){

    }

    public function store(PermissionRequest $request){
        Permission::whereNotIn('module_id',$request->module_id)->where('usertype_id',$request->usertype_id)->delete();
        $count=count($request->module_id);
        for($i=0;$i<$count;$i++)
        {
            $permission = Permission::updateOrCreate(
                ['module_id' => $request->module_id[$i] ,'usertype_id'=>$request->usertype_id]
            );
            $permission->usertype_id=$request->usertype_id;
            $permission->module_id=$request->module_id[$i];

            /* View Permission */
            if(isset($request->view)){
                if(in_array($request->module_id[$i],$request->view)){
                    $permission->view=true;
                }else{
                    $permission->view=false;
                }
            }else{
                $permission->view=false;
            }
            /* Create Permission */
            if(isset($request->create)){
                if(in_array($request->module_id[$i],$request->create)){
                    $permission->create=true;
                }else{
                    $permission->create=false;
                }
            }else{
                $permission->create=false;
            }

            /* Edit Permission */
            if(isset($request->edit)){
                if(in_array($request->module_id[$i],$request->edit)){
                    $permission->edit=true;
                }else{
                    $permission->edit=false;
                }
            }else{
                $permission->edit=false;
            }
            $permission->save();
        }
        return redirect($this->route)->with('msg', 'Permission Update Successfully');
    }
    public function permissionData(Request $request){
        $usertype_id = $request->usertype_id;

        $modules= DB::table('modules')->whereIn('id',['12','13','14'])->get();
        return view($this->view.'/getPermission',compact('modules','usertype_id'));
    }
}
