<?php
/*
    By : Sneha Doshi
    On : 13 - 09 - 2018
    Desc : Set heirarchy for confirmation
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Depot;
use App\Model\Usertype;
use DB;
use App\Model\ModuleHierarchy;
class HierarchyController extends Controller
{
    public $primaryId = 'id';
    public $msgName = "Hierarchy";
	public $view = "hierarchy";
	public $routes = "hierarchy";

    public function index()
    {
        $data['route']=$this->routes;
        $data['msgName'] = $this->msgName;
        $data['modules']= DB::table('modules')->where('id','14')->get();
        return view($this->view.'.index',$data);

    }

    public function set_hierarchy($module)
    {
        $module = decrypt($module);
        $data['module'] = $module;
        $data['usertype'] = Usertype::where('id','>','3')->get();
        $data['msgName'] = 'Set '.$this->msgName;
        $data['heirarchy_data'] =ModuleHierarchy::where('module_id', $module)->orderBy('hierarchy_sequence')->get();
        $data['route']=$this->routes;
        return view($this->view.'.set_hierarchy',$data);
    }

    public function update_hierarchy(Request $request)
    {
        $module = $request->module;
        $usertype = $request->usertype;
        $sequence = $request->sequence;

        ModuleHierarchy::where('module_id', $module)->delete();

        $data = array();
        foreach( $usertype as $k => $v){
            $userData = array();
            $userData['module_id'] = $module;
            $userData['usertype_id'] = $usertype[$k];
            $userData['hierarchy_sequence'] = $sequence[$k];
            $data[] = $userData;
        }

       ModuleHierarchy::insert($data);
       return redirect($this->routes)->with('success',$this->msgName.' saved successfully');
    }
}