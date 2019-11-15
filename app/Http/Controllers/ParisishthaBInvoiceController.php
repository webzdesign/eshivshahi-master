<?php

namespace App\Http\Controllers;

use App\Model\ParisishthaBInvoice;
use App\Model\ParisishthaB;
use App\Model\Vendor;
use App\Model\Vendorinvoice;
use App\Model\VendorManager;
use App\Model\VendorAccountant;
use App\Model\Depot;
use App\Model\Division;
use App\Model\Vehicle;
use App\Model\RouteMaster;
use App\Model\ParisishthaBConfirm;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Crypt;


class ParisishthaBInvoiceController extends Controller
{
    public $route = 'parisishthabinvoice';
    public $view = 'parisishthabinvoice';
	public $primaryid = '';
    public $modulename = 'Parisishtha B Voucher';
    public $msgName = 'Parisishtha B Voucher';

    public $userTypeId;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->userTypeId = auth()->user()->usertype_id;
            return $next($request);
        });
    }

    public function index()
    {
        $modulename = $this->modulename;
        $route = $this->route;
        $dataurl='getparisishthabdataForBInvoice';
        return view($this->view.'/index',compact('modulename','route','dataurl'));
    }

    public function getparisishthabData()
    {
        if($this->userTypeId == '1'){
            $parisishthabs = DB::table('parisishtha_bs')
            ->join('vendors', 'vendors.id', '=', 'parisishtha_bs.vendor_id')
            ->join('vehicles', 'vehicles.id', '=', 'parisishtha_bs.vehicle_id_reff')
            ->where('is_vendor_confirm',0)
            ->select('parisishtha_bs.*','vendors.vendor_name','vehicles.vehicle_no')
            ->orderBy('parisishtha_bs.id', 'desc')
            ->get();
        }else if($this->userTypeId == '2'){
            $id = auth()->user()->id;
			$getvendorId = VendorManager::where('user_id',$id)->first();
			$vendor_id = $getvendorId['vendor_id'];
            $parisishthabs = DB::table('parisishtha_bs')
            ->join('vendors', 'vendors.id', '=', 'parisishtha_bs.vendor_id')
            ->join('vehicles', 'vehicles.id', '=', 'parisishtha_bs.vehicle_id_reff')
            ->where('is_vendor_confirm',0)
            ->where('parisishtha_bs.vendor_id',$vendor_id)
            ->select('parisishtha_bs.*','vendors.vendor_name','vehicles.vehicle_no')
            ->orderBy('parisishtha_bs.id', 'desc')
            ->get();
        }else{
            $id = auth()->user()->id;
			$getvendorId = VendorAccountant::where('user_id',$id)->first();
			$vendor_id = $getvendorId['vendor_id'];
            $parisishthabs = DB::table('parisishtha_bs')
            ->join('vendors', 'vendors.id', '=', 'parisishtha_bs.vendor_id')
            ->join('vehicles', 'vehicles.id', '=', 'parisishtha_bs.vehicle_id_reff')
            ->where('is_vendor_confirm',0)
            ->where('parisishtha_bs.vendor_id',$vendor_id)
            ->select('parisishtha_bs.*','vendors.vendor_name','vehicles.vehicle_no')
            ->orderBy('parisishtha_bs.id', 'desc')
            ->get();
        }


		return Datatables::of($parisishthabs)
            ->addColumn('actions', function($parisishthabs){
                return "<a id='edit' href='$this->route/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-info btn-xs'><i class='fa fa-eye'></i> View </a>";
            })

            ->editColumn('billing_period', function($parisishthabs){
                $billing_period=explode(",",$parisishthabs->billing_period);
                $from=date("d-m-Y",strtotime($billing_period[0]));
                $to=date("d-m-Y",strtotime($billing_period[1]));
                return  $from ." to ".$to;
            })
            ->addIndexColumn()
            ->rawColumns(['billing_period'])
            ->make(true);
    }

    public function show($id){

        $id = Crypt::decryptString($id);
        $parisishthab = ParisishthaB::with('depot','vehicle')->findorfail($id);
        $modulename = $this->modulename;
        $route = $this->route;
        $action = 'view';
        $vendors = Vendor::get();
        $vendorinvoices=Vendorinvoice::get();
        $depots = Depot::get();
        $routes = DB::table('route_masters')
        ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
        ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
        ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')
        ->get();
        $schedule_time =RouteMaster::select('scheduled_time')->findorfail($parisishthab->route_id);

        $schedule_time = explode("*++*",$schedule_time->scheduled_time);
        $vehicle = Vehicle::where('status',1)->get();
        $division = Division::get();
        $getdata='getinvoice';
        $getinvoicedata='getinvoicedata';
        $parisishthabsId = $id;
        return view($this->view.'/show',compact('user','routes','vendors','modulename','route','action','dataurl','depots','getdata','getinvoicedata','parisishthab','vendorinvoices','parisishthabsId','division','vehicle','schedule_time'));
    }


    public function confirmInvoice($id){
         $id = Crypt::decryptString($id);
         $pData = ParisishthaB::find($id);
         $pData->is_vendor_confirm =1;
         $pData->save();

        /* set hierarchy */
        $getModuleHierarchy = DB::table('module_hierarchies')->where('module_id','12')->orderBy('hierarchy_sequence','asc')->get();

        foreach($getModuleHierarchy as $key=>$val){
            $ParisishthaBConfirm = new ParisishthaBConfirm();
            $ParisishthaBConfirm->parisishthab_id = $id;
            $ParisishthaBConfirm->usertype_id = $val->usertype_id;
            $ParisishthaBConfirm->sequence = $val->hierarchy_sequence;
            $ParisishthaBConfirm->confirm_by = '0';
            $ParisishthaBConfirm->save();
        }

        return redirect($this->route)->with('msg', 'Confirm Successfully');
    }

}
