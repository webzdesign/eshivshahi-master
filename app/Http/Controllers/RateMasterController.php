<?php
/*
    By : Pratik Patel
    on: 28-09-2018
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\RateMaster;
use DataTables;
use DB;

class RateMasterController extends Controller
{
    public $route = 'ratemaster';
    public $view = 'ratemaster';
    public $primaryId = 'id';
    public $moduleName = 'Rate Master';

    public function index(){
        $title=$this->moduleName;
        $module='modal';
        $tabletype='serverside';
        $dataurl='ratemasterdata';
        $validateurl='checkkm';
        $action='insert';
        $checkremote=true;
        $route=$this->route;
        return view($this->view.'/index',compact('title','validateurl','route','action','dataurl','tabletype','module','checkremote'));
    }

    public function rateMasterData(){
        $rateMaster=RateMaster::get();

        return Datatables::of($rateMaster)
            ->addColumn('action', function($rateMaster) {
                return "<a data-toggle='modal' id='edit' data-target='#AddEditModal' data-backdrop='static' data-id='$rateMaster->id' class='btn  btn-warning  btn-xs'><i class='fa fa-pencil'></i> Edit</a>&nbsp;&nbsp;";
            })
            ->addColumn('bus_type', function($rateMaster) {
                return ucwords($rateMaster->bus_type);
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request){
        if(RateMaster::create($request->except(['id','action']))){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function edit($id){
        $rateMaster = RateMaster::findOrFail($id);
        $rateMaster['action']='update';
        $rateMaster['button']='Update';
        return $rateMaster;
    }

    public function update(Request $request, RateMaster $ratemaster)
    {
        if(RateMaster::find($request->id)->update($request->all())){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }
    public function checkkm(Request $request)
    {
        $cnt=0;
        $cnt1=0;
        $fromkm = intval($request->from_km);
        $tokm = intval($request->to_km);

        if ($request->id == '') {

            $getRateAll = RateMaster::where('bus_type', $request->bus_type)->get();
            $error = 0;
            foreach($getRateAll as $key=> $val) {

                if ($fromkm == $val->from_km && $tokm == $val->to_km) {
                    $error = 1;
                    break;
                } else if ($fromkm == $val->from_km || $tokm == $val->to_km || $fromkm == $val->to_km || $tokm == $val->from_km) {
                    $error = 1;
                    break;
                } else if ($fromkm > $val->from_km && $fromkm < $val->to_km) {
                    $error = 1;
                    break;
                } else if ($fromkm < $val->from_km &&  $fromkm > $val->to_km) {
                    $error = 1;
                    break;
                } else if ($fromkm < $val->from_km && $tokm > $val->to_km) {
                    $error = 1;
                    break;
                }
                else if ($tokm > $val->from_km && $tokm < $val->to_km) {
                    $error = 1;
                    break;
                } else if ($tokm < $val->from_km && $tokm > $val->to_km) {
                    $error = 1;
                    break;
                }
            }

        } else {

            $getRateAll = RateMaster::where('bus_type', $request->bus_type)->where('id','!=',$request->id)->get();
            $error = 0;
            foreach($getRateAll as $key=> $val) {

                if ($fromkm == $val->from_km && $tokm == $val->to_km) {
                    $error = 1;
                    break;
                } else if ($fromkm == $val->from_km || $tokm == $val->to_km || $fromkm == $val->to_km || $tokm == $val->from_km) {
                    $error = 1;
                    break;
                } else if ($fromkm > $val->from_km && $fromkm < $val->to_km) {
                    $error = 1;
                    break;
                } else if ($fromkm < $val->from_km &&  $fromkm > $val->to_km) {
                    $error = 1;
                    break;
                } else if ($fromkm < $val->from_km && $tokm > $val->to_km) {
                    $error = 1;
                    break;
                } else if ($tokm > $val->from_km && $tokm < $val->to_km) {
                    $error = 1;
                    break;
                } else if ($tokm < $val->from_km && $tokm > $val->to_km) {
                    $error = 1;
                    break;
                }
            }
        }

        if ($error == 1) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }
}
