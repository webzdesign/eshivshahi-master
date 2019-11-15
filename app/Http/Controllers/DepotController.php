<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Depot;
use App\Model\Division;
use DataTables;
use Illuminate\Support\Facades\Crypt;

/*
        By : Puja Ramvani - API
        Created On : 23 - 08 - 2018
        Desc : Controller For Depot
*/
class DepotController extends Controller
{
    public $route = 'depot';
    public $view = 'depot';
	public $primaryId = 'id';
    public $moduleName = 'Depot';
    public function index()
    {
        $title = $this->moduleName;
        $module='modal';
        $validateurl = 'checkdepot';
        $tabletype='serverside';
        $action='insert';
        $checkremote=true;
        $route='depot';
        $dataurl='depotdata';
        $divisions = Division::get();
        // $depots=Depot::with(['divisions'])->orderBy('id', 'desc')->get();
        return view('depot.index',compact('title','module','validateurl','tabletype','action','checkremote','route','dataurl','divisions'));
    }
    public function depotdata()
    {
        $depots=Depot::with('divisions')->orderBy('id','desc')->get();
        return Datatables::of($depots)
                    ->addColumn('actions', function($depots) {
                            return "<a data-toggle='modal' id='edit' data-target='#AddEditModal' data-backdrop='static' data-id='$depots->id' class='btn  btn-warning  btn-xs'><i class='fa fa-pencil'></i> Edit</a><a data-id=".Crypt::encryptString($depots->id)."' class='btn btn-danger btn-xs confirm-delete'><i class='fa fa-trash'></i> Delete</a>";
                    })
                    ->addIndexColumn()
                    ->make(true);
    }

    public function store(Request $request)
    {
        $created_by = auth()->user()->id;
        if( Depot::create(array_merge($request->all(),['created_by'=>$created_by]))){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }
    public function edit($id)
    {
        $depot = Depot::findOrFail($id);
        $depot['action']='update';
        $depot['button']='Update';
        $depot['popuptitle']='Update'.$this->moduleName;
        return $depot;
    }
    public function update(Request $request, Depot $depot)
    {
        $updated_by = auth()->user()->id;
        if($depot->update(array_merge($request->all(),['updated_by'=>$updated_by]))){
            echo json_encode(true);
        }else{
            echo json_decode(false);
        }
    }
    public function destroy(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        if(Depot::findorfail($id)->delete())
        {
            echo (json_encode(true));
        }
        else
        {
            echo (json_encode(false));
        }

    }
    public function checkdepot(Request $request)
    {
        if($request->id=='')
        {
            $rows = Depot::where('name',$request->name)->where('division_id',$request->division_id)->count();
        }
        else {
            $rows = Depot::where('name',$request->name)->where('division_id',$request->division_id)->where('id','!=',$request->id)->count();
        }
 
        if($rows > 0){
            echo json_encode(false);
        }else{
            echo json_encode(true);
        }
    }
}