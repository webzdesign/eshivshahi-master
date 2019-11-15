<?php
/*
  Hardik Ponkiya
  Date:24-8-18
*/

namespace App\Http\Controllers;

use App\Model\Vendor;
use App\Http\Requests\VendorRequest;
use App\Model\VendorManager;
use App\Model\VendorAccountant;
use App\User;
use Illuminate\Http\Request;
use DataTables, Helper;
use Auth;
use DB;
class VendorController extends Controller
{
    public $route = 'vendordetail';
    public $view = 'vendor';
	public $primaryid = 'id';
    public $modulename = 'Vendor Detail';

    public $msgName = 'Vendor';

    public function index()
    {
        $vendor = Vendor::orderBy('id', 'desc')->get();
        $modulename = $this->modulename;
        $route = $this->route;
        return view($this->view.'/index',compact('vendor','modulename','route'));
    }

    public function get_data()
	{
        if(Auth::user()->usertype_id==1)
        {
                return DataTables::of(Vendor::orderBy('id', 'desc')->get())
                    ->addIndexColumn('id')
                    ->addColumn('action', function ($vendor){
                            $editId = $vendor->id;
                            $route = $this->route;
                        $actions = view('shared.data_table_actions',compact('editId','route'));

                        if ($vendor->active_status == '0') {

                            $activeUrl = url('vendoractiveinactive/active/'.$vendor->id);

                            $actions .= "<a id='active' href='".$activeUrl."' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Active</a>";

                        } else{

                            $inactiveUrl = url('vendoractiveinactive/inactive/'.$vendor->id);

                            $actions .= "<a id='inactive' href='".$inactiveUrl."' class='btn btn-danger btn-xs'><i class='fa fa-times'></i> Inactive</a>";

                        }
                        return $actions;

                    })
                    ->editColumn('active_status', function($vendor) {
                        if ($vendor->active_status == '0') {
                            $status = '<label class="label label-danger">Inactive</label>';
                        } else{
                            $status = '<label class="label label-success">Active</label>';
                        }
                        return $status;

                    })
                    ->rawColumns(['active_status','action'])
                    ->make(true);
        }
        else
        {

            $vendor=VendorManager::with('vendor')->where('user_id',Auth::user()->id)->get();
            return DataTables::of($vendor)
            ->addIndexColumn('id')
            ->addColumn('action', function ($vendor){
                    $editId = $vendor->vendor_id;
                    $route = $this->route;
                $actions = view('shared.data_table_actions',compact('editId','route'));

                if ($vendor->active_status == '0') {

                    $activeUrl = url('vendoractiveinactive/active/'.$vendor->id);

                    $actions .= "<a id='active' href='".$activeUrl."' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Active</a>";

                } else{

                    $inactiveUrl = url('vendoractiveinactive/inactive/'.$vendor->id);

                    $actions .= "<a id='inactive' href='".$inactiveUrl."' class='btn btn-danger btn-xs'><i class='fa fa-times'></i> Inactive</a>";

                }
                return $actions;
            })
            ->editColumn('active_status', function($vendor) {
                if ($vendor->active_status == '0') {
                    $status = '<label class="label label-danger">Inactive</label>';
                } else{
                    $status = '<label class="label label-success">Active</label>';
                }
                return $status;
            })
            ->rawColumns(['active_status','action'])
            ->make(true);
        }

    }

    public function vendoractiveinactive($type,$id)
    {
        if ($type == 'active') {
            Vendor::where('id', $id)->update(['active_status'=>'1']);
            $vendorAcc = VendorAccountant::where('vendor_id', $id)->pluck('user_id')->toArray();
            $vendorManager = VendorManager::where('vendor_id', $id)->pluck('user_id')->toArray();

            $vendorUserId = array_merge($vendorAcc, $vendorManager);
            User::whereIn('id', $vendorUserId)->update(['active_status'=>'1']);

            Helper::activeInactiveMsg('active', $this->msgName);

        } else {
            Vendor::where('id', $id)->update(['active_status'=>'0']);
            $vendorAcc = VendorAccountant::where('vendor_id', $id)->pluck('user_id')->toArray();
            $vendorManager = VendorManager::where('vendor_id', $id)->pluck('user_id')->toArray();

            $vendorUserId = array_merge($vendorAcc, $vendorManager);
            User::whereIn('id', $vendorUserId)->update(['active_status'=>'0']);

            Helper::activeInactiveMsg('inactive', $this->msgName);
        }
        return redirect('vendordetail');
    }

    public function create()
    {
        $modulename = $this->modulename;
        $route = $this->route;
        $action = 'insert';
        return view($this->view.'/form',compact('user','modulename','route','action'));
    }


    public function store(VendorRequest $request)
    {
        $user_id = auth()->user()->id; /* Logged IN Vendor Manger Id */
        Vendor::create(array_merge($request->all(),['user_id' =>$user_id]));
        session()->flash('msg',$this->msgName.' Added Successfully');
        return redirect(url($this->route));
    }

    public function edit($id)
    {
		$result = Vendor::find(decrypt($id));
        $action = 'update';
        $modulename = $this->modulename;
        $route = $this->route;
        return view($this->view.'/form',compact('modulename','route','action','result'));
    }


    public function update(VendorRequest $request, Vendor $vendordetail)
    {
        $user_id = auth()->user()->id; /* Log In Vendor Manager ID  */
        $vendordetail->update(array_merge($request->all(),['user_id' =>$user_id]));
        session()->flash('msg',$this->msgName.' Updated Successfully');
        return redirect(url($this->route));
    }

    public function destroy(Vendor $vendordetail)
    {
        if($vendordetail->delete()){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }
}
