<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BillSummaryConfirm;
use App\Model\Billsummary;
use App\Model\VendorManager;
use App\Model\VendorAccountant;
class HomeController extends Controller
{

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

    public function index(){
        $accessTypeId = $this->accessTypeId;
        $userTypeId = $this->userTypeId;
        $depotId = $this->depotId;
        $divisionId = $this->divisionId;

        if($userTypeId != '1' && $userTypeId != '2' && $userTypeId != '3'){
            if($accessTypeId == '3'){
                $billSummary = Billsummary::where('depot_id',$depotId)->where('vendor_confirm','!=','0')->where('status','1')->groupBy('bill_no')->get();
            }
            if($accessTypeId == '2'){
                $billSummary = Billsummary::where('division_id',$divisionId)->where('vendor_confirm','!=','0')->where('status','1')->groupBy('bill_no')->get();
            }


            $billSummaryCnt = 0;
            foreach($billSummary as $key=>$val){

                $billSummaryConfirm = BillSummaryConfirm::where('usertype_id',$this->userTypeId)->where('billsummary_id',$val->bill_no)->where('confirm_by',0)->get();

                if(! $billSummaryConfirm->isEmpty()){
                    /* get current seq */
                    $curSeq = $billSummaryConfirm[0]->sequence;

                    if($curSeq == '1'){
                        $billSummaryCnt++;
                    }else{
                        /* prev seq check */
                        $prevSeq = intval($curSeq)-intval(1);

                        $confirmCheck = BillSummaryConfirm::where('billsummary_id',$val->bill_no)->where('confirm_by','!=','0')->where('sequence',$prevSeq)->get();
                        if(! $confirmCheck->isEmpty()){
                            $billSummaryCnt++;
                        }
                    }
                }
            }
        }

        // $PendingQuery = BillSummaryConfirm::where('user_id','!=', 0)->where('confirm_by', 0)->where('query', '!=', NULL)->count();


        if($this->userTypeId == 1){
            $PendingQuery = BillSummaryConfirm::with(['user','billsummary'])->where('user_id','!=', 0)->where('confirm_by', 0)->where('query_status', 1)->count();;
        }else{

            if(auth()->user()->usertype_id=='2'){
                $id = auth()->user()->id;
				$getvendorId = VendorManager::where('user_id',$id)->first();
                $vendor_id = $getvendorId['vendor_id'];

                $PendingQuery = BillSummaryConfirm::with(['user','billsummary'])->whereHas('billsummary', function($q) use($vendor_id){
                    $q->where('vendor_id', $vendor_id);
                })->where('user_id','!=', 0)->where('confirm_by', 0)->where('query_status', 1)->count();


            }else if(auth()->user()->usertype_id=='3'){
                $id = auth()->user()->id;
                $getvendoracId = VendorAccountant::where('user_id',$id)->first();
                $vendor_id = $getvendoracId->vendor_id;

                $PendingQuery = BillSummaryConfirm::with(['user','billsummary'])->whereHas('billsummary', function($q) use($vendor_id){
                    $q->where('vendor_id', $vendor_id);
                })->where('user_id','!=', 0)->where('confirm_by', 0)->where('query_status', 1)->count();

            }else{
                if($this->accessTypeId == '3'){
                    $PendingQuery = BillSummaryConfirm::with(['user','billsummary'])->where('user_id','!=', 0)->where('confirm_by', 0)->where('query_status', 1)->where('depot_id', $this->depotId)->count();
                }
                if($this->accessTypeId == '2'){
                    $PendingQuery = BillSummaryConfirm::with(['user','billsummary'])->where('user_id','!=', 0)->where('confirm_by', 0)->where('query_status', 1)->where('division_id', $this->divisionId)->count();
                }
            }

        }



        return view('home',compact('billSummaryCnt','userTypeId', 'PendingQuery'));
    }
}
