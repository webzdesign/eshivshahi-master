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
use App\Model\Vehicle;
use App\Model\ParisishthaA;
use App\Model\ParisishthaB;
use App\Model\BillSummaryView;
use App\Model\VmManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables,Helper,DB;


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
            $billSummay = Billsummary::with('vendorinvoice')->where('delete_status','0')->orderBy('id', 'asc')->get();
        }else{

            if($accessTypeId == '3'){
                $depotId = $this->depotId;
                $billSummay = Billsummary::with('vendorinvoice')->where('delete_status','0')->where('depot_id',$depotId)->orderBy('id', 'asc')->get();
            }
            if($accessTypeId == '2'){
                $divisionId = $this->divisionId;
                $billSummay = Billsummary::with('vendorinvoice')->where('delete_status','0')->where('division_id',$divisionId)->orderBy('id', 'asc')->get();
            }
        }

		return Datatables::of($billSummay)
        ->addColumn('actions', function($billSummay) use($permission,$accessTypeId) {
            if($this->userTypeId != '1'){
                if($accessTypeId == '3'){
                    if($permission[0]->view == '1'){
                        $editView = "<a id='view' href='$this->route/".Crypt::encryptString($billSummay->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a>";
                        if($billSummay->status == '1'){
                            $editView .= "<a id='edit' href='$this->route/showapproval/".Crypt::encryptString($billSummay->id)."' class='btn  btn-success btn-xs'><i class='fa fa-eye'></i> Show Approval History</a>";
                        }
                    }
                    if($billSummay->update_status == '0'){
                        if($permission[0]->edit == '1'){
                            if($billSummay->status == '0'){
                                $editView = "<a id='edit' href='$this->route/".Crypt::encryptString($billSummay->id)."/edit' class='btn  btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</a>";
                            }else{
                                $editView .= "<a id='edit' href='$this->route/".Crypt::encryptString($billSummay->id)."/edit' class='btn  btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</a>";
                            }
                        }
                    }
                    return $editView;
                }

                if($accessTypeId == '2'){
                    if($permission[0]->view == '1'){
                        $editView = "<a id='view' href='$this->route/".Crypt::encryptString($billSummay->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a>";
                        if($billSummay->status == '1'){
                            $editView .= "<a id='edit' href='$this->route/showapproval/".Crypt::encryptString($billSummay->id)."' class='btn  btn-success btn-xs'><i class='fa fa-eye'></i> Show Approval History</a>";
                        }
                    }
                    if($billSummay->update_status_division == '0'){
                        if($permission[0]->edit == '1'){
                            if($billSummay->status == '0'){
                                $editView = "<a id='edit' href='$this->route/".Crypt::encryptString($billSummay->id)."/edit' class='btn  btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</a>";
                            }else{
                                $editView .= "<a id='edit' href='$this->route/".Crypt::encryptString($billSummay->id)."/edit' class='btn  btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</a>";
                            }
                        }
                    }
                    return $editView;
                }

            }else{
                $editView = "<a id='view' href='$this->route/".Crypt::encryptString($billSummay->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a>";
                if($billSummay->update_status == '0'){
                    $editView .= "<a id='edit' href='$this->route/".Crypt::encryptString($billSummay->id)."/edit' class='btn  btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</a>";
                }
                $editView.= "<a id='edit' href='$this->route/showapproval/".Crypt::encryptString($billSummay->id)."' class='btn  btn-success btn-xs'><i class='fa fa-eye'></i> Show Approval History</a>";
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
        ->addIndexColumn()
        ->make(true);

    }

    public function create(){
        $modulename = $this->modulename;
        $route = $this->route;
        $action = 'insert';
        $parisishthaAData = ParisishthaA::get();
        $vendor = Vendor::get();
        return view($this->view.'/form',compact('vendor','route','action','modulename','parisishthaAData'));
    }

    public function getVehicleData(Request $request){
        $vendor_id = $request->vendor_id;
		$vehicle = Vehicle::where('vendor_id',$vendor_id)->get();
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


        if($this->userTypeId == '1'){
            $parisishthaa = ParisishthaA::with('vendorinvoice','vehicle')->where('billing_period',$billnigPeriod)->where('vendor_id',$vendor_id)->where('pay_status','0')->get();
        }else{
            $accessTypeId = $this->accessTypeId;

            if($accessTypeId == '3'){
                $depotId = $this->depotId;
                $parisishthaa = ParisishthaA::with('vendorinvoice','vehicle')->where('vendor_id',$vendor_id)->where('billing_period',$billnigPeriod)->where('pay_status','0')->where('depot_id',$depotId)->get();
            }
            if($accessTypeId == '2'){
                $divisionId = $this->divisionId;
                $parisishthaa = ParisishthaA::with('vendorinvoice','vehicle')->where('vendor_id',$vendor_id)->where('billing_period',$billnigPeriod)->where('pay_status','0')->where('division_id',$divisionId)->get();
            }
        }

        return view($this->view.'/show',compact('vendor_id','vehicle_id','parisishthaa'));
    }


    public function store(Request $request){
        $from_date = date("Y-m-d",strtotime($request->from_date));
        $to_date = date("Y-m-d",strtotime($request->to_date));
        $billingPeriod = $from_date.','.$to_date;
        $parisishtha_a_id = $request->parisishtha_a_id;
        $parisishtha_b_id = $request->parisishtha_b_id;
        $depot_id = $request->depot_id;
        $division_id = $request->division_id;
        $voucher_no = $request->voucher_no;
        $vehicle_id = $request->vehicle_id;
        $vehicle_id_reff = $request->vehicle_id_reff;
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
            $billSummary = Billsummary::updateOrCreate(['parisishtha_a_id'=>$val],['parisishtha_a_id'=>$val,
                'parisishtha_b_id'=>$parisishtha_b_id[$i],
                'division_id'=>$division_id[$i],
                'depot_id'=>$depot_id[$i],
                'billing_period'=>$billingPeriod,
                'gov_voucher_no'=>$voucher_no[$i],
                'vehicle_id_reff'=>$request->vehicle_id_reff[$i],
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
                'status'=>$status,
                'vendor_confirm'=>$approvalStatus,
                'delete_status'=>'0',
                'created_by'=>auth()->user()->id
            ]);
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

        /* set hierarchy */


        if($status == '1'){
            $getModuleHierarchy = DB::table('module_hierarchies')->where('module_id','14')->orderBy('hierarchy_sequence','asc')->get();

            $t=0;
            foreach($insrtedId as $k=>$v){
                foreach($getModuleHierarchy as $key=>$val){
                    BillSummaryConfirm::updateOrCreate(['billsummary_id'=>$v,'usertype_id'=>$val->usertype_id],['billsummary_id'=>$v,'depot_id'=>$depot_id[$t],'division_id'=>$division_id[$t],'usertype_id'=>$val->usertype_id,'sequence'=>$val->hierarchy_sequence,]);

                    BillSummaryView::updateOrCreate(['billsummary_id'=>$v,'usertype_id'=>$val->usertype_id],['parisishthaa_id'=>'0','parisishthab_id'=>'0','vendorinvoiceid'=>'0']);
                }
                $t++;
            }
        }
        return redirect($this->route)->with('msg','Bill Summary Insert Successfully');
    }

    public function edit($id){
        $id = Crypt::decryptString($id);
        $modulename = $this->modulename;
        $route = $this->route;
        $action = 'update';
        $result = Billsummary::findorfail($id);
        $vendor = Vendor::get();
        $vehicle = Vehicle::where('vendor_id',$result->vendor_id)->get();
        $parisishthaa = ParisishthaA::with('vendorinvoice','vehicle')->where('id',$result->parisishtha_a_id)->get();
        return view($this->view.'/form',compact('vendor','route','action','modulename','result','vehicle','parisishthaa'));
    }

    public function update(Request $request){
        $approval = VmManager::get();
        $approvalStatus = $approval[0]->approve;
        $id = $request->id;
        $billSummary = Billsummary::findorfail($id);
        $billSummary->vendor_invoice_amt = $request->vendor_invoice_amt;
        $billSummary->gov_approve_amt = $request->gov_approve_amt;
        $billSummary->vendor_deduction_amt = $request->vendor_deduction_amt;
        $billSummary->final_payable_amt = $request->final_payable_amt;
        $billSummary->other_deduction = $request->other_deduction;
        $billSummary->other_deduction_remark = $request->other_deduction_remark;
        $billSummary->per_deduction = $request->per_deduction;
        $billSummary->per_deduction_remark = $request->per_deduction_remark;
        $billSummary->prev_deduction = $request->prev_deduction;
        $billSummary->prev_deduction_remark = $request->prev_deduction_remark;
        $billSummary->status = $request->publish_flag;
        $billSummary->vendor_confirm = $approvalStatus;
        $billSummary->save();

        /* set hierarchy */

        if($request->publish_flag == '1'){
            $getModuleHierarchy = DB::table('module_hierarchies')->where('module_id','14')->orderBy('hierarchy_sequence','asc')->get();

            foreach($getModuleHierarchy as $key=>$val){
                $billSummaryConfirm = new BillSummaryConfirm();
                BillSummaryConfirm::updateOrCreate(['billsummary_id'=>$id,'usertype_id'=>$val->usertype_id],['billsummary_id'=>$id,'depot_id'=>$billSummary->depot_id,'division_id'=>$billSummary->division_id,'usertype_id'=>$val->usertype_id,'sequence'=>$val->hierarchy_sequence]);

                BillSummaryView::updateOrCreate(['billsummary_id'=>$id,'usertype_id'=>$val->usertype_id],['parisishthaa_id'=>'0','parisishthab_id'=>'0','vendorinvoiceid'=>'0']);
            }
        }

        if($request->publish_flag == '1'){
            $request->parisishtha_a_id;
            $parisisthaa = ParisishthaA::findorfail($request->parisishtha_a_id);
            $parisisthaa->status = '1';
            $parisisthaa->save();
            $parishisthb = ParisishthaB::findorfail($request->parisishtha_b_id);
            $parishisthb->status = '1';
            $parishisthb->save();
        }

        return redirect($this->route)->with('msg', 'Bill Summary Update Successfully');
    }

    public function show($id){
        $id = Crypt::decryptString($id);
        $billsummary = Billsummary::with('vehicle','vendorinvoice')->findorfail($id);
        $vendor = Vendor::get();
        $vehicle = Vehicle::get();
        $modulename = $this->modulename;
        $route = $this->route;

		return view($this->view.'/view',compact('modulename','vendor','vehicle','route','billsummary'));
    }
    public function showApproval($id){
        $id = Crypt::decryptString($id);
        $result = DB::table('billsummary_confirm')
            ->join('usertypes', 'usertypes.id', '=', 'billsummary_confirm.usertype_id')
            ->leftjoin('users','users.id','=','billsummary_confirm.confirm_by')
            ->select('billsummary_confirm.*','usertypes.name as usertype_name','users.first_name','users.last_name')
            ->where('billsummary_confirm.billsummary_id',$id)
            ->get();
        $modulename = $this->modulename;
        $route = $this->route;

		return view($this->view.'/show_history',compact('modulename','route','result'));
    }
}
