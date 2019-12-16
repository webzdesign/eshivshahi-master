<?php

/*

    name:Pratik Donga

    on: 13-09-2018

*/

namespace App\Http\Controllers;



use App\Model\BillSummaryConfirm;

use App\Model\ParisishthaB;

use App\Model\Vendor;

use App\Model\Vehicle;

use App\Model\Vendorinvoice;

use App\Model\Depot;

use App\Model\Billsummary;

use App\Model\BillSummaryView;

use App\Model\Allowuser;

use Illuminate\Http\Request;

use App\User;

use DB;

use DataTables,Helper;

use Illuminate\Support\Facades\Crypt;



class BillSummaryConfirmController extends Controller

{

    public $route = 'billsummaryconfirm';

    public $view = 'billsummaryconfirm';

	public $primaryid = '';

    public $modulename = 'Bill Summary Confirm';

    public $msgName = 'Bill Summary Confirm';



    public $userTypeId;

    public $depotId;

    public $accessTypeId;

    public $divisionId;



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

        $modulename = $this->modulename;

        $route = $this->route;

        $dataurl='getbillsummarydataForConfirm';



        if($this->accessTypeId == '2'){

            $divisionId = $this->divisionId;

            $depo = Depot::where('division_id',$divisionId)->get();

        }else{

            $depo = array();

        }



