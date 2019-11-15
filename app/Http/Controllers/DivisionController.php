<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Division;
use App\Model\Depot;
use DataTables;
use Illuminate\Support\Facades\Crypt;

/*
        By : Puja Ramvani - API
        Created On : 23 - 08 - 2018
        Desc : Controller For Division
*/
class DivisionController extends Controller
{
    public $route = 'division';
    public $view = 'division';
	public $primaryId = 'id';
    public $moduleName = 'Division';
    public function index()
    {
        $title = $this->moduleName;
        $module='modal';
        $route='division';
        $validateurl = 'checkdivision';
        $tabletype='serverside';
        $action='insert';
        $checkremote=true;
        $dataurl='divisiondata';
        //$divisions=Division::orderBy('id', 'desc')->get();
        return view('division.index',compact('title','tabletype','action','module','route','dataurl','validateurl','checkremote'));
    }
    public function divisiondata()
    {
        $divisions=Division::orderBy('id','desc')->get();
        return Datatables::of($divisions)
                    ->addColumn('actions', function($divisions) {
                            return "<a data-toggle='modal' id='edit' data-target='#AddEditModal' data-backdrop='static' data-id='$divisions->id' class='btn  btn-warning  btn-xs'><i class='fa fa-pencil'></i> Edit</a><a data-id=".Crypt::encryptString($divisions->id)."' class='btn btn-danger btn-xs confirm-delete-division'><i class='fa fa-trash'></i> Delete</a>";
                    })
                    ->addIndexColumn()
                    ->make(true);
    }
    public function store(Request $request)
    {
        $created_by = auth()->user()->id;
        if( Division::create(array_merge($request->all(),['created_by'=>$created_by]))){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }
    public function edit($id)
    {
        $division = Division::findOrFail($id);
        $division['action']='update';
        $division['button']='Update';
        $division['popuptitle']='Update'.$this->moduleName;
        return $division;
    }
    public function update(Request $request, Division $division)
    {
        $updated_by = auth()->user()->id;
        if($division->update(array_merge($request->all(),['updated_by'=>$updated_by]))){
            echo json_encode(true);
        }else{
            echo json_decode(false);
        }
    }
    public function destroy(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        if(Division::findorfail($id)->delete())
        {
            Depot::where('division_id',$id)->delete();
            echo (json_encode(true));
        }
        else
        {
            echo (json_encode(false));
        }
    }
    public function checkdivision(Request $request)
    {
        if($request->id==''){
            $rows = Division::where('name',$request->name)->count();
        }
        else {
            $rows = Division::where('id','!=',$request->id)->where('name',$request->name)->count();
        }
        if($rows > 0){
            echo json_encode(false);
        }else{
            echo json_encode(true);
        }
    }
}
