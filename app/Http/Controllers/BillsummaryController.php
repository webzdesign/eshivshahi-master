<?php

  /*

    Pratik

    Date:10-09-18

  */

namespace App\Http\Controllers;

use App\Model\Billsummary;

use App\Model\BillSummaryConfirm;

use App\Model\Vendor;

use App\Model\Depot;

use App\Model\Division;

use App\Model\Vehicle;

use App\Model\ParisishthaA;

use App\Model\ParisishthaB;

use App\Model\BillSummaryView;

use App\Model\VmManager;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;

use DataTables,Helper,DB,PDF;



class BillsummaryController extends Controller

{

	public $route = 'billsummary';

    public $view = 'billsummary';

	public $primaryid = 'id';

    public $modulename = 'Bill Summary';

    public $msgName = 'Bill Summary';



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

        if($this->userTypeId != 1){

            $checkPermission = Helper::getModulePermission('14',$this->userTypeId);

            if($checkPermission){

                return redirect('/home')->send();

            }

        }

        $permission = Helper::getPermission('14',$this->userTypeId);

        $userTypeId = $this->userTypeId;

        $modulename = $this->modulename;

        $route = $this->route;

        $dataTableUrl = 'getbillsummarydata';

        return view($this->view.'/index',compact('modulename','route','dataTableUrl','userTypeId','permission'));

    }



    public function getBillSummayData(){

        /* get Permission */

        $permission = Helper::getPermission('14',$this->userTypeId);

        $accessTypeId = $this->accessTypeId;





        if($this->userTypeId == '1'){

            $billSummay = Billsummary::with('vendorinvoice')->where('delete_status','0')->orderBy('id', 'desc')->groupBy('bill_no')->get();

        }else{



            if($accessTypeId == '3'){

                $depotId = $this->depotId;

                $billSummay = Billsummary::with('vendorinvoice')->where('delete_status','0')->where('depot_id',$depotId)->orderBy('id', 'desc')->groupBy('bill_no')->get();

            }

            if($accessTypeId == '2'){

                $divisionId = $this->divisionId;

                $billSummay = Billsummary::with('vendorinvoice')->where('delete_status','0')->where('division_id',$divisionId)->groupBy('bill_no')->orderBy('id', 'desc')->get();

            }

        }







        return Datatables::of($billSummay)



        ->addColumn('actions', function($billSummay) use($permission,$accessTypeId) {

            $raisedQuery = BillSummaryConfirm::where('query_status', 1)->where('billsummary_id', $billSummay->bill_no)->first();



            if($this->userTypeId != '1'){

                if($accessTypeId == '3'){

                    if($permission[0]->view == '1'){

                        $editView = "<a id='view' href='$this->route/".Crypt::encryptString($billSummay->bill_no)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a><a id='print'  target ='_blank' href='printBillsummary/".Crypt::encryptString($billSummay->bill_no)."' class='btn  btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";

                        if($billSummay->status == '1'){

                            $editView .= "<a id='edit' href='$this->route/showapproval/".Crypt::encryptString($billSummay->bill_no)."' class='btn  btn-success btn-xs'><i class='fa fa-eye'></i> Show Approval History</a>";

                        }

                    }

                    if($billSummay->update_status == '0'){

                        if($permission[0]->edit == '1'){

                            if($billSummay->status == '0'){

                                $editView = "<a id='edit' href='$this->route/".Crypt::encryptString($billSummay->bill_no)."/edit' class='btn  btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</a><a class='btn btn-danger btn-xs vendor bill-confirm-delete' data-id='".Crypt::encryptString($billSummay->bill_no)."' ><i class='fa fa-trash'></i> Delete</a>";



                                if($raisedQuery){

                                   if($raisedQuery->user->accesstype_id == $this->accessTypeId)

                                   {

                                        $query = url('queryresolved/'.$raisedQuery->id);

                                        $editView .= "<a id='query' href='".$query."' class='btn btn-success btn-xs'><i class='fa fa-question'></i> Query Resolved</a>";

                                   }

                                }



                            }else{

                                $editView .= "<a id='edit' href='$this->route/".Crypt::encryptString($billSummay->bill_no)."/edit' class='btn  btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</a><a class='btn btn-danger btn-xs vendor bill-confirm-delete' data-id='".Crypt::encryptString($billSummay->bill_no)."' ><i class='fa fa-trash'></i> Delete</a>

                                ";



                                if($raisedQuery){

                                    if($raisedQuery->user->accesstype_id == $this->accessTypeId)

                                    {

                                        $query = url('queryresolved/'.$raisedQuery->id);

                                        $editView .= "<a id='query' href='".$query."' class='btn btn-success btn-xs'><i class='fa fa-question'></i> Query Resolved</a>";

                                    }

                                }

                            }

                        }

                    }

                    return $editView;

                }



                if($accessTypeId == '2'){

                    if($permission[0]->view == '1'){

                        $editView = "<a id='view' href='$this->route/".Crypt::encryptString($billSummay->bill_no)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a><a id='print'  target ='_blank' href='printBillsummary/".Crypt::encryptString($billSummay->bill_no)."' class='btn  btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";

                        if($billSummay->status == '1'){

                            $editView .= "<a id='edit' href='$this->route/showapproval/".Crypt::encryptString($billSummay->bill_no)."' class='btn  btn-success btn-xs'><i class='fa fa-eye'></i> Show Approval History</a>";

                        }

                    }

                    if($billSummay->update_status_division == '0'){

                        if($permission[0]->edit == '1'){

                            if($billSummay->status == '0'){

                                $editView = "<a id='edit' href='$this->route/".Crypt::encryptString($billSummay->bill_no)."/edit' class='btn  btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</a><a class='btn btn-danger btn-xs vendor bill-confirm-delete' data-id='".Crypt::encryptString($billSummay->bill_no)."' ><i class='fa fa-trash'></i> Delete</a>";



                                if($raisedQuery){

                                   if($raisedQuery->user->accesstype_id == $this->accessTypeId)

                                   {

                                        $query = url('queryresolved/'.$raisedQuery->id);

                                        $editView .= "<a id='query' href='".$query."' class='btn btn-success btn-xs'><i class='fa fa-question'></i> Query Resolved</a>";

                                   }

                                }



                            }else{

                                $editView .= "<a id='edit' href='$this->route/".Crypt::encryptString($billSummay->bill_no)."/edit' class='btn  btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</a><a class='btn btn-danger btn-xs vendor bill-confirm-delete' data-id='".Crypt::encryptString($billSummay->bill_no)."' ><i class='fa fa-trash'></i> Delete</a>";



                                if($raisedQuery){

                                    if($raisedQuery->user->accesstype_id == $this->accessTypeId)

                                   {

                                        $query = url('queryresolved/'.$raisedQuery->id);

                                        $editView .= "<a id='query' href='".$query."' class='btn btn-success btn-xs'><i class='fa fa-question'></i> Query Resolved</a>";

                                   }

                                }

                            }

                        }

                    }

                    return $editView;

                }



            }else{

                $editView = "<a id='view' href='$this->route/".Crypt::encryptString($billSummay->bill_no)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a>";

                /* if($billSummay->update_status == '0'){

                    $editView .= "<a id='edit' href='$this->route/".Crypt::encryptString($billSummay->bill_no)."/edit' class='btn  btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</a><a class='btn btn-danger btn-xs vendor bill-confirm-delete' data-id='".Crypt::encryptString($billSummay->bill_no)."' ><i class='fa fa-trash'></i> Delete</a>";

                } */

                $editView.= "<a id='edit' href='$this->route/showapproval/".Crypt::encryptString($billSummay->bill_no)."' class='btn  btn-success btn-xs'><i class='fa fa-eye'></i> Show Approval History</a><a id='print'  target ='_blank' href='printBillsummary/".Crypt::encryptString($billSummay->bill_no)."' class='btn  btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";

                return $editView;

            }



        })







        ->editColumn('date', function($billSummay){

            $date = date("d-m-Y",strtotime($billSummay->created_at));

            return $date;

        })

        ->editColumn('invoice_no', function($billSummay){

            if(isset($billSummay->vendorinvoice->invoice_no)){

                return $billSummay->vendorinvoice->invoice_no;

            }else{

                return '-';

            }

        })

        ->editColumn('vendor_name', function($billSummay) {

            return  $billSummay->vendor->vendor_name;

        })

        ->editColumn('division', function($billSummay) {

            return  $billSummay->division->name;

        })

        ->editColumn('depot_name', function($billSummay) {

            return  $billSummay->depot->name;

        })

        ->editColumn('billing_period', function($billSummay) {

            $billing_period=explode(",",$billSummay->billing_period);

            $from=date("d-m-Y",strtotime($billing_period[0]));

            $to=date("d-m-Y",strtotime($billing_period[1]));

            return  $from ." to ".$to;

            })



        ->addIndexColumn()

        ->make(true);



    }



    public function queryresolved($id)

    {

       // echo "hi"; exit();

        BillSummaryConfirm::where('id', $id)->update(['query_status'=>'2']);

        return redirect('billsummary');

    }



    public function create(){

        if (auth()->user()->usertype_id=='1') {

            return redirect('home');

        }

        $modulename = $this->modulename;

        $route = $this->route;

        $action = 'insert';

        $parisishthaAData = ParisishthaA::get();

        $vendor = Vendor::get();

        return view($this->view.'/form',compact('vendor','route','action','modulename','parisishthaAData'));

    }



    public function getVehicleData(Request $request){

        $vendor_id = $request->vendor_id;

		$vehicle = Vehicle::where('vendor_id',$vendor_id)->where('status',1)->get();

		echo '<option value=""></option>';

		if(!empty($vehicle)){

			foreach($vehicle as $key=>$val){

				echo '<option value="'.$val->id.'">'.$val->vehicle_no.'</option>';

			}

		}

    }



    public function checkinvoiceab(Request $request){

        $parisishtha_a_id = explode(",",$request->parisishtha_a_id);

        $parisishtha_b_id = explode(",",$request->parisishtha_b_id);



        $status = 0;

        for($i=0; $i<count($parisishtha_a_id); $i++){

            $checkA = ParisishthaA::where('id',$parisishtha_a_id[$i])->where('status','0')->get();



            $checkB = ParisishthaB::where('id',$parisishtha_b_id[$i])->where('status','0')->get();

            if(! $checkA->isEmpty()){

                $status = 1;

            }

            if(! $checkB->isEmpty()){

                $status = 1;

            }

        }

        echo $status;exit;

    }



    public function getBillSummay(request $request){

        $vendor_id = $request->vendor_id;
        $from_date = date("Y-m-d",strtotime($request->from_date));
        $to_date = date("Y-m-d",strtotime($request->to_date));
        $billnigPeriod = $from_date.','.$to_date;

        $Year = date("Y",strtotime($request->from_date));

        if(date("d",strtotime($from_date)) < 15 ) {
            $month = date("m",strtotime($from_date));

            if($month == 1) {
                $month = 12;
                $Year = $Year-1;
            } else {
                $month = $month - 1;
            }

            $dayOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $Year);
            $fromDate = '16-'.$month.'-'.$Year;
            $toDate = $dayOfMonth.'-'.$month.'-'.$Year;
        } else {
            $month =  date("m",strtotime($from_date));
            $fromDate = '1-'.$month.'-'.$Year;
            $toDate = '15-'.$month.'-'.$Year;
        }

        $fromDate = date('Y-m-d', strtotime($fromDate));
        $toDate = date('Y-m-d', strtotime($toDate));

        $prevBillnigPeriod = $fromDate.','.$toDate;

        $prevBill = Billsummary::where('billing_period',$prevBillnigPeriod)->where('vendor_id',$vendor_id)->first();

        if ($prevBill) {
            $prevDeducton = $prevBill->amount_after_tds;
            if ($prevDeducton < 0) {
                $prevDeducton = $prevBill->amount_after_tds;
            } else {
                $prevDeducton = 0;
            }
        } else {
            $prevDeducton = 0;
        }


        if($this->userTypeId == '1'){

            $parisishthaa = ParisishthaA::with('vendorinvoice','route')->where('billing_period',$billnigPeriod)->where('vendor_id',$vendor_id)->where('pay_status','0')->where('delete_status','0')->get();

        }else{

            $accessTypeId = $this->accessTypeId;

            if($accessTypeId == '3'){

                $depotId = $this->depotId;

                $parisishthaa = ParisishthaA::with('vendorinvoice','route')->where('vendor_id',$vendor_id)->where('billing_period',$billnigPeriod)->where('pay_status','0')->where('delete_status','0')->where('depot_id',$depotId)->get();
            }

            if($accessTypeId == '2'){

                $divisionId = $this->divisionId;

                $parisishthaa = ParisishthaA::with('vendorinvoice','route')->where('vendor_id',$vendor_id)->where('billing_period',$billnigPeriod)->where('pay_status','0')->where('delete_status','0')->where('division_id',$divisionId)->get();
            }
        }

        return view($this->view.'/show',compact('vendor_id','vehicle_id','parisishthaa', 'prevDeducton'));

    }





    public function store(Request $request){


        DB::beginTransaction();
      $b = Billsummary::select('bill_no')->orderBy('bill_no','desc')->lockForUpdate()->first();

      if($b){

        $billno = ($b->bill_no) + (1);

      }else{

        
        $billno = 1;

      }

        $from_date = date("Y-m-d",strtotime($request->from_date));

        $to_date = date("Y-m-d",strtotime($request->to_date));

        $billingPeriod = $from_date.','.$to_date;

        $parisishtha_a_id = $request->parisishtha_a_id;

        $parisishtha_b_id = $request->parisishtha_b_id;

        $depot_id = $request->depot_id;

        $division_id = $request->division_id;

        $voucher_no = $request->voucher_no;

        $vehicle_id = $request->vehicle_id;

        $route_id = $request->route_id;

        $vendor_id = $request->vendor_id;

        $vendorinvoice_id = $request->vendorinvoice_id;

        $vendor_invoice_amt = $request->vendor_invoice_amt;

        $gov_approve_amt = $request->gov_approve_amt;

        $vendor_deduction_amt = $request->vendor_deduction_amt;

        $final_payable_amt = $request->final_payable_amt;

        $status = $request->publish_flag;



        $approval = VmManager::get();

        $approvalStatus = $approval[0]->approve;



        $i=0;

        $insrtedId = array();

        foreach($parisishtha_a_id as $key=>$val)

        {

            $billCheck = Billsummary::where('parisishtha_a_id', $val)->get();

            if ($billCheck->isEmpty()) {

                $billSummary = Billsummary::create([

                    'bill_no'=>$billno,

                    'parisishtha_a_id'=>$val,

                    'parisishtha_b_id'=>$parisishtha_b_id[$i],

                    'division_id'=>$division_id[$i],

                    'depot_id'=>$depot_id[$i],

                    'billing_period'=>$billingPeriod,

                    'gov_voucher_no'=>$voucher_no[$i],

                    'route_id'=>$request->route_id[$i],

                    'vehicle_id'=>$vehicle_id[$i],

                    'vendor_id'=>$vendor_id,

                    'vendorinvoice_id'=>$vendorinvoice_id[$i],

                    'vendor_invoice_amt'=>$vendor_invoice_amt[$i],

                    'gov_approve_amt'=>$gov_approve_amt[$i],

                    'vendor_deduction_amt'=>$vendor_deduction_amt[$i],

                    'final_payable_amt'=>$final_payable_amt[$i],

                    'other_deduction'=>$request->other_deduction[$i],

                    'other_deduction_remark'=>$request->other_deduction_remark[$i],

                    'per_deduction'=>$request->per_deduction[$i],

                    'per_deduction_remark'=>$request->per_deduction_remark[$i],

                    'prev_deduction'=>$request->prev_deduction[$i],

                    'prev_deduction_remark'=>$request->prev_deduction_remark[$i],

                    'vendor_deduction'=>$request->vendor_deduction,

                    'vendor_reimbursement'=>$request->vendor_reimbursement,

                    'tds'=>$request->tds,

                    'amount_after_tds'=>$request->amountafter_tds,

                    'status'=>$status,

                    'vendor_confirm'=>$approvalStatus,

                    'vendor_previous_deduction_remarks'=>$request->vendor_previous_deduction_remarks,

                    'vendor_reimbursement_remark'=>$request->vendor_reimbursement_remark,


                    'delete_status'=>'0',

                    'created_by'=>auth()->user()->id

                ]);



            } else {



                $billno = $billCheck[0]->bill_no;

                $billSummary = Billsummary::where('parisishtha_a_id', $val)->update([

                    'parisishtha_b_id'=>$parisishtha_b_id[$i],

                    'division_id'=>$division_id[$i],

                    'depot_id'=>$depot_id[$i],

                    'billing_period'=>$billingPeriod,

                    'gov_voucher_no'=>$voucher_no[$i],

                    'route_id' => $request->route_id[$i],

                    'vehicle_id'=>$vehicle_id[$i],

                    'vendor_id'=>$vendor_id,

                    'vendorinvoice_id'=>$vendorinvoice_id[$i],

                    'vendor_invoice_amt'=>$vendor_invoice_amt[$i],

                    'gov_approve_amt'=>$gov_approve_amt[$i],

                    'vendor_deduction_amt'=>$vendor_deduction_amt[$i],

                    'final_payable_amt'=>$final_payable_amt[$i],

                    'other_deduction'=>$request->other_deduction[$i],

                    'other_deduction_remark'=>$request->other_deduction_remark[$i],

                    'per_deduction'=>$request->per_deduction[$i],

                    'per_deduction_remark'=>$request->per_deduction_remark[$i],

                    'prev_deduction'=>$request->prev_deduction[$i],

                    'prev_deduction_remark'=>$request->prev_deduction_remark[$i],

                    'vendor_deduction'=>$request->vendor_deduction,

                    'vendor_reimbursement'=>$request->vendor_reimbursement,

                    'tds'=>$request->tds,

                    'amount_after_tds'=>$request->amountafter_tds,

                    'vendor_previous_deduction_remarks'=>$request->vendor_previous_deduction_remarks,

                    'vendor_reimbursement_remark'=>$request->vendor_reimbursement_remark,

                    'status'=>$status,

                    'vendor_confirm'=>$approvalStatus,

                    'delete_status'=>'0',

                    'created_by'=>auth()->user()->id

                ]);

            }





            $parisisthaa = ParisishthaA::findorfail($val);

            $parisisthaa->pay_status = '1';

            if($status == '1'){

                $parisisthaa->status = '1';

                $parishisthb = ParisishthaB::findorfail($parisishtha_b_id[$i]);

                $parishisthb->status = '1';

                $parishisthb->save();

            }

            $parisisthaa->save();

            $insrtedId[] = $billSummary->id;

            $i++;

        }

        DB::commit();

        $getModuleHierarchy = DB::table('module_hierarchies')->where('module_id','14')->orderBy('hierarchy_sequence','asc')->get();

        foreach($getModuleHierarchy as $key=>$val){



            BillSummaryConfirm::updateOrCreate(['billsummary_id'=>$billno,'usertype_id'=>$val->usertype_id],['billsummary_id'=>$billno,'depot_id'=>$depot_id[0],'division_id'=>$division_id[0],'usertype_id'=>$val->usertype_id,'sequence'=>$val->hierarchy_sequence,]);



            BillSummaryView::updateOrCreate(['billsummary_id'=>$billno,'usertype_id'=>$val->usertype_id],['parisishthaa_id'=>'0','parisishthab_id'=>'0','vendorinvoiceid'=>'0']);



        }

        /* set hierarchy */





        if($status == '1'){

            $getModuleHierarchy = DB::table('module_hierarchies')->where('module_id','14')->orderBy('hierarchy_sequence','asc')->get();

                foreach($getModuleHierarchy as $key=>$val){



                    BillSummaryConfirm::updateOrCreate(['billsummary_id'=>$billno,'usertype_id'=>$val->usertype_id],['billsummary_id'=>$billno,'depot_id'=>$depot_id[0],'division_id'=>$division_id[0],'usertype_id'=>$val->usertype_id,'sequence'=>$val->hierarchy_sequence,]);



                    BillSummaryView::updateOrCreate(['billsummary_id'=>$billno,'usertype_id'=>$val->usertype_id],['parisishthaa_id'=>'0','parisishthab_id'=>'0','vendorinvoiceid'=>'0']);



                }



        }

        return redirect($this->route)->with('msg','Bill Summary Insert Successfully');

    }



    public function edit($id){

        if (auth()->user()->usertype_id=='1') {

            return redirect('home');

        }

        $id = Crypt::decryptString($id);

        $modulename = $this->modulename;

        $route = $this->route;

        $action = 'update';

        $result = Billsummary::with('parisisthab','route','vendorinvoice')->where('bill_no',$id)->get();

        $vendor = Vendor::get();

        $vehicle = Vehicle::where('vendor_id',$result[0]->vendor_id)->where('status',1)->get();

        return view($this->view.'/form',compact('vendor','route','action','modulename','result','vehicle'));

    }



    public function update($id,Request $request){



        $approval = VmManager::get();



        $approvalStatus = $approval[0]->approve;

        $id = $request->id;

        echo "<pre>";





        foreach($request->parisishtha_a_id as $key=>$p_a_id)

        {





            $billSummary = Billsummary::where('parisishtha_b_id',$request->parisishtha_b_id[$key])->where('parisishtha_a_id',$p_a_id)->get();



            $billSummary[0]->vendor_invoice_amt = $request->vendor_invoice_amt[$key];

            $billSummary[0]->gov_approve_amt = $request->gov_approve_amt[$key];

            $billSummary[0]->vendor_deduction_amt = $request->vendor_deduction_amt[$key];

            $billSummary[0]->final_payable_amt = $request->final_payable_amt[$key];

            $billSummary[0]->other_deduction = $request->other_deduction[$key];

            $billSummary[0]->other_deduction_remark = $request->other_deduction_remark[$key];

            $billSummary[0]->per_deduction = $request->per_deduction[$key];

            $billSummary[0]->per_deduction_remark = $request->per_deduction_remark[$key];

            $billSummary[0]->vendor_previous_deduction_remarks = $request->vendor_previous_deduction_remarks;

            $billSummary[0]->vendor_reimbursement_remark = $request->vendor_reimbursement_remark;

            $billSummary[0]->status = $request->publish_flag;

            $billSummary[0]->vendor_confirm = $approvalStatus;

            $billSummary[0]->vendor_deduction = $request->vendor_deduction;

            $billSummary[0]->vendor_reimbursement = $request->vendor_reimbursement;

            $billSummary[0]->tds = $request->tds;

            $billSummary[0]->amount_after_tds = $request->amountafter_tds;

            $billSummary[0]->save();

            if($request->publish_flag == '1'){

                $request->parisishtha_a_id;

                $parisisthaa = ParisishthaA::findorfail($p_a_id);

                $parisisthaa->status = '1';

                $parisisthaa->save();

                $parishisthb = ParisishthaB::findorfail($request->parisishtha_b_id[$key]);

                $parishisthb->status = '1';

                $parishisthb->save();

           }







        }

        if($request->publish_flag == '1'){

            $getModuleHierarchy = DB::table('module_hierarchies')->where('module_id','14')->orderBy('hierarchy_sequence','asc')->get();



            foreach($getModuleHierarchy as $key=>$val){

                $billSummaryConfirm = new BillSummaryConfirm();

                BillSummaryConfirm::updateOrCreate(['billsummary_id'=>$billSummary[0]->bill_no,'usertype_id'=>$val->usertype_id],['billsummary_id'=>$billSummary[0]->bill_no,'depot_id'=>$billSummary[0]->depot_id,'division_id'=>$billSummary[0]->division_id,'usertype_id'=>$val->usertype_id,'sequence'=>$val->hierarchy_sequence]);



                BillSummaryView::updateOrCreate(['billsummary_id'=>$id,'usertype_id'=>$val->usertype_id],['parisishthaa_id'=>'0','parisishthab_id'=>'0','vendorinvoiceid'=>'0']);

            }

        }

        /* set hierarchy */



        DB::table('billsummary_log')->insert(

            ['billsummary_id' => $billSummary[0]->bill_no, 'user_id' => auth()->user()->id,'updated_at'=>date('Y-m-d H:i:s')]

        );



        return redirect($this->route)->with('msg', 'Bill Summary Update Successfully');

    }



    public function show($id){

        $id = Crypt::decryptString($id);



        $billsummary = Billsummary::with('route','vendorinvoice')->where('bill_no',$id)->get();

        $vendor = Vendor::get();

        $vehicle = Vehicle::where('status',1)->get();

        $modulename = $this->modulename;

        $route = $this->route;

        $data = DB::table('billsummary_log')->select('billsummary_log.*','users.first_name','users.last_name')->join('users', 'billsummary_log.user_id', '=', 'users.id')->where('billsummary_log.billsummary_id',$id)->get();

		return view($this->view.'/view',compact('modulename','vendor','vehicle','route','billsummary','data'));

    }

    public function showApproval($id){

        $id = Crypt::decryptString($id);

        DB::enableQueryLog();

        $result = DB::table('billsummary_confirm')

            ->join('usertypes', 'usertypes.id', '=', 'billsummary_confirm.usertype_id')

            ->leftjoin('users','users.id','=','billsummary_confirm.confirm_by')

            ->select('billsummary_confirm.*','usertypes.name as usertype_name','users.first_name','users.last_name')

            ->where('billsummary_confirm.billsummary_id',$id)

            ->get();



        $resultquery = DB::table('billsummary_confirm')

            ->join('usertypes', 'usertypes.id', '=', 'billsummary_confirm.usertype_id')

            ->leftjoin('users','users.id','=','billsummary_confirm.user_id')

            ->select('billsummary_confirm.*','usertypes.name as usertype_name','users.first_name','users.last_name')

            ->where('billsummary_confirm.billsummary_id',$id)

            ->where('billsummary_confirm.query','!=',null)

            ->get();

        $modulename = $this->modulename;

        $route = $this->route;



		return view($this->view.'/show_history',compact('modulename','route','result','resultquery'));

    }

    public function editHistoryBillSummary($id)

    {



        $id = Crypt::decryptString($id);

        $data = DB::table('billsummary_log')->select('billsummary_log.*','users.first_name','users.last_name')->join('users', 'billsummary_log.user_id', '=', 'users.id')->where('billsummary_log.billsummary_id',$id)->get();

        $modulename = 'Bill Summary Edit History';

        $redirect = $this->route;

        if($data->count()>0)

        {

            return view($this->view.'/edithistory',compact('data','redirect','modulename'));

        }

        else

        {

            return redirect($this->route)->with('msg','There is no Edit History For this Bill Summary ');

        }

    }

    public function printBillsummary($id)

    {

        $id = Crypt::decryptString($id);



        $billsummary = Billsummary::with('parisisthab','route','vendorinvoice')->where('bill_no',$id)->get();

        $vendor = Vendor::get();

        $vehicle = Vehicle::where('status',1)->get();

        $depots = Depot::get();

        $division = Division::get();

        $result = DB::table('billsummary_confirm')

        ->join('usertypes', 'usertypes.id', '=', 'billsummary_confirm.usertype_id')

        ->leftjoin('users','users.id','=','billsummary_confirm.confirm_by')

        ->leftjoin('users as u','u.id','=','billsummary_confirm.user_id')

        ->select('billsummary_confirm.*','usertypes.name as usertype_name','users.first_name','users.last_name','u.first_name as fm','u.last_name as lm')

        ->where('billsummary_confirm.billsummary_id',$id)

        ->get();

        $html = view($this->view.'/pdf',compact('vendor','vehicle','billsummary','result','division','depots'))->render();

        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false);

        return $pdf->stream('billsummary','compress');

        // return $pdf->stream('Job_card_'.date('d-m-Y H:i:s'), 'compress');



    }



    public function destroy($id){

        $id = Crypt::decryptString($id);
        $billsummary = Billsummary::where('bill_no',$id)->first();

        if(Billsummary::where('bill_no',$id)->delete()){
            ParisishthaA::where('id', $billsummary->parisishtha_a_id)->update(['pay_status'=>0]);

            echo json_encode(true);

        }

        else{

            echo json_encode(false);

        }

    }

}