        return view($this->view.'/index',compact('modulename','route','dataurl','depo'));

    }



    public function getBillSummaryData(){



        $parisithbConfirm = BillSummaryConfirm::where('usertype_id',$this->userTypeId)->pluck('billsummary_id');

        if($this->userTypeId == '1'){

            $billSummary = Billsummary::with('vendorinvoice','vendor','parisisthab','route','depot','division')->where('status','1')->where('vendor_confirm','!=','0')->orderBy('id', 'desc')->groupBy('bill_no')->get();

        }else{

            $accessTypeId = $this->accessTypeId;



            if($accessTypeId == '3'){

                $depotId = $this->depotId;

                $billSummary = Billsummary::with('vendorinvoice','vendor','parisisthab','route','depot','division')->where('depot_id',$depotId)->where('vendor_confirm','!=','0')->whereIn('bill_no',$parisithbConfirm)->where('status','1')->orderBy('id', 'desc')->groupBy('bill_no')->get();

            }

            if($accessTypeId == '2'){

                $divisionId = $this->divisionId;

                $billSummary = Billsummary::with('vendorinvoice','vendor','parisisthab','route','depot','division')->where('division_id',$divisionId)->where('vendor_confirm','!=','0')->whereIn('bill_no',$parisithbConfirm)->where('status','1')->orderBy('id', 'desc')->groupBy('bill_no')->get();



            }

        }



        return Datatables::of($billSummary)

            ->editColumn('depo', function($billSummary){

                return $billSummary->depot->name;

            })

            ->editColumn('division', function($billSummary){

                return $billSummary->division->name;

            })

            ->addColumn('actions', function($billSummary){

                if($this->userTypeId == '1'){

                    $confirmStatus = 1;

                }else{



                    $billSummaryConfirm = BillSummaryConfirm::where('usertype_id',$this->userTypeId)->where('billsummary_id',$billSummary->bill_no)->where('confirm_by',0)->orderBy('id', 'desc')->get();



                    if(! $billSummaryConfirm->isEmpty()){

                        /* get current seq */

                        $curSeq = $billSummaryConfirm[0]->sequence;



                        if($curSeq == '1'){

                            $confirmStatus = 0;

                        }else{

                            /* prev seq check */

                            $prevSeq = intval($curSeq)-intval(1);



                            $confirmCheck = BillSummaryConfirm::where('billsummary_id',$billSummary->bill_no)->where('confirm_by','!=','0')->where('sequence',$prevSeq)->orderBy('id', 'desc')->get();

                            if(! $confirmCheck->isEmpty()){

                                $confirmStatus = 0;

                            }else{

                                $confirmStatus = 1;

                            }

                        }

                    }else{

                        $confirmStatus = 1;

                    }

                }





                $viewConfirm = "<a id='edit' href='$this->route/".Crypt::encryptString($billSummary->bill_no)."' class='btn  btn-info btn-xs'><i class='fa fa-eye'></i> View </a>";



                if($confirmStatus == '1'){

                    //$viewConfirm.= "<a id='view' href='javascript:void(0)' class='btn  btn-warning btn-xs'><i class='fa fa-check'></i> Approved</a>";

                }else{

                    $viewConfirm.="<a id='edit' href='$this->route/".Crypt::encryptString($billSummary->bill_no)."' class='btn  btn-success btn-xs'><i class='fa fa-check'></i> Confirm </a>";

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

                if(isset($billSummary->parisisthab->voucher_no)){

                    return $billSummary->parisisthab->voucher_no;

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

        $userTypeId = $this->userTypeId;

        $billsummary = Billsummary::with('route','vendorinvoice')->where('bill_no',$id)->get();

        $viewSummaryDetail = BillSummaryView::where('usertype_id',$userTypeId)->where('billsummary_id',$billsummary[0]->bill_no)->first();

        $vendor = Vendor::get();

        $vehicle = Vehicle::where('status',1)->get();

        $modulename = $this->modulename;

        $route = $this->route;

        // $viewParisishtha = route('parisishthaa.show',Crypt::encryptString($billsummary[0]->parisishtha_b_id));

        // $viewParisishthb = route('parisishthab.show',Crypt::encryptString($billsummary[0]->parisishtha_b_id));



        // if($billsummary[0]->vendorinvoice_id != ''){

        //     $viewvendorinvoice = route('vendorinvoice.show',encrypt($billsummary[0]->vendorinvoice_id));

        // }else{

        //     $viewvendorinvoice = '';

        //     DB::table('billsummary_view')->where('billsummary_id',$id)->where('usertype_id',$userTypeId)->update(['vendorinvoiceid'=>'1']);

        // }



        if($this->userTypeId == '1'){

            $confirmStatus = 0;

        }else{

            $billSummaryConfirm = BillSummaryConfirm::where('usertype_id',$this->userTypeId)->where('billsummary_id',$id)->where('confirm_by',0)->get();



            if(! $billSummaryConfirm->isEmpty()){

                /* get current seq */

                $curSeq = $billSummaryConfirm[0]->sequence;



                if($curSeq == '1'){

                    $confirmStatus = 0;

                }else{

                    /* prev seq check */

                    $prevSeq = intval($curSeq)-intval(1);



                    $confirmCheck = BillSummaryConfirm::where('billsummary_id',$id)->where('confirm_by','!=','0')->where('sequence',$prevSeq)->get();



                    if(! $confirmCheck->isEmpty()){

                        $confirmStatus = 0;

                    }else{

                        $confirmStatus = 1;

                    }

                }

            }else{

                $confirmStatus = 1;

            }

        }



		return view($this->view.'/show',compact('modulename','vendor','vehicle','route','billsummary','confirmStatus','viewSummaryDetail'));

    }

    public function getconfirmdatasummary(Request $request){

        $parisithbConfirm = BillSummaryConfirm::where('usertype_id',$this->userTypeId)->pluck('billsummary_id');

        $depot_id = $request->depot_id;

        if($depot_id != ''){

            $billSummary = Billsummary::with('vendorinvoice','vendor','parisisthab','vehicle','depot','division')->where('division_id',$this->divisionId)->where('vendor_confirm','!=','0')->where('depot_id',$depot_id)->whereIn('id',$parisithbConfirm)->where('status','1')->get();

        }else{

            $billSummary = Billsummary::with('vendorinvoice','vendor','parisisthab','vehicle','depot','division')->where('division_id',$this->divisionId)->where('vendor_confirm','!=','0')->whereIn('id',$parisithbConfirm)->where('status','1')->get();

        }

        $userTypeId = $this->userTypeId;





        return view($this->view.'/summaryData',compact('billSummary','userTypeId'));

    }



    public function update(Request $request, BillSummaryConfirm $billSummaryConfirm){



        $parisithbConfirm = BillSummaryConfirm::where('billsummary_id',$request->bill_no)->where('usertype_id',$this->userTypeId)->update(['confirm_by'=>auth()->user()->id]);



        $allowUser = Allowuser::select('usertype_id')->where('accesstype_id','3')->get();



        $usertype = array();

        foreach($allowUser as $key=>$val){

            $usertype[] = $val->usertype_id;

        }



        $billsummaryCnf = BillSummaryConfirm::where('billsummary_id',$request->bill_no)->whereIn('usertype_id',$usertype)->where('confirm_by','0')->get();





        if($billsummaryCnf->isEmpty()){

            /* update from parisishth a and b and bill summary */



            DB::table('billsummaries')->where('bill_no',$request->bill_no)->update(['update_status'=>1]);



            /* get parishishtha a id and b id */

            $getIds = DB::table('billsummaries')->where('bill_no',$request->bill_no)->get();

            // $parisishthb_id = $getId[0]->parisishtha_b_id;

            // $parisishtha_id = $getId[0]->parisishtha_a_id;

            foreach($getIds as $getid){

                DB::table('parisishtha_bs')->where('id',$getid->parisishtha_b_id)->update(['update_status'=>'1']);

                DB::table('parisishtha_as')->where('id',$getid->parisishtha_a_id)->update(['update_status'=>'1']);

                DB::table('vendorinvoices')->where('id',$getid->vendorinvoice_id)->update(['update_status'=>'1']);

            }

        }



        $allowUserDivision = Allowuser::select('usertype_id')->where('accesstype_id','2')->get();

        $usertypedivision = array();

        foreach($allowUserDivision as $key=>$val){

            $usertypedivision[] = $val->usertype_id;

        }



        $billsummaryCnfDivision = BillSummaryConfirm::where('billsummary_id',$request->bill_no)->whereIn('usertype_id',$usertypedivision)->where('confirm_by','0')->get();



        if($billsummaryCnfDivision->isEmpty()){

            /* update from parisishth a and b and bill summary */

            DB::table('billsummaries')->where('bill_no',$request->bill_no)->update(['update_status_division'=>'1']);



            /* get parishishtha a id and b id */

            $getIds = DB::table('billsummaries')->where('id',$request->id)->get();

            // $parisishthb_id = $getId[0]->parisishtha_b_id;

            // $parisishtha_id = $getId[0]->parisishtha_a_id;

            foreach($getIds as $getid){

                DB::table('parisishtha_bs')->where('id',$getid->parisishtha_b_id)->update(['update_status_division'=>'1']);

                DB::table('parisishtha_as')->where('id',$getid->parisishtha_a_id)->update(['update_status_division'=>'1']);
                
                DB::table('vendorinvoices')->where('id',$getid->vendorinvoice_id)->update(['update_status_division'=>'1']);

            }



            // DB::table('parisishtha_bs')->where('id',$parisishthb_id)->update(['update_status_division'=>'1']);

            // DB::table('parisishtha_as')->where('id',$parisishtha_id)->update(['update_status_division'=>'1']);

        }





        return redirect($this->route)->with('msg', 'Bill Summary Confirm Successfully');

    }

    public function vendorConfirmSummary(Request $request){

        $id = $request->id;

        $userTypeId = $this->userTypeId;

        DB::table('billsummary_view')->where('billsummary_id',$id)->where('usertype_id',$userTypeId)->update(['vendorinvoiceid'=>'1']);

    }

    public function paribConfirmSummary(Request $request){

        $id = $request->id;

        $userTypeId = $this->userTypeId;

        DB::table('billsummary_view')->where('billsummary_id',$id)->where('usertype_id',$userTypeId)->update(['parisishthab_id'=>'1']);

    }

    public function pariaConfirmSummary(Request $request){

        $id = $request->id;

        $userTypeId = $this->userTypeId;

        DB::table('billsummary_view')->where('billsummary_id',$id)->where('usertype_id',$userTypeId)->update(['parisishthaa_id'=>'1']);

    }

    public function insertremarks(Request $request)

    {

        $parisithbConfirm = BillSummaryConfirm::where('billsummary_id',$request->bill_no)->where('usertype_id',$this->userTypeId)->update(['user_id'=>auth()->user()->id,'query'=>$request->remarks,'queryraised_at'=>date("Y-m-d H:i:s"), 'query_status' => 1]);



            $parisishtha_b_voucher_no = BillSummary::with(['parisisthab' => function ($query) {

                $query->get(['voucher_no']);

            }])->where('bill_no',$request->bill_no)->get();



            $voucher_no = array();

            $depot= BillSummaryConfirm::where('billsummary_id',$request->bill_no)->get();

            foreach($parisishtha_b_voucher_no as $v_no)

            {

                array_push($voucher_no,$v_no->parisisthab->voucher_no);

            }

            $v_no = implode(",",$voucher_no);

        if($this->userTypeId==7)

        {



            $getmobilenumber = User::select('mobile','first_name','last_name')->whereIn('usertype_id',array(8,9))->where('depot_id',$depot[0]->depot_id)->get();

            if($getmobilenumber->count()>0)

            {

                $this->sendmsg($getmobilenumber,$v_no);

            }

        }

        if($this->userTypeId==38)

        {

            $getmobilenumber = User::select('mobile','first_name','last_name')->whereIn('usertype_id',array(8,9,7))->where('depot_id',$depot[0]->depot_id)->get();

            if($getmobilenumber->count()>0)

            {

                $this->sendmsg($getmobilenumber,$v_no);

            }

        }

        if($this->userTypeId==6)

        {

            $getmobilenumber = User::select('mobile','first_name','last_name')->whereIn('usertype_id',array(8,9,7,38))->where('depot_id',$depot[0]->depot_id)->get();

            if($getmobilenumber->count()>0)

            {

                $this->sendmsg($getmobilenumber,$v_no);

            }

        }

        if($this->userTypeId==4)

        {

            $getmobilenumber = User::select('mobile','first_name','last_name')->whereIn('usertype_id',array(5))->where('depot_id',$depot[0]->depot_id)->get();

            if($getmobilenumber->count()>0)

            {

                $this->sendmsg($getmobilenumber,$v_no);

            }

        }

        if($this->userTypeId==10)

        {

            $getmobilenumber = User::select('mobile','first_name','last_name')->whereIn('usertype_id',array(5,4))->where('depot_id',$depot[0]->depot_id)->get();

            if($getmobilenumber->count()>0)

            {

                $this->sendmsg($getmobilenumber,$v_no);

            }

        }

        return redirect($this->route)->with('msg', 'Query Raised Successfully');

    }

    public function sendmsg($data,$voucher_no)

    {

        $apikey = "mGLLAiuy1U645KWiCCAKOQ";

        $apisender = "ESHIVS";

        foreach($data as $mob)

        {

            $msg ="Dear ".$mob->first_name." ".$mob->last_name.", a query have been raised on bill ".$voucher_no.". Kindly take necessary action.";

            $num = $mob->mobile;



            $ms = rawurlencode($msg);   //This for encode your message content



            $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';

            $ch=curl_init($url);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch,CURLOPT_POST,1);

            curl_setopt($ch,CURLOPT_POSTFIELDS,"");

            curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);

            $data = curl_exec($ch);

        }



    }

}

