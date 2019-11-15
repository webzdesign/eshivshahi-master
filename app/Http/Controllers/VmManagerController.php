<?php
  /*
    Pratik
    Date:03-11-18
  */
namespace App\Http\Controllers;
use App\Model\VmManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class VmManagerController extends Controller
{
	public $route = 'vmmanager';
    public $view = 'vmmanager';
	public $primaryid = 'id';
    public $modulename = 'Vendor Manager Approval';
    public $msgName = 'Bill Summary';

    public function __construct(){

    }

    public function index(){
        $modulename = $this->modulename;
        $route = $this->route;
        $result = VmManager::get();
        return view($this->view.'/index',compact('modulename','route','result'));
    }

    public function update(Request $request){
        $id = $request->id;
        $vmmanager = VmManager::findorfail($id);
        $vmmanager->approve = $request->approve;
        $vmmanager->save();

        return redirect($this->route)->with('msg', 'Approval Update Successfully');
    }
}
