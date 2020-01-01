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
use DataTables,DB,Helper;
use App\Model\Division;
use Illuminate\Support\Facades\Crypt;


class RouteMasterController extends Controller
{
    public $route = 'routemaster';
    public $view = 'routemaster';
    public $primaryId = 'id';
    public $moduleName = 'Route Master';

    public function index(){

        $title = $this->moduleName;
        $module ='modal';
        $route = $this->route;
        $depot = Depot::get();

        /*$getRoute = DB::table('route_masters_old')->get();
        foreach($getRoute as $key => $val) {

            $scheduleTime = explode("*++*", $val->scheduled_time);

            foreach($scheduleTime as $k => $v) {
                RouteMaster::create([
                    'division_id'   => $val->division_id,
                    'from_depot'    => $val->from_depot,
                    'to_division'   => $val->to_division,
                    'to_depot'      => $val->to_depot,
                    'scheduled_km'  => abs($val->scheduled_km),
                    'trip_hrs'      => abs($val->trip_hr),
                    'trip_min'      => abs($val->trip_min),
                    'scheduled_time'=> $v,
                    'maximum_ideling_minutes' => $val->maximum_ideling_minutes,
                    'status'        => 1,
                    ]);
            }
        } */

        return view($this->view.'/index',compact('title', 'route', 'module', 'depot'));
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
                return $routeMaster->scheduled_number.' - '.$routeMaster->scheduled_time;
            })
            ->addColumn('action', function($routeMaster) {
                $activeUrl = url('routeActiveInactive/active/'.$routeMaster->id);
                $deactiveUrl = url('routeActiveInactive/deactive/'.$routeMaster->id);

                $action = '';
                $action = "<a href='$this->route/".Crypt::encryptString($routeMaster->id)."/edit' class='btn  btn-warning  btn-xs'><i class='fa fa-pencil'></i> Edit</a>&nbsp;&nbsp;";
                if ($routeMaster->status == '0') {
                    $action .= "<a id='activate' href='".$activeUrl."'
                    class='btn btn-success btn-xs'>
                    <i class='fa fa-check'></i> Activate</a>";
                } else {
                    $action .= "<a id='deactivate' href='".$deactiveUrl."'
                    class='btn btn-danger btn-xs'>
                    <i class='fa fa-times'></i> Deactivate</a>";
                }
                return $action;
            })
            ->editColumn('status', function ($routeMaster) {
                    if ($routeMaster->status == 1) {
                        return "<span class='label label-success' style='font-size: 12px;'>Activate</span>";
                    } else {
                        return "<span class='label label-danger' style='font-size: 12px;'>Deactivate</span>";
                    }
                }
            )
            ->rawColumns(['scheduled_time','action', 'status'])
            ->addIndexColumn()
            ->make(true);
    }

    public function routeActiveInactive($type,$id)
    {
        if ($type == 'active') {
            RouteMaster::where('id', $id)->update(['status'=>'1']);
            Helper::activeInactiveMsg('active', $this->moduleName);
        } else {
            RouteMaster::where('id', $id)->update(['status'=>'0']);
            Helper::activeInactiveMsg('inactive', $this->moduleName);
        }
        return redirect($this->route);
    }

    public function create()
    {
        $title = $this->moduleName;
        $route = $this->route;
        $divisions = Division::get();
        return view($this->view.'/form',compact('title', 'route', 'divisions'));
    }

    public function store(Request $request){
        $cnt = 0;
        foreach ($request->s_time as $s_time){
            RouteMaster::create([
                'division_id'   => $request->division_id,
                'from_depot'    => $request->from_depot,
                'to_division'   => $request->to_division,
                'to_depot'      => $request->to_depot,
                'scheduled_km'  => abs($request->scheduled_km),
                'trip_hrs'      => abs($request->trip_hr),
                'trip_min'      => abs($request->trip_min),
                'scheduled_time'=> $s_time,
                'scheduled_number' => $request->schedule_number[$cnt],
                'bus_type'      => $request->bus_type[$cnt],
                'maximum_ideling_minutes' => $request->maximum_ideling_minutes,
                'status'        => $request->status,
                ]);
                $cnt++;
        }

        return redirect($this->route)->with('msg', 'Route Inserted Successfully');
    }

    public function edit($id){
        $id = Crypt::decryptString($id);
        $title = $this->moduleName;
        $route = $this->route;
        $routemaster = RouteMaster::findOrFail($id);

        $divisions = Division::get();
        $fromDepots = Depot::where('division_id', $routemaster->division_id)->get();
        $toDepots = Depot::where('division_id', $routemaster->to_division)->get();

        return view($this->view.'/_form',compact('fromDepots', 'toDepots', 'routemaster', 'route', 'title','divisions'));
    }

    public function update(Request $request,$id)
    {
        $route = RouteMaster::findorfail($request->id);

        $route->division_id         =   $request->division_id;
        $route->from_depot          =   $request->from_depot;
        $route->to_division         =   $request->to_division;
        $route->to_depot            =   $request->to_depot;
        $route->scheduled_km        =   $request->scheduled_km;
        $route->trip_hrs            =   $request->trip_hr;
        $route->trip_min            =   $request->trip_min;
        $route->scheduled_time      =   $request->s_time;
        $route->scheduled_number    =   $request->schedule_number;
        $route->bus_type            =   $request->bus_type;
        $route->maximum_ideling_minutes = $request->maximum_ideling_minutes;
        $route->status              =   $request->status;
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

    public function checkScheduledTiming(Request $request){

        $schTime = explode(",", $request->s_time);
        $scheduleNumber = explode(",",$request->schedule_number);

        if (!isset($request->id)) {
            $cnt = 0;
            foreach ($schTime as $sTime) {
                $scheduleNum = $scheduleNumber[$cnt];
                $checkTime = RouteMaster::where('division_id', $request->division_id)->where('from_depot',$request->from_depot)->where('to_division', $request->to_division)->where('to_depot', $request->to_depot)->where('scheduled_time', $sTime)->where('scheduled_number', $scheduleNum)->first();
                if ($checkTime) {
                    echo json_encode(false);exit;
                }
                $cnt++;
            }
            echo json_encode(true);exit;
        } else {
            $cnt = 0;
            foreach ($schTime as $sTime) {
                $scheduleNum = $scheduleNumber[$cnt];
                $checkTime = RouteMaster::where('division_id', $request->division_id)->where('from_depot',$request->from_depot)->where('to_division', $request->to_division)->where('to_depot', $request->to_depot)->where('scheduled_time', $sTime)->where('scheduled_number', $scheduleNum)->where('id', '!=', $request->id)->first();
                if ($checkTime) {
                    echo json_encode(false);exit;
                }
                $cnt++;
            }
            echo json_encode(true);exit;
        }
    }

    public function checkScheduledNumber(Request $request)
    {
        $scheduleNumber = explode(",",$request->schedule_number);
        $schTime = explode(",", $request->s_time);

        if (!isset($request->id)) {
            $cnt = 0;
            foreach ($scheduleNumber as $schNum) {
                $scheduleTime = $schTime[$cnt];
                $checkNumber = RouteMaster::where('division_id', $request->division_id)->where('from_depot',$request->from_depot)->where('to_division', $request->to_division)->where('to_depot', $request->to_depot)->where('scheduled_number', $schNum)->where('scheduled_time', $scheduleTime)->first();
                if ($checkNumber) {
                    echo json_encode(false);exit;
                }
                $cnt++;
            }
            echo json_encode(true);exit;
        } else {
            $cnt = 0;
            foreach ($scheduleNumber as $schNum) {
                $scheduleTime = $schTime[$cnt];
                $checkNumber = RouteMaster::where('division_id', $request->division_id)->where('from_depot',$request->from_depot)->where('to_division', $request->to_division)->where('to_depot', $request->to_depot)->where('scheduled_number', $schNum)->where('scheduled_time', $scheduleTime)->where('id', '!=', $request->id)->first();
                if ($checkNumber) {
                    echo json_encode(false);exit;
                }
                $cnt++;
            }
            echo json_encode(true);exit;
        }
    }
}
