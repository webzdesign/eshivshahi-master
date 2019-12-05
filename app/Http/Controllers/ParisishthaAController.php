<?php

namespace App\Http\Controllers;
use App\Model\ParisishthaB;
use App\Model\ParisishthaA;
use App\Model\Depot;
use App\Model\Vendor;
use App\Model\Division;
use App\Model\Accesstype;
use App\Model\Usertype;
use App\Model\Vendorinvoice;
use App\Model\Billsummary;
use App\Model\BillSummaryConfirm;
use App\Model\RouteMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables,DB,Helper,PDF;

class ParisishthaAController extends Controller
{
    public $route = 'parisishthaa';
    public $view = 'parisishthaa';
	public $primaryid = 'id';
    public $modulename = 'Parisishtha A';
    public $msgName = 'Parisishtha A';

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
            $checkPermission = Helper::getModulePermission('13',$this->userTypeId);
            if($checkPermission){
                return redirect('/home')->send();
            }
        }
        $userTypeId = $this->userTypeId;
        $modulename = $this->modulename;
        $route = $this->route;
        $dataurl = 'getParisisthB';
        return view($this->view.'/index',compact('modulename','route','dataurl','userTypeId'));
    }


    public function create($id){

        $id = Crypt::decryptString($id);
        $parisishthabCheck = ParisishthaB::findorfail($id);
        if($parisishthabCheck->vendorinvoice_id == ''){
            $parisishthab = ParisishthaB::with(['depot','vendor','vendorinvoice','route'])->findorfail($id);
            $vendorInvoiceFlag = 0;
        }else{
            $parisishthab = ParisishthaB::with(['depot','vendor','route'])->findorfail($id);
            $vendorInvoiceFlag = 1;
        }
        /*get schedule kms */
        $route_id = $parisishthab->route_id;
        $scheduleKm = RouteMaster::where('id',$route_id)->first();
        $scheduleKm = $scheduleKm->scheduled_km;
        $dates = $parisishthab->from_date;
        $dayOfWeek = date("d", strtotime($dates));
       
        $month = date("m", strtotime($dates));

        $year = date("Y", strtotime($dates));
        $new_date = date($year.'-'.$month.'-'.'01');
        $previous_date='';
        if(date("d", strtotime($dates)) == 16 )
        {
            $previous_data = ParisishthaB::with('depot','vendor','vendorinvoice','route')->where('route_id',$parisishthab->route_id)->where('id','!=',$id)->where('from_date',$new_date)->first();
            $firstDays = 0;
        } else{
            $firstDays = 1;
        }

        $modulename = $this->modulename;
        $route = $this->route;
        $totalKm = $parisishthab->total_km;
        $noOfDay = count(array_filter(explode(",",$parisishthab->kms)));
        $p_k = explode("*++*",$parisishthab->relevant_agreement);
        $schedule_complete = explode("*++*",$parisishthab->schedule_complete);
        $kmsAll = explode(",",$parisishthab->kms);
        $cntdays = 0;

        foreach($kmsAll as $key=>$kms){
            if($kms != ''){
                if($kms >= $scheduleKm){
                    $cntdays++;
                }
                else
                {
                    if($p_k[$key]==1 || $schedule_complete[$key] == 1)
                    {
                        $cntdays++;
                    }
                }
            }
        }
        

       /* foreach($kmsAll as $key=>$kms){
            if($kms != ''){
                if($kms > 0){
                    $cntdays++;
                }
            }
        }*/

        /* if($cntdays == '0'){
            return redirect($this->route)->with('msg','All Kms Are Not Greater Then This Route.');
        } */

		return view($this->view.'/form',compact('modulename','route','parisishthab','vendorInvoiceFlag','scheduleKm','previous_data', 'prevParisishthaa', 'firstDays'));
    }

    public function getParisisthB(){
        /* get Permission */
        $permission = Helper::getPermission('13',$this->userTypeId);
        $accessTypeId = $this->accessTypeId;
        $depotId = $this->depotId;
        $divisionId = $this->divisionId;

        if($this->userTypeId == '1'){
            $parisishthabs = DB::table('parisishtha_bs')
            ->join('vendors', 'vendors.id', '=', 'parisishtha_bs.vendor_id')
            ->join('route_masters', 'parisishtha_bs.route_id', '=', 'route_masters.id')
            ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
            ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
            ->leftjoin('parisishtha_as','parisishtha_as.parisishtha_b_id','=','parisishtha_bs.id')
            ->select('parisishtha_bs.*','vendors.vendor_name','parisishtha_as.status as parisisthaaStatus','parisishtha_as.id as pria_id','parisishtha_as.amount_payable', 'route_masters.from_depot','d1.name as from_depot','d2.name as to_depot', 'route_masters.scheduled_time')
            ->where('parisishtha_bs.status',1)
            ->whereNull('parisishtha_bs.deleted_at')
            ->orderBy('parisishtha_bs.id', 'desc')
            ->get();
        }else{
            if($accessTypeId == '3'){
                $parisishthabs = DB::table('parisishtha_bs')
                ->join('vendors', 'vendors.id', '=', 'parisishtha_bs.vendor_id')
                ->join('route_masters', 'parisishtha_bs.route_id', '=', 'route_masters.id')
                ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
                ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
                ->leftjoin('parisishtha_as','parisishtha_as.parisishtha_b_id','=','parisishtha_bs.id')
                ->select('parisishtha_bs.*','vendors.vendor_name','parisishtha_as.status as parisisthaaStatus','parisishtha_as.id as pria_id','parisishtha_as.amount_payable','route_masters.from_depot','d1.name as from_depot','d2.name as to_depot', 'route_masters.scheduled_time')
                ->where('parisishtha_bs.depot_id',$depotId)
                ->where('parisishtha_bs.status',1)
                ->whereNull('parisishtha_bs.deleted_at')
                ->orderBy('parisishtha_bs.id', 'desc')
                ->get();
            }else{
                $parisishthabs = DB::table('parisishtha_bs')
                ->join('vendors', 'vendors.id', '=', 'parisishtha_bs.vendor_id')
                ->join('route_masters', 'parisishtha_bs.route_id', '=', 'route_masters.id')
                ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
                ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
                ->leftjoin('parisishtha_as','parisishtha_as.parisishtha_b_id','=','parisishtha_bs.id')
                ->select('parisishtha_bs.*','vendors.vendor_name','parisishtha_as.status as parisisthaaStatus','parisishtha_as.id as pria_id','parisishtha_as.amount_payable','route_masters.from_depot','d1.name as from_depot','d2.name as to_depot', 'route_masters.scheduled_time')
                ->where('parisishtha_bs.division_id',$divisionId)
                ->where('parisishtha_bs.status',1)
                ->whereNull('parisishtha_bs.deleted_at')
                ->orderBy('parisishtha_bs.id', 'desc')
                ->get();
            }
        }


		return Datatables::of($parisishthabs)
            ->addColumn('actions', function($parisishthabs)use($permission,$accessTypeId){
                if($parisishthabs->is_parisishtha_a_created == '0' && $parisishthabs->status == '1'){
                    if($this->userTypeId != '1'){
                        if($permission[0]->create != '0'){
                            return "<a href='$this->route/create/".Crypt::encryptString($parisishthabs->id)."' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Generate</a>";
                        }
                    }else{
                        //return "<a href='$this->route/create/".Crypt::encryptString($parisishthabs->id)."' class='btn btn-success btn-xs'><i class='fa fa-pencil'></i> Generate</a>";
                    }
                }

                if($accessTypeId == '3'){
                    if($this->userTypeId != '1'){
                        if($permission[0]->edit != '0'){
                            if($parisishthabs->update_status == '0'){
                                $editView = "<a href='$this->route/".Crypt::encryptString($parisishthabs->id)."/edit' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</a><a class='btn btn-danger btn-xs vendor pa-confirm-delete' data-id='".Crypt::encryptString($parisishthabs->id)."' ><i class='fa fa-trash'></i> Delete</a>";
                            }
                        }
                        if($permission[0]->view != '0'){
                            if($permission[0]->edit != '0' && $parisishthabs->update_status == '0'){
                                $editView .= "<a href='$this->route/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a><a href='printparisishthaA/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-info btn-xs' target='_blank'><i class='fa fa-print'></i> Print </a>";
                            }else{
                                $editView = "<a href='$this->route/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a><a href='printparisishthaA/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-info btn-xs' target='_blank'><i class='fa fa-print'></i> Print </a>";
                            }
                        }

                        return $editView;
                    }else{
                        return "<a href='$this->route/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a><a href='printparisishthaA/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-info btn-xs' target='_blank'><i class='fa fa-print'></i> Print </a>";
                    }
                }
                else if($accessTypeId == '2'){
                    if($this->userTypeId != '1'){
                        if($permission[0]->edit != '0'){
                            if($parisishthabs->update_status_division == '0'){
                                $editView = "<a href='$this->route/".Crypt::encryptString($parisishthabs->id)."/edit' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</a><a class='btn btn-danger btn-xs vendor pa-confirm-delete' data-id='".Crypt::encryptString($parisishthabs->id)."' ><i class='fa fa-trash'></i> Delete</a>";
                            }
                        }
                        if($permission[0]->view != '0'){
                            if($permission[0]->edit != '0' && $parisishthabs->update_status_division == '0'){
                                $editView .= "<a href='$this->route/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a>";
                            }else{
                                $editView = "<a href='$this->route/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a><a href='printparisishthaA/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-info btn-xs' target='_blank'><i class='fa fa-print'></i> Print </a>";
                            }
                        }
                        return $editView;
                    }else{
                        return "<a href='$this->route/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a><a href='printparisishthaA/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-info btn-xs' target='_blank'><i class='fa fa-print'></i> Print </a>";
                    }
                }else{
                    return "<a href='$this->route/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a><a href='printparisishthaA/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-info btn-xs' target='_blank'><i class='fa fa-print'></i> Print </a>";
                }
            })
            ->editColumn('voucher_date', function($parisishthabs){
                $voucher_date = date("d-m-Y",strtotime($parisishthabs->voucher_date));
                return  $voucher_date;
            })
            ->editColumn('route_id', function($parisishthabs){
                return $parisishthabs->from_depot.'-'.$parisishthabs->to_depot.'('.$parisishthabs->scheduled_time.')';
            })
            ->editColumn('billing_period', function($parisishthabs) {
                $billing_period=explode(",",$parisishthabs->billing_period);
                $from=date("d-m-Y",strtotime($billing_period[0]));
                $to=date("d-m-Y",strtotime($billing_period[1]));
                return  $from ." to ".$to;
                })
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request){
        $parisisthb_id = $request->parisisthab_id;
        $parisishthab = ParisishthaB::findorfail($parisisthb_id);

      //  print_r($_POST); exit();
        ParisishthaA::updateOrCreate(['parisishtha_b_id'=>$parisisthb_id],['parisishtha_b_id'=>$parisisthb_id,
        'division_id'=>$parisishthab->division_id,
        'depot_id'=>$parisishthab->depot_id,
        'billing_period'=>$parisishthab->billing_period,
        'vendor_id'=>$parisishthab->vendor_id,
        'vendorinvoice_id'=>$parisishthab->vendorinvoice_id,
        'voucher_no'=>$parisishthab->voucher_no,
        'voucher_date'=>$parisishthab->voucher_date,
        'route_id'=>$parisishthab->route_id,
        'vehicle_id'=>implode(",",array_unique(explode(",",$parisishthab->vehicle_id))),
        'total_kms'=>$request->actualKm,
        'avg_kms'=>$request->averageKm,
        'per_km_rate'=>$request->rate,
        'amount'=>$request->amount,
        'total_amount'=>$request->finalAmount,
        'avg_km_as_per_contract'=>$request->pActualKm,'avg_km_total_as_per_contract'=>$request->pAverageKm,
        'rate_for_avg_km'=>$request->pRate,
        'amount_for_avg_km'=>$request->pAmount,
        'total_amount_for_avg'=>$request->pFinalAmount,
        'diesel_amt'=>$request->diselAmount,
        'diesel_rate'=>$request->dRate,
        'diesel_amount'=>$request->dAmount,
        'diesel_final_amount'=>$request->dFinalAmount,
        'amountWoDeduct'=>$request->totalAmount,
        'extra_diesel_amt'=>$request->extra_diesel_amt,
        'adblue_charge'=>$request->adblue_charge,
        'vehical_exp'=>$request->vehical_exp,
        'vor_exp'=>$request->vor_exp,
        'parking_charge'=>$request->parking_charge,
        'hault_tax'=>$request->hault_tax,
        'wash_exp'=>$request->wash_exp,
        'other_exp'=>$request->other_exp,
        'total_tax'=>$request->subTotal,
        'amount_payable'=>$request->finalAmountTotal,
        'status'=>$request->publish_flag,
        'pay_status'=>'0',
        'delete_status'=>'0',
        'diesel_saving' => $request->diesel_saving,
        'created_by'=>auth()->user()->id]);

        $parisishthab->is_parisishtha_a_created = 1;
        $parisishthab->save();

        return redirect($this->route)->with('msg', 'Parisishtha A Generate Successfully');
    }


    public function show($id){
        $id = Crypt::decryptString($id);
        $parisishthabCheck = ParisishthaB::findorfail($id);
        if($parisishthabCheck->vendorinvoice_id == ''){
            $parisishthab = ParisishthaB::with('depot','vendor','vendorinvoice','vehicle')->findorfail($id);
            $vendorInvoiceFlag = 0;
        }else{
            $parisishthab = ParisishthaB::with('depot','vendor','vehicle')->findorfail($id);
            $vendorInvoiceFlag = 1;
        }
        $parisishthabId = $parisishthab->id;
        $modulename = $this->modulename;
        $route = $this->route;
        $action = 'insert';
        $getdata='getinvoice';
        $getinvoicedata='getinvoicedata';

        $parisishthaa = ParisishthaA::where('parisishtha_b_id',$parisishthabId)->first();
        $data = DB::table('parisishtha_as_log')->select('parisishtha_as_log.*','users.first_name','users.last_name')->join('users', 'parisishtha_as_log.user_id', '=', 'users.id')->where('parisishtha_as_log.parisishtha_a_id',$parisishthaa->id)->get();
		return view($this->view.'/show',compact('modulename','route','action','parisishthab','parisishthaa','vendorInvoiceFlag','data'));
    }


    public function edit($id){
        if (auth()->user()->usertype_id=='1') {
            return redirect('home');
        }
        $id = Crypt::decryptString($id);
        $parisishthabCheck = ParisishthaB::findorfail($id);
        if($parisishthabCheck->vendorinvoice_id == ''){
            $parisishthab = ParisishthaB::with('depot','vendor','vendorinvoice','vehicle')->findorfail($id);
            $vendorInvoiceFlag = 0;
        }else{
            $parisishthab = ParisishthaB::with('depot','vendor','vehicle')->findorfail($id);
            $vendorInvoiceFlag = 1;
        }
        $parisishthaa = ParisishthaA::where('parisishtha_b_id',$id)->get();
        $modulename = $this->modulename;
        $route = $this->route;


		return view($this->view.'/_form',compact('modulename','route','parisishthab','parisishthaa','vendorInvoiceFlag'));
    }


    public function update(Request $request, ParisishthaA $parisishthaA){
        $parisisthaId = $request->id;
        $parisisthb_id = $request->parisisthab_id;
        $parisishthab = ParisishthaB::findorfail($parisisthb_id);

        $parisistha = ParisishthaA::findorfail($parisisthaId);
        $parisistha->parisishtha_b_id = $parisisthb_id;
        $parisistha->division_id =$parisishthab->division_id;
        $parisistha->depot_id = $parisishthab->depot_id;
        $parisistha->billing_period = $parisishthab->billing_period;
        $parisistha->vendor_id = $parisishthab->vendor_id;
        $parisistha->vendorinvoice_id = $parisishthab->vendorinvoice_id;
        $parisistha->voucher_no = $parisishthab->voucher_no;
        $parisistha->voucher_date = $parisishthab->voucher_date;
        $parisistha->route_id = $parisishthab->route_id;
        $parisistha->vehicle_id = implode(",",array_unique(explode(",",$parisishthab->vehicle_id)));
        $parisistha->total_kms = $request->actualKm;
        $parisistha->avg_kms = $request->averageKm;
        $parisistha->per_km_rate = $request->rate;
        $parisistha->amount = $request->amount;
        $parisistha->total_amount = $request->finalAmount;
        $parisistha->avg_km_as_per_contract = $request->pActualKm;$parisistha->avg_km_total_as_per_contract = $request->pAverageKm;
        $parisistha->rate_for_avg_km = $request->pRate;
        $parisistha->amount_for_avg_km = $request->pAmount;
        $parisistha->total_amount_for_avg = $request->pFinalAmount;
        $parisistha->diesel_amt = $request->diselAmount;
        $parisistha->diesel_rate = $request->dRate;
        $parisistha->diesel_amount = $request->dAmount;
        $parisistha->diesel_final_amount = $request->dFinalAmount;
        $parisistha->adblue_charge = $request->adblue_charge;
        $parisistha->amountWoDeduct = $request->totalAmount;
        $parisistha->extra_diesel_amt = $request->extra_diesel_amt;
        $parisistha->vehical_exp = $request->vehical_exp;
        $parisistha->vor_exp = $request->vor_exp;
        $parisistha->parking_charge = $request->parking_charge;
        $parisistha->hault_tax = $request->hault_tax;
        $parisistha->wash_exp = $request->wash_exp;
        $parisistha->other_exp = $request->other_exp;
        $parisistha->total_tax = $request->subTotal;
        $parisistha->amount_payable = $request->finalAmountTotal;
        $parisistha->status = $request->publish_flag;
        $parisistha->pay_status = '0';
        $parisistha->diesel_saving = $request->diesel_saving;
        $parisistha->updated_by = auth()->user()->id;
        $parisistha->save();


        /* get bill sumary id */
        DB::table('billsummaries')->where('parisishtha_a_id',$parisisthaId)->update(['delete_status'=>'1']);
        DB::table('parisishtha_as_log')->insert(
            ['parisishtha_a_id' => $parisisthaId, 'user_id' => auth()->user()->id,'updated_at'=>date('Y-m-d H:i:s')]
        );
        return redirect($this->route)->with('msg', 'Parisishtha A Update Successfully');
    }
    public function edithistoryA($id)
    {
        $id = Crypt::decryptString($id);
        $parisishthaa = ParisishthaA::where('parisishtha_b_id',$id)->get();
        $data = DB::table('parisishtha_as_log')->select('parisishtha_as_log.*','users.first_name','users.last_name')->join('users', 'parisishtha_as_log.user_id', '=', 'users.id')->where('parisishtha_as_log.parisishtha_a_id',$parisishthaa[0]->id)->get();
        $redirect = $this->route;
        $modulename = 'Parisishtha A Edit History';
        if($data->count()>0)
        {
            return view($this->view.'/edithistory',compact('data','redirect','modulename'));
        }
        else
        {
            return redirect($this->route)->with('msg','There is no Edit History For this Parisishtha A ');
        }
    }
    public function printparisishthaA($id){
        $id = Crypt::decryptString($id);
        $parisishthabCheck = ParisishthaB::findorfail($id);
        if($parisishthabCheck->vendorinvoice_id == ''){
            $parisishthab = ParisishthaB::with('depot','vendor','vendorinvoice','vehicle')->findorfail($id);
            $vendorInvoiceFlag = 0;
        }else{
            $parisishthab = ParisishthaB::with('depot','vendor','vehicle')->findorfail($id);
            $vendorInvoiceFlag = 1;
        }
        $parisishthabId = $parisishthab->id;
        $modulename = $this->modulename;
        $route = $this->route;
        $action = 'insert';
        $getdata='getinvoice';
        $getinvoicedata='getinvoicedata';

        $parisishthaa = ParisishthaA::where('parisishtha_b_id',$parisishthabId)->first();
        $html = view($this->view.'/pdf',compact('modulename','route','action','parisishthab','parisishthaa','vendorInvoiceFlag'))->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->stream();
    }

    public function destroy($id){
    $id = Crypt::decryptString($id);

        $pA_get = ParisishthaA::where('parisishtha_b_id',$id)->where('pay_status', 0)->first();
        if($pA_get){
            if(ParisishthaA::where('parisishtha_b_id',$id)->update(['delete_status' => 1])){
                ParisishthaB::where('id',$id)->Update(['is_parisishtha_a_created'=>0]);
                echo json_encode(true);
            }
            else{
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
        }

    }

}
