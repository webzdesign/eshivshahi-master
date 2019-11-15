<?php
/*
    By : Pratik Patel
    on: 29-10-2018
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\RateMaster;
use App\Model\Depot;
use App\Model\RouteMaster;
use DataTables,DB;
use App\Model\Division;
use Illuminate\Support\Facades\Crypt;


class RouteMasterController extends Controller
{
    public $route = 'routemaster';
    public $view = 'routemaster';
    public $primaryId = 'id';
    public $moduleName = 'Route Master';

    public function index(){
        $title=$this->moduleName;
        $module='modal';
        $tabletype='serverside';
        $dataurl='routemasterdata';
        $validateurl='';
        $action='insert';
        $checkremote=false;
        $route=$this->route;
        $depot = Depot::get();
        return view($this->view.'/index',compact('title','validateurl','route','action','dataurl','tabletype','module','checkremote','depot'));
    }

    public function routeMasterData(){

        $routeMaster=RouteMaster::get();

        $routeMaster = DB::table('route_masters')
            ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
            ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
            ->leftJoin('divisions', 'divisions.id', '=', 'route_masters.division_id')
            ->leftJoin('divisions as div', 'div.id', '=', 'route_masters.to_division')
            ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot','divisions.name','div.name as to_division')
            ->get();

        return Datatables::of($routeMaster)
            ->addColumn('trip_time',function($routeMaster){
                return  $routeMaster->trip_hrs.":".$routeMaster->trip_min;
            })
            ->editColumn('scheduled_time',function($routeMaster){
                $a= explode("*++*",$routeMaster->scheduled_time);
                $s_time='';
                foreach($a as $time)
                {
                    $s_time .=$time."<br />";
                }
                return $s_time;
            })

            ->addColumn('action', function($routeMaster) {
                return "<a href='$this->route/".Crypt::encryptString($routeMaster->id)."/edit' class='btn  btn-warning  btn-xs'><i class='fa fa-pencil'></i> Edit</a>&nbsp;&nbsp;";
            })
            ->rawColumns(['scheduled_time','action'])
            ->addIndexColumn()
            ->make(true);
    }
    public function create()
    {
        $title=$this->moduleName;
        $action='insert';
        $route=$this->route;
        $divisions = Division::get();
        return view($this->view.'/form',compact('title','validateurl','route','action','dataurl','tabletype','checkremote','divisions'));
    }
    public function store(Request $request){
            RouteMaster::create([
            'division_id'=>$request->division_id,
            'from_depot'=>$request->from_depot,
            'to_division'=>$request->to_division,
            'to_depot'=>$request->to_depot,
            'scheduled_km'=>abs($request->scheduled_km),
            'trip_hrs'=>abs($request->trip_hr),
            'trip_min'=>abs($request->trip_min),
            'scheduled_time'=>implode("*++*",$request->s_time),
            'maximum_ideling_minutes' => $request->maximum_ideling_minutes,
            ]);
            return redirect($this->route)->with('msg', 'Route Inserted Successfully');
    }

    public function edit($id){
        $id = Crypt::decryptString($id);
        $title=$this->moduleName;
        $action='update';
        $route=$this->route;
        $divisions = Division::get();
        $depots = Depot::get();
        $routemaster = RouteMaster::findOrFail($id);
        return view($this->view.'/form',compact('depots','routemaster','route','action','title','divisions'));
    }

    public function update(Request $request,$id)
    {
        $route=RouteMaster::findorfail($request->id);
        $route->division_id=$request->division_id;
        $route->from_depot=$request->from_depot;
        $route->to_division=$request->to_division;
        $route->to_depot=$request->to_depot;
        $route->scheduled_km=$request->scheduled_km;
        $route->trip_hrs=$request->trip_hr;
        $route->trip_min=$request->trip_min;
        $route->scheduled_time=implode("*++*",$request->s_time);
        $route->maximum_ideling_minutes = $request->maximum_ideling_minutes;
        $route->save();
        return redirect($this->route)->with('msg', 'Route Updated Successfully');
    }
    public function getdepot(Request $request)
    {
        $division_id = $request->division_id;
        $depots = Depot::where('division_id',$division_id)->get();
        $options="<option></option>";
        foreach($depots as $depot)
        {
            $options .="<option value=".$depot->id.">".$depot->name."</option>";
        }
        return $options;
    }

    public function checkmaxIdelingMinutes(Request $request)
    {
        $maximum_ideling_minutes =$request->maximum_ideling_minutes;

        if(!isset($request->id)){
            $cnt=RouteMaster::where('maximum_ideling_minutes',$maximum_ideling_minutes)->count();
        } else {
            $cnt=RouteMaster::where('maximum_ideling_minutes',$maximum_ideling_minutes)->where('id','!=',$request->id)->count();
        }
        if($cnt>0)
        {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }
}
