<?php
/*
        By : Puja Ramvani - API
*/
namespace App\Http\Controllers;

use App\Model\Vehicle;
use Illuminate\Http\Request;
use App\Model\Vendor;
use App\Model\VendorManager;
use DataTables;
use Auth;
use App\User;
use DB;
use Helper;
class VehicleController extends Controller
{
    public $route = 'vehicle';
    public $view = 'vehicle';
    public $primaryId = 'id';
    public $moduleName = 'Vehicle';

    public function index()
    {
        if (auth()->user()->usertype_id!='1') {
            return redirect('home');
        }

        $title=$this->moduleName;
        $module='modal';
        $tabletype='serverside';
        $user=User::findorfail(Auth::user()->id);
        $vendors=Vendor::get();
        $vendorselected=VendorManager::where('user_id', Auth::user()->id)->get();
        $dataurl='vehicledata';
        $validateurl='validatevehiclenum';
        $action='insert';
        $checkremote=true;
        $route=$this->route;
        return view($this->view.'/index',compact('title','validateurl','route','action','dataurl','tabletype','module','checkremote','user','vendors','vendorselected'));
    }

    public function vehicledata()
    {
        if(Auth::user()->usertype_id ==1)
        {
            $vehicles=Vehicle::with(['vendor'])->get();
        }
        else{
            $vendor=VendorManager::where('user_id',Auth::user()->id)->get();
            if($vendor->count()>0)
            {
                $vendor_id=$vendor[0]->vendor_id;
            }
            else
            {
                $vendor_id='';
            }
            $vehicles=Vehicle::with(['vendor'])->where('vendor_id',$vendor_id)->get();
        }


        return Datatables::of($vehicles)
            ->editColumn('status', function($vehicles) {
                if ($vehicles->status == '0') {
                    $status = '<label class="label label-danger">Inactive</label>';
                } else{
                    $status = '<label class="label label-success">Active</label>';
                }
                return $status;
            })
            ->addColumn('action', function($vehicles) {

                $actions = "<a data-toggle='modal' id='edit' data-target='#AddEditModal' data-backdrop='static' data-id='$vehicles->id' class='btn  btn-warning  btn-xs'><i class='fa fa-pencil'></i> Edit</a>&nbsp;&nbsp;";

                if ($vehicles->status == '0') {
                    $activeUrl = url('vehicleactiveinactive/active/'.$vehicles->id);
                    $actions .= "<a id='active' href='".$activeUrl."' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Active</a>";
                } else{
                    $inactiveUrl = url('vehicleactiveinactive/inactive/'.$vehicles->id);
                    $actions .= "<a id='inactive' href='".$inactiveUrl."' class='btn btn-danger btn-xs'><i class='fa fa-times'></i> Inactive</a>";
                }
                return $actions;
            })
            ->addColumn('bus_type', function($vehicles) {
                return ucwords($vehicles->bus_type);
            })
            ->rawColumns(['status','action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function vehicleactiveinactive($type,$id)
    {
        if ($type == 'active') {
            Vehicle::where('id', $id)->update(['status'=>'1']);
            Helper::activeInactiveMsg('active', $this->msgName);
        } else {
            Vehicle::where('id', $id)->update(['status'=>'0']);
            Helper::activeInactiveMsg('inactive', $this->msgName);
        }
        return redirect('vehicle');
    }

    public function store(Request $request)
    {
        $created_by=auth()->user()->id;
        if(Vehicle::create(array_merge($request->except(['id','action']),['created_by' =>$created_by])))
        {
            echo json_encode(true);
        }
        else
        {
            echo json_encode(false);
        }

    }

    public function edit($id)
    {
        if (auth()->user()->usertype_id!='1') {
            return redirect('home');
        }

        $vehicle = Vehicle::findOrFail($id);
        $vehicle['action']='update';
        $vehicle['button']='Update';
        return $vehicle;
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $updated_by=auth()->user()->id;

        if(Vehicle::find($request->id)->update(array_merge($request->all(),['updated_by' =>$updated_by]))){
            echo json_encode(true);
        }
        else
        {
            echo json_encode(false);
        }
    }

    public function destroy(Vehicle $vehicle )
    {
        $vehicle->delete();
        echo json_encode(true);
    }
    public function validatevehiclenum(Request $request)
    {
        if($request->id==''){
            $row=Vehicle::where('vehicle_no',$request->vehicle_no)->count();
        }else{
           $row= Vehicle::where('vehicle_no',$request->vehicle_no)->where('id','!=',$request->id)->count();
        }
        if($row>0){
            echo(json_encode(false));
        }else{
            echo(json_encode(true));
        }
    }
}
