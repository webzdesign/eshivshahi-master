<?php
/*
    Hardik Ponkiya
    Date:27-8-18
*/

namespace App\Http\Controllers;
use App\Model\Allowuser;
use App\Model\Accesstype;
use App\Model\Usertype;
use Illuminate\Http\Request;
use DB;

class AllowuserController extends Controller
{
    public $route = 'allowuser';
    public $view = 'allowuser';
	public $primaryId = 'id';
    public $moduleName = 'Allow User';

    public function index()
    {
       $allowuser = DB::table('allowusers')
				->join('usertypes', 'usertypes.id', '=', 'allowusers.usertype_id')
				->join('accesstypes', 'accesstypes.id', '=', 'allowusers.accesstype_id')
				->select('allowusers.*', 'usertypes.name As unm','accesstypes.name')
				->get();
        $title = $this->moduleName;
        $module='modal';
        $dataurl= 'allowuserdata'; /* DataTable URl */
		$validateurl = '';
        $action='insert';
        $tabletype='';
        $checkremote=false;
        $checkDuplicateURL = 'checkallowuser';
        $accesstype = Accesstype::all();
        $usertype = Usertype::where('name','!=','Super Admin')->get();
        $route=$this->route;
        return view($this->view.'/index',compact('allowuser','title','module','dataurl','validateurl','action','tabletype','accesstype','usertype','route','checkremote','checkDuplicateURL'));
    }

    /** to get data will refreshing datatable **/
    public function allowuserdata()
    {
        $allowuser = DB::table('allowusers')
			->join('usertypes', 'usertypes.id', '=', 'allowusers.usertype_id')
            ->join('accesstypes', 'accesstypes.id', '=', 'allowusers.accesstype_id')
            ->where('allowusers.usertype_id','!=','1')
			->select('allowusers.*', 'usertypes.name As unm','accesstypes.name')
			->get();

        foreach($allowuser as $key=>$value)
        {

					$action="<a data-toggle='modal' id='edit' data-target='#AddEditModal' data-backdrop='static' data-id='$value->id' class='btn  btn-warning  btn-xs'><i class='fa fa-pencil'></i> Edit</a>";
					$allowusers['data'][$key]=array($key+1,$value->unm,$value->name,$value->no_of_users,$action);

        }
        echo json_encode($allowusers);
    }

	public function checkallowuser(Request $req)
	{
		$usertype_id = $req->usertype_id;
		$accesstype_id = $req->accesstype_id;
        $id = $req->id;
        if($usertype_id!='' && $accesstype_id!=''){
            if($req->id=='') {
                $rows = Allowuser::where('usertype_id',$usertype_id)->where('accesstype_id',$accesstype_id)->count();
            }
            else{
                $rows = Allowuser::where('usertype_id',$usertype_id)->where('accesstype_id',$accesstype_id)->where($this->primaryId,'!=',$id)->count();
            }
            if($rows > 0){
                echo(json_encode(false));
            }else{
                echo(json_encode(true));
            }
        }

	}

    public function store(Request $request)
    {
        $created_by = auth()->user()->id;
        if( Allowuser::create(array_merge($request->all(),['created_by'=>$created_by]))){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }

    }

    public function edit($id)
    {
        $allowuser = Allowuser::findOrFail($id);
        $allowuser['action']='update';
        $allowuser['button']='Update';
        $allowuser['popuptitle']='Update'.$this->moduleName;
        return $allowuser;
    }

    public function update(Request $request, Allowuser $allowuser)
    {
        $updated_by = auth()->user()->id;
        if($allowuser->update(array_merge($request->all(),['updated_by'=>$updated_by]))){
           echo json_encode(true);
        }else{
            echo json_decode(false);
        }
    }

}
