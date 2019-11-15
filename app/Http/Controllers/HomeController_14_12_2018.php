<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BillSummaryConfirm;
use App\Model\Billsummary;

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
                $billSummary = BillSummaryConfirm::where('usertype_id',$userTypeId)->where('depot_id',$depotId)->where('confirm_by','0')->get();
            }
            if($accessTypeId == '2'){
                $billSummary = BillSummaryConfirm::where('usertype_id',$userTypeId)->where('division_id',$divisionId)->where('confirm_by','0')->get();
            }


            $billSummaryCnt = 0;
            foreach($billSummary as $key=>$val){

                /* check vendor manager confirm */
                $venMngrCheck = Billsummary::select('vendor_confirm')->where('id',$val->billsummary_id)->first();

                if($venMngrCheck->vendor_confirm != '0'){

                    $billSummaryConfirm = BillSummaryConfirm::where('usertype_id',$userTypeId)->where('billsummary_id',$val->billsummary_id)->where('confirm_by',0)->get();

                    if(! $billSummaryConfirm->isEmpty()){
                        /* get current seq */
                        $curSeq = $billSummaryConfirm[0]->sequence;

                        if($curSeq == '1'){
                            $billSummaryCnt++;
                        }else{
                            /* prev seq check */
                            $prevSeq = intval($curSeq)-intval(1);

                            $confirmCheck = BillSummaryConfirm::where('billsummary_id',$val->billsummary_id)->where('confirm_by','!=','0')->where('sequence',$prevSeq)->get();
                            if(! $confirmCheck->isEmpty()){
                                $billSummaryCnt++;
                            }
                        }
                    }
                }
            }
        }


        return view('home',compact('billSummaryCnt','userTypeId'));
    }
}
