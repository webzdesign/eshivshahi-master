<?php

namespace App\Http\Controllers;

use App\Model\BillSummaryConfirm;
use App\Model\BillSummary;
use App\Model\VendorManager;
use App\Model\VendorAccountant;
use Illuminate\Http\Request;
use App\User;
use DB;
use DataTables,Helper;
use Illuminate\Support\Facades\Crypt;

class QueryController extends Controller
{

    public $route = 'query';
    public $view = 'query';
	public $primaryid = '';
    public $modulename = 'Query';
    public $msgName = 'Query';

    public $userTypeId;
    public $depotId;
    public $divisionId;
    public $accessTypeId;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->userTypeId = auth()->user()->usertype_id;
            $this->depotId = auth()->user()->depot_id;
            $this->divisionId = auth()->user()->division_id;
            $this->accessTypeId = auth()->user()->accesstype_id;
            return $next($request);
        });
    }

    public function index()
    {
        $modulename = $this->modulename;
        $route = $this->route;
        $dataurl='getquerybillsummary';

        return view($this->view.'/index',compact('modulename','route','dataurl'));
    }

    public function getquerybillsummary()
    {
        if($this->userTypeId == 1){
            $billquery = BillSummaryConfirm::with(['user','billsummary'])->where('user_id','!=', 0)->where('confirm_by', 0)->where('query_status', 1);
        }else{

            if(auth()->user()->usertype_id=='2'){
                $id = auth()->user()->id;
				$getvendorId = VendorManager::where('user_id',$id)->first();
                $vendor_id = $getvendorId['vendor_id'];

                $billquery = BillSummaryConfirm::with(['user','billsummary'])->whereHas('billsummary', function($q) use($vendor_id){
                    $q->where('vendor_id', $vendor_id);
                })->where('user_id','!=', 0)->where('confirm_by', 0)->where('query_status', 1);


            }else if(auth()->user()->usertype_id=='3'){
                $id = auth()->user()->id;
                $getvendoracId = VendorAccountant::where('user_id',$id)->first();
                $vendor_id = $getvendoracId->vendor_id;

                $billquery = BillSummaryConfirm::with(['user','billsummary'])->whereHas('billsummary', function($q) use($vendor_id){
                    $q->where('vendor_id', $vendor_id);
                })->where('user_id','!=', 0)->where('confirm_by', 0)->where('query_status', 1);

            }else{
                if($this->accessTypeId == '3'){
                    $billquery = BillSummaryConfirm::with(['user','billsummary'])->where('user_id','!=', 0)->where('confirm_by', 0)->where('query_status', 1)->where('depot_id', $this->depotId);
                }
                if($this->accessTypeId == '2'){
                    $billquery = BillSummaryConfirm::with(['user','billsummary'])->where('user_id','!=', 0)->where('confirm_by', 0)->where('query_status', 1)->where('division_id', $this->divisionId);
                }
            }

        }



        return DataTables::eloquent($billquery)
        ->addIndexColumn()
        ->addColumn('action', function($billquery) {

            return  "<a id='view' href='billsummary/".Crypt::encryptString($billquery->billsummary_id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View BillSummary</a><a href='vendorinvoice/".encrypt($billquery->billsummary->vendorinvoice_id)."' class='btn btn-success btn-xs' ><i class='fa fa-eye'></i> View VendorInvoice </a><a id='view' href='parisishthab/".Crypt::encryptString($billquery->billsummary->parisishtha_b_id)."' class='btn  btn-warning btn-xs'><i class='fa fa-eye'></i> View ParisishthaB</a>";

        })
        ->editColumn('date', function($billquery){
            $date = date("d-m-Y",strtotime($billquery->queryraised_at));
            return $date;
        })
        ->editColumn('username', function($billquery){
            $username = $billquery->user->first_name.' '.$billquery->user->last_name;
            return $username;
        })
        ->rawColumns(['action'])
        ->make(true);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
