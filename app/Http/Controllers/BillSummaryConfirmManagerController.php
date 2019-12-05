<?php
/*
    name:Pratik Donga
    on: 13-09-2018
*/
namespace App\Http\Controllers;

use App\Model\BillSummaryConfirm;
use App\Model\ParisishthaB;
use App\Model\ParisishthaA;
use App\Model\Vendor;
use App\Model\Vehicle;
use App\Model\Vendorinvoice;
use App\Model\Depot;
use App\Model\Billsummary;
use App\Model\VendorManager;
use App\Model\CityMaster;
use App\Model\Division;
use App\Model\Charge;

use Illuminate\Http\Request;
use DB;
use DataTables,Helper;
use Illuminate\Support\Facades\Crypt;

class BillSummaryConfirmManagerController extends Controller
{
    public $route = 'billsummarymanagerconfirm';
    public $view = 'billsummarymanagerconfirm';
	public $primaryid = '';
    public $modulename = 'Bill Summary Confirm';
    public $msgName = 'Bill Summary Confirm';

    public $userTypeId;
    public $depotId;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->userTypeId = auth()->user()->usertype_id;
            $this->depotId = auth()->user()->depot_id;
            return $next($request);
        });
    }

    public function index(){
        $modulename = $this->modulename;
        $route = $this->route;
        $dataurl='getbillsummarydataForManagerConfirm';
        return view($this->view.'/index',compact('modulename','route','dataurl'));
    }

    public function getBillSummaryData(){

        if($this->userTypeId == '1'){
            $billSummary = Billsummary::with('vendorinvoice','vendor','parisisthab','route')->where('status','1')->get();
        }else{
            $id = auth()->user()->id;
			$getvendorId = VendorManager::where('user_id',$id)->first();
			$vendor_id = $getvendorId['vendor_id'];
            $billSummary = Billsummary::with('vendorinvoice','vendor','parisisthab','route')->where('status','1')->groupBy('bill_no')->where('vendor_id',$vendor_id)->get();
        }

		return Datatables::of($billSummary)
            ->addColumn('actions', function($billSummary){

                $viewConfirm = "<a id='edit' href='$this->route/".Crypt::encryptString($billSummary->bill_no)."' class='btn  btn-info btn-xs'><i class='fa fa-eye'></i> View </a>";

                if($billSummary->vendor_confirm == '0'){
                    $viewConfirm.="<a id='edit' href='$this->route/".Crypt::encryptString($billSummary->bill_no)."' class='btn  btn-success btn-xs'><i class='fa fa-check'></i> Confirm </a>";
                }else{
                    $url = url('billsummary/showapproval',Crypt::encryptString($billSummary->bill_no));
                    $viewConfirm.= "<a id='view' href='javascript:void(0)' class='btn btn-warning btn-xs'><i class='fa fa-check'></i> Approved</a>
                    <a id='edit' href='$url' class='btn  btn-success btn-xs'><i class='fa fa-eye'></i> Show Approval History</a>";
                }
                return $viewConfirm;
            })
            ->editColumn('vendor_name', function($billSummary){
                return $billSummary->vendor->vendor_name;
            })
            ->editColumn('route_id', function($billSummary){
                 return $billSummary->route->fromdepot->name.'-'.$billSummary->route->todepot->name.' ('.$billSummary->route->scheduled_number.' - '.$billSummary->route->scheduled_time.')';
            })
            ->editColumn('voucher_no', function($billSummary){
                if(isset($billSummary->vendorinvoice->invoice_no)){
                    return $billSummary->vendorinvoice->invoice_no;
                }else{
                    return '-';
                }
            })
            ->editColumn('billing_period', function($billSummary){
                $billing_period=explode(",",$billSummary->parisisthab->billing_period);
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
        $billsummary = Billsummary::with('route','vendorinvoice')->where('bill_no',$id)->get();
        $vendor = Vendor::get();
        $vehicle = Vehicle::where('status',1)->get();
        $modulename = $this->modulename;
        $route = $this->route;

        // $viewParisishtha =  url('showVendorInvoice/'.Crypt::encryptString($billSummary->bill_no));
        // $viewParisishthb = route('parisishthab.show',Crypt::encryptString($billsummary[0]->bill_no));
        // $viewvendorinvoice = url('showVendorInvoice/'.$billSummary[0]->bill_no);

        if($this->userTypeId == '1'){
            $confirmStatus = 0;
        }else{
             if($billsummary[0]->vendor_confirm == '0'){
                 $confirmStatus = 0;
             }else{
                 $confirmStatus = 1;
             }
        }

        // if($billsummary[0]->vendorinvoice_id != ''){
        //     $viewvendorinvoice = url('showVendorInvoice',Crypt::encryptString($billSummary[0]->bill_no));
        // }else{
        //     $viewvendorinvoice = '';
        // }

		return view($this->view.'/show',compact('modulename','vendor','vehicle','route','billsummary','confirmStatus'));
    }


    public function update(Request $request, BillSummaryConfirm $billSummaryConfirm){
        Billsummary::where('id',$request->id)->update(['vendor_confirm'=>auth()->user()->id]);
        $billsummary = Billsummary::findorfail($request->id);

        $parisishthb = ParisishthaB::findorfail($billsummary->parisishtha_b_id);
        $parisishthb->is_vendor_confirm = auth()->user()->id;
        $parisishthb->save();

        return redirect($this->route)->with('msg', 'Bill Summary Confirm Successfully');
    }
    public function showVendorInvoice($id)
    {
        $modulename = "View VendorInvoice";
        $vendors = Vendor::get();
        $vendorinvoices = Vendorinvoice::get();
        $depots = Depot::get();
        $cities = CityMaster::get();
        $division = Division::get();
        $vehicle = Vehicle::where('status',1)->get();
        $routes = DB::table('route_masters')
            ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
            ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
            ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')
            ->get();
        $billsummary= Billsummary::where('bill_no',$id)->pluck('vendorinvoice_id')->toArray();

        $ids=array_unique($billsummary);
        $vendorinvoicedata = Vendorinvoice::whereIn('id',$ids)->get();
        return view($this->view.'/showinvoice',compact('vendorinvoicedata','vendors','vendorinvoices','depots','cities','division','vehicle','routes','route','action','modulename'));
    }
    public function showParisishthB($id)
    {

        $modulename = "View ParisishthaB";
        $route = $this->route;
        $action = 'view';
        $vendors = Vendor::get();
        $vendorinvoices = Vendorinvoice::get();
        $depots = Depot::get();
        $cities = CityMaster::get();
        $division = Division::get();
        $vehicle = Vehicle::where('status',1)->get();
        $routes = DB::table('route_masters')
        ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
        ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
        ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')
        ->get();
        $default_diseal = Charge::first();

        $billsummary= Billsummary::where('bill_no',$id)->pluck('parisishtha_b_id')->toArray();

        $ids=array_unique($billsummary);
        $parisishthabdata = ParisishthaB::with('depot','vendorinvoice', 'route')->whereIn('id',$ids)->get();
        return view($this->view.'/showparisishthb',compact('parisishthabdata','vendors','vendorinvoices','depots','cities','division','vehicle','routes','route','action','modulename', 'default_diseal'));
    }
    public function showParisishthA($id)
    {

        $modulename = "View ParisishthaA";
        $route = $this->route;
        $action = 'view';
        $vendors = Vendor::get();
        $vendorinvoices = Vendorinvoice::get();
        $depots = Depot::get();
        $cities = CityMaster::get();
        $division = Division::get();
        $vehicle = Vehicle::where('status',1)->get();
        $billsummary= Billsummary::where('bill_no',$id)->pluck('parisishtha_a_id')->toArray();
        $ids=array_unique($billsummary);
        $parisishthaadata = ParisishthaA::with('depot','vendorinvoice','vendor','route')->whereIn('id',$ids)->get();
        return view($this->view.'/showparisishthaa',compact('parisishthaadata','vendors','vendorinvoices','depots','cities','division','vehicle','route','action','modulename'));
    }
}
