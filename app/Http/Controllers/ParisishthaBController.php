<?php

namespace App\Http\Controllers;

use App\Model\ParisishthaB;

use App\Model\ParisishthaA;

use App\Model\Depot;

use App\Model\Division;

use App\Model\Vendor;

use App\Model\Vendorinvoice;

use App\Model\Vehicle;

use App\Model\VendorManager;

use App\Model\VendorAccountant;

use App\Model\CityMaster;

use App\Model\Billsummary;

use App\Model\RouteMaster;

use App\Model\Charge;

use Illuminate\Http\Request;

use DataTables;

use Illuminate\Support\Facades\Crypt;

use DB,Helper,PDF;

class ParisishthaBController extends Controller
{

    public $route = 'parisishthab';
    public $view = 'parisishthab';
	public $primaryid = 'id';
    public $modulename = 'Parisishtha B';
    public $msgName = 'Parisishtha B';

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

            $checkPermission = Helper::getModulePermission('12',$this->userTypeId);

            if($checkPermission){

                return redirect('/home')->send();
            }
        }

        $permission = Helper::getPermission('12',$this->userTypeId);
        $userTypeId = $this->userTypeId;
        $modulename = $this->modulename;
        $route = $this->route;
        $dataurl = 'getparisishthab';
        return view($this->view.'/index',compact('modulename','route','dataurl','permission','userTypeId'));
    }

    public function getVehicle(Request $request)
	{
        $vendorId = $request->vendor_id;

        $vehicleData = Vehicle::where('status',1)->where('vendor_id', $vendorId)->get();

		if(count($vehicleData) > 0){
            echo '<option value=""></option>';
            echo '<option value="noVehicle">No Vehicle</option>';
			foreach($vehicleData as $vehicleVal){
				echo '<option value="'.$vehicleVal->id.'">'.$vehicleVal->vehicle_no.'</option>';
			}
		} else {
			echo '<option value=""></option>';
		}
    }

    public function getDepot(Request $request)
    {

        $division_id =  $request->division_id;

        $getDepot = Depot::where('division_id',$division_id)->get();

        if(count($getDepot) > 0){

			echo '<option value=""></option>';

			foreach($getDepot as $depo){

				echo '<option value="'.$depo->id.'">'.$depo->name.'</option>';
			}
		}else{
			echo '<option value=""></option>';
		}
    }

    public function getparisishthab()
    {
        /* get Permission */
        $permission = Helper::getPermission('12',$this->userTypeId);
        $accessTypeId = $this->accessTypeId;

        if($this->userTypeId == '1'){
            $parisishthabs = ParisishthaB::with('vendor', 'route')->orderBy('id','desc')->get();
        }else{

            if($accessTypeId == '3'){
                $depotId = $this->depotId;
                $parisishthabs = ParisishthaB::with('vendor','route')->where('depot_id',$depotId)->orderBy('id','desc')->get();
            }
            if($accessTypeId == '2'){
                $divisionId = $this->divisionId;
                $parisishthabs = ParisishthaB::with('vendor','route')->where('division_id',$divisionId)->orderBy('id','desc')->get();
            }
        }

        return Datatables::of($parisishthabs)

            ->editColumn('route', function($parisishthabs){
                return $parisishthabs->route->fromdepot->name.'-'.$parisishthabs->route->todepot->name.' ('.$parisishthabs->route->scheduled_time.' - '.$parisishthabs->route->scheduled_number.')';
            })

            ->editColumn('invoice_no', function($parisishthabs){
                return $parisishthabs->invoice_no->invoice_no;
            })

            ->addColumn('actions', function($parisishthabs) use($permission,$accessTypeId) {

                if($this->userTypeId != '1'){

                    if($accessTypeId == '3'){

                        if($permission[0]->edit == '1'){

                            if($parisishthabs->update_status==0){

                                $editView =  "<a id='edit' href='$this->route/".Crypt::encryptString($parisishthabs->id)."/edit' class='btn  btn-warning btn-xs'><i class='fa fa-pencil'></i> Edit</a><a class='btn btn-danger btn-xs vendor pb-confirm-delete' data-id='".Crypt::encryptString($parisishthabs->id)."' ><i class='fa fa-trash'></i> Delete</a>";

                            }

                        }

                        if($permission[0]->view == '1'){

                            if($permission[0]->edit == '1' && $parisishthabs->update_status==0){

                                $editView .=  "<a id='view' href='$this->route/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a><a id='print'  target ='_blank' href='printparisishthaB/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";

                            }else{

                                $editView =  "<a id='view' href='$this->route/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a><a id='print'  target ='_blank' href='printparisishthaB/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";

                            }

                        }

                        return $editView;

                    }

                    if($accessTypeId == '2'){

                        if($permission[0]->edit == '1'){

                            if($parisishthabs->update_status_division==0){

                                $editView =  "<a id='edit' href='$this->route/".Crypt::encryptString($parisishthabs->id)."/edit' class='btn  btn-warning btn-xs'><i class='fa fa-pencil'></i> Edit</a>

                                <a class='btn btn-danger btn-xs vendor pb-confirm-delete' data-id='".Crypt::encryptString($parisishthabs->id)."' ><i class='fa fa-trash'></i> Delete</a>";

                            }

                        }

                        if($permission[0]->view == '1'){

                            if($permission[0]->edit == '1' && $parisishthabs->update_status_division==0){

                                $editView .=  "<a id='view' href='$this->route/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a><a id='print'  target ='_blank' href='printparisishthaB/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";

                            }else{

                                $editView =  "<a id='view' href='$this->route/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a><a id='print'  target ='_blank' href='printparisishthaB/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";

                            }

                        }

                        return $editView;

                    }

                }else{

                    return "<a id='view' href='$this->route/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a>&nbsp;&nbsp;<a id='print'  target ='_blank' href='printparisishthaB/".Crypt::encryptString($parisishthabs->id)."' class='btn  btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";

                }



            })

            ->editColumn('vendor_name', function($parisishthabs) {

                return  $parisishthabs['vendor']->vendor_name;

            })

            ->editColumn('billing_period', function($parisishthabs) {

                $billing_period=explode(",",$parisishthabs->billing_period);

                $from=date("d-m-Y",strtotime($billing_period[0]));

                $to=date("d-m-Y",strtotime($billing_period[1]));

                return  $from ." to ".$to;

                })

            ->editColumn('voucher_date', function($parisishthabs){
                $date = date("d-m-Y",strtotime($parisishthabs->voucher_date));
                return $date;
            })

            ->editColumn('amount', function($parisishthabs) {
                return  $parisishthabs->extra_diesel_charged;
            })

            ->addIndexColumn()
            ->rawColumns(['billing_period'])
            ->make(true);
    }

    public function create(){

        if (auth()->user()->usertype_id=='1') {

            return redirect('home');

        }

        $modulename = $this->modulename;
        $route = $this->route;
        $action = 'insert';
        $vendors = Vendor::get();
        $vehicle = Vehicle::where('status',1)->get();
        $division = Division::get();

        if($this->accessTypeId == 2)
        {

            $routes = DB::table('route_masters')
            ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
            ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
            ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')
            ->where(function ($query){
                $query->where('route_masters.division_id',$this->divisionId)->orwhere('route_masters.to_division',$this->divisionId);
            })
            ->where('route_masters.status', 1)
            ->get();
        }
        else if($this->accessTypeId ==3)
        {
            $routes = DB::table('route_masters')
            ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
            ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
            ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')
            ->where(function ($query){
                $query->where('d2.id',$this->depotId)->orwhere('d1.id',$this->depotId);
            })
            ->where('route_masters.status', 1)
            ->get();
        }
        else
        {
            $routes = DB::table('route_masters')
            ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
            ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
            ->where('route_masters.status', 1)
            ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')
            ->get();
        }

        $depots = Depot::where('division_id',$this->divisionId)->get();
        $getdata='getinvoice';
        $checkinvoice='checkinvoice';
        $checkvoucher ='checkvoucher';
        $getinvoicedata='getinvoicedata';
        $userdepo = $this->depotId;
        $userdivision = $this->divisionId;
        $userTypeId = $this->userTypeId;
        $route_master = RouteMaster::get();
        $default_diseal = Charge::first();

        return view($this->view.'/form',compact('vendors','modulename','route','action','getdata','getinvoicedata','checkinvoice','checkvoucher','vehicle','depot','division','userdepo','userdivision','depots','routes','userTypeId','route_master','default_diseal'));
    }

    public function getIdelingminutes(Request $request)
    {

        $route_id = $request->route_id;

        $getminutes = Routemaster::where('id',$route_id)->get();

        $idealing_minutes = ($getminutes[0]->maximum_ideling_minutes)/5;

        $option = '<option value="0">0</option>';

        $cnt = 0;

        for($i = 0; $i<$idealing_minutes; $i++)

        {

          $cnt = $cnt+5;

          $option .="<option value='$cnt'>$cnt</option>";

        }

        return $option;

    }

    public function store(Request $request)
    {

        $from = date("Y-m-d",strtotime($request->from_date));

        $to = date("Y-m-d",strtotime($request->to));

        $billing_period = $from.",".$to;

        $voucher_date =  date("Y-m-d");

        $dates = $request->date_pb;

        $datearray = array();

        foreach($dates as $date)
        {
             $datearray[] = date("Y-m-d",strtotime($date));
        }

        $date =  implode(",",$datearray);

        $vehicle_id = implode("*++*",$request->vehicle_id);

        $agreement = implode("*++*",$request->p_k_v);
        $schedule_complete = implode("*++*",$request->s_c_v);


        $kms =  implode(",",$request->kms);

        $diesel_ltr =  implode(",",$request->diesel_ltr);

        $diese_per_ltr_price= implode(",",$request->diese_per_ltr_price);

        $adblue= implode(",",$request->adblue);

        $adblue_price=implode(",",$request->adblue_price);

        $breaddown_charge=implode(",",$request->breaddown_charge);

        $vor_exp=implode(",",$request->vor_exp);

        $parking_exp=implode(",",$request->parking_exp);

        $hault_tax=implode(",",$request->hault_exp);

        $wash_exp=implode(",",$request->wash_exp);

        $other_exp=implode(",",$request->other_exp);

        $idling_minutes = implode(",", $request->idling_minutes);

        $remarks = implode("*++*",$request->remarks);

       if($this->userTypeId == '1'){

           $depot_id = $request->depot_id;

           $division_id = $request->division_id;

       }

       else{

        $depot_id = $this->depotId;

        $division_id = $this->divisionId;

       }

        $breaddown_charge_value = implode("*++*",$request->breaddown_charge_value);

        ParisishthaB::create([

            'route_id'=>$request->route_id,


            'depot_id'=>$depot_id,

            'division_id'=>$division_id,

            'billing_period'=>$billing_period,

            'vendor_id'=>$request->vendor_id,

            'vendorinvoice_id'=>$request->invoice_no,

            'voucher_no'=>$request->voucher_no,

            'voucher_date'=>$voucher_date,

            'vehicle_id'=>$vehicle_id,

            'date'=>$date,

            'relevant_agreement'=>$agreement,

            'schedule_complete'=>$schedule_complete,

            'kms'=>$kms,

            'diesel_ltr'=>$diesel_ltr,

            'diese_per_ltr_price'=>$diese_per_ltr_price,

            'adblue'=>$adblue,

            'adblue_price'=>$adblue_price,

            'breaddown_charge'=>$breaddown_charge,

            'breaddown_charge_value'=>$breaddown_charge_value,

            'vor_exp'=>$vor_exp,

            'parking_exp'=>$parking_exp,

            'hault_tax'=>$hault_tax,

            'wash_exp'=>$wash_exp,

            'other_exp'=>$other_exp,

            'total_km'=>$request->kms_total,

            'diesel_as_per_gov'=>$request->gov_diesel,

            'extra_filled_diesel'=>$request->extra_diesel,

            'extra_diesel_charged'=>$request->extra_diesel_charge,

            'idling_minutes'=>$idling_minutes,

            'remarks'=>$remarks,

            'status'=>$request->status,

            'from_date'=>$from,

            'to_date'=>$to,

			'created_by'=>auth()->user()->id,

        ]);

        return redirect($this->route)->with('msg', 'Parisishtha B Inserted Successfully');
    }

    public function show($id)
    {

        $id = Crypt::decryptString($id);

        $parisishthab = ParisishthaB::with('depot')->findorfail($id);

        $modulename = $this->modulename;

        $route = $this->route;

        $action = 'view';

        $vendors = Vendor::get();

        $vendorinvoices = Vendorinvoice::get();

        $depots = Depot::get();

        $cities = CityMaster::get();

        $division = Division::get();

        $vehicle = Vehicle::where('status',1)->get();

        $schedule_time =RouteMaster::select('scheduled_time')->findorfail($parisishthab->route_id);



        $schedule_time = explode("*++*",$schedule_time->scheduled_time);

        $routes = DB::table('route_masters')

        ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')

        ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
        ->where('route_masters.status', 1)

        ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')

        ->get();

        $data = DB::table('parisishtha_bs_log')->select('parisishtha_bs_log.*','users.first_name','users.last_name')->join('users', 'parisishtha_bs_log.user_id', '=', 'users.id')->where('parisishtha_bs_log.parisishtha_bs_id',$id)->get();



        $vendorInvoiceId = $parisishthab->vendorinvoice_id;

        if($vendorInvoiceId != ''){

            $vendorinNo = Vendorinvoice::where('id',$vendorInvoiceId)->get();

            $invoiceNo = $vendorinNo[0]->invoice_no;



            $chekBill = Billsummary::where('vendorinvoice_id',$vendorInvoiceId)->get();

            if(! $chekBill->isEmpty()){

                $chekBill = 'yes';

            }else{

                $chekBill = 'no';

            }

        }else{

            $invoiceNo = '';

            $chekBill = 'no';

        }



        $getminutes = Routemaster::where('id',$parisishthab->route_id)->first();

        $idealing_minutes = ($getminutes->maximum_ideling_minutes)/5;



        $edit_ideal_min = array();

        $cnt = 0;

        $edit_ideal_min[]  = 0;

        for($i = 0; $i<$idealing_minutes; $i++)

        {

          $cnt = $cnt+5;

          $edit_ideal_min[] = $cnt;

        }

        $getSchKm = RouteMaster::where('id',$parisishthab->route_id)->first();
        $schduleKm = $getSchKm->scheduled_km;
        $schTimeNum = $getSchKm->scheduled_number.' - '.$getSchKm->scheduled_time;
        $default_diseal = Charge::first();

        $getdata='getinvoice';

        $getinvoicedata='getinvoicedata';

        $checkinvoice='checkinvoice';

        $checkvoucher ='checkvoucher';

        return view($this->view.'/viewForm',compact('user','vendors','modulename','route','action','dataurl','depots','vehicle','getdata','getinvoicedata','parisishthab','checkinvoice','checkvoucher','vendorinvoices','division','cities','routes','invoiceNo','chekBill','data','schedule_time','edit_ideal_min', 'default_diseal', 'schduleKm', 'schTimeNum'));

    }

    public function edit($id){

        //if (auth()->user()->usertype_id=='1') {

            //return redirect('home');

        //}

        $id = Crypt::decryptString($id);
        $parisishthab = ParisishthaB::with('depot')->findorfail($id);
        $modulename = $this->modulename;
        $route = $this->route;
        $action = 'update';
        $vendors = Vendor::get();

        // $routes = DB::table('route_masters')

        // ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')

        // ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')

        // ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')

        // ->get();

        if($this->accessTypeId == 2)
        {
            $routes = DB::table('route_masters')
            ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
            ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
            ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')
            ->where(function ($query){
                $query->where('route_masters.division_id',$this->divisionId)
                ->orwhere('route_masters.to_division',$this->divisionId);
            })
            ->where('route_masters.status', 1)
            ->get();
        }
        else if($this->accessTypeId ==3)
        {
            $routes = DB::table('route_masters')
            ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
            ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
            ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')
            ->where(function ($query){
                $query->where('d2.id',$this->depotId)
                ->orwhere('d1.id',$this->depotId);
            })
            ->where('route_masters.status', 1)
            ->get();
        }
        else
        {
            $routes = DB::table('route_masters')
            ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
            ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
            ->where('route_masters.status', 1)
            ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')
            ->get();
        }
        $schedule_time =RouteMaster::select('scheduled_time')->findorfail($parisishthab->route_id);
        $schedule_time = explode("*++*",$schedule_time->scheduled_time);
        $depots = Depot::get();
        $division = Division::get();
        $vendorId = $parisishthab->vendor_id;
        $vendorInvoiceId = $parisishthab->vendorinvoice_id;

        if($vendorInvoiceId != ''){
            $vendorinNo = Vendorinvoice::where('id',$vendorInvoiceId)->get();
            $invoiceNo = $vendorinNo[0]->invoice_no;

            $chekBill = Billsummary::where('vendorinvoice_id',$vendorInvoiceId)->get();
            if(! $chekBill->isEmpty()){
                $chekBill = 'yes';
            }else{
                $chekBill = 'no';
            }

        }else{
            $invoiceNo = '';
            $chekBill = 'no';
        }

        $cities = CityMaster::get();
        $vehicle = Vehicle::where('status',1)->where('vendor_id',$vendorId)->get();

        if($this->userTypeId == '1'){

            $vendorinvoices_id = ParisishthaB::where('id','!=',$parisishthab->id)->pluck('vendorinvoice_id')->toArray();

            $vendorinvoices_id = array_filter($vendorinvoices_id);

            $vendorinvoices = Vendorinvoice::whereNotIn('id',$vendorinvoices_id)->where('is_approved','1')->where('vendor_id',$vendorId)->get();

        }else{

           if($this->userTypeId != '2' || $this->userTypeId != '3'){

                $depot_id = $this->depotId;

                $division_id = $this->divisionId;

                $vendorinvoices_id = ParisishthaB::where('id','!=',$parisishthab->id)->pluck('vendorinvoice_id')->toArray();

                $vendorinvoices_id = array_filter($vendorinvoices_id);

                $vendorinvoices = Vendorinvoice::whereNotIn('id',$vendorinvoices_id)->where('is_approved','1')->where('vendor_id',$vendorId)->where('depot_id',$depot_id)->where('division_id',$division_id)->get();

           }else{

                $vendorinvoices_id = ParisishthaB::where('id','!=',$parisishthab->id)->pluck('vendorinvoice_id')->toArray();

                $vendorinvoices_id = array_filter($vendorinvoices_id);

                $vendorinvoices = Vendorinvoice::whereNotIn('id',$vendorinvoices_id)->where('is_approved','1')->where('vendor_id',$vendorId)->get();
           }

        }

        $getminutes = Routemaster::where('id',$parisishthab->route_id)->first();
        $idealing_minutes = ($getminutes->maximum_ideling_minutes)/5;

        $edit_ideal_min = array();
        $cnt = 0;
        $edit_ideal_min[]  = 0;
        for($i = 0; $i<$idealing_minutes; $i++)
        {
          $cnt = $cnt+5;
          $edit_ideal_min[] = $cnt;
        }

        $getSchKm = RouteMaster::where('id',$parisishthab->route_id)->first();
        $schduleKm = $getSchKm->scheduled_km;
        $schTimeNum = $getSchKm->scheduled_number.' - '.$getSchKm->scheduled_time;
        $default_diseal = Charge::first();

        $getdata='getinvoice';

        $getinvoicedata='getinvoicedata';

        $checkinvoice='checkinvoice';

        $checkvoucher ='checkvoucher';


        return view($this->view.'/_form',compact('user','vendors','modulename','route','action','depots','vehicle','getdata','getinvoicedata','parisishthab','checkinvoice','checkvoucher','vendorinvoices','division','cities','routes','invoiceNo','chekBill','schedule_time', 'edit_ideal_min', 'default_diseal', 'schduleKm', 'schTimeNum'));

    }

    public function update(Request $request, ParisishthaB $parisishthaB)
    {

        $voucher_date =  date("Y-m-d");

        $dates = $request->date_pb;

        $datearray = array();

        foreach($dates as $date)

        {

            $datearray[] = date("Y-m-d",strtotime($date));

        }

        $from = $datearray[0];

        $to = end($datearray);

        $billing_period = $from.",".$to;

        $date =  implode(",",$datearray);

        $p_k = implode("*++*",$request->p_k_v);
        $schedule_complete = implode("*++*",$request->s_c_v);

        $vehicle_id = implode("*++*",$request->vehicle_id);

        $kms =  implode(",",$request->kms);

        $diesel_ltr =  implode(",",$request->diesel_ltr);

        $diese_per_ltr_price= implode(",",$request->diese_per_ltr_price);

        $adblue= implode(",",$request->adblue);

        $adblue_price=implode(",",$request->adblue_price);

        $breaddown_charge=implode(",",$request->breaddown_charge);

        $vor_exp=implode(",",$request->vor_exp);

        $parking_exp=implode(",",$request->parking_exp);

        $hault_tax=implode(",",$request->hault_exp);

        $wash_exp=implode(",",$request->wash_exp);

        $other_exp=implode(",",$request->other_exp);

        $idling_minutes = implode(",", $request->idling_minutes);

        $remarks = implode("*++*",$request->remarks);

        $breaddown_charge_value = implode("*++*",$request->breaddown_charge_value);



        if(isset($request->save))

        {

            $status=0;

        }

        else

        {

            $status=1;

        }



       $parisishthaB=ParisishthaB::findorfail($request->id);

       $parisishthaB->route_id = $request->route_id;


        $parisishthaB->depot_id=$request->depot_id;

        $parisishthaB->division_id=$request->division_id;

        $parisishthaB->billing_period=$billing_period;

        $parisishthaB->vendor_id=$request->vendor_id;

        $parisishthaB->vendorinvoice_id=$request->invoice_no;

        $parisishthaB->voucher_no=$request->voucher_no;

        $parisishthaB->voucher_date=$voucher_date;

        $parisishthaB->vehicle_id=$vehicle_id;

        $parisishthaB->date=$date;

        $parisishthaB->relevant_agreement=$p_k;
        $parisishthaB->schedule_complete=$schedule_complete;

        $parisishthaB->kms=$kms;

        $parisishthaB->diesel_ltr=$diesel_ltr;

        $parisishthaB->diese_per_ltr_price=$diese_per_ltr_price;

        $parisishthaB->adblue=$adblue;

        $parisishthaB->adblue_price=$adblue_price;

        $parisishthaB->breaddown_charge=$breaddown_charge;

        $parisishthaB->breaddown_charge_value = $breaddown_charge_value;

        $parisishthaB->vor_exp=$vor_exp;

        $parisishthaB->parking_exp=$parking_exp;

        $parisishthaB->hault_tax=$hault_tax;

        $parisishthaB->wash_exp = $wash_exp;

        $parisishthaB->other_exp=$other_exp;

        $parisishthaB->total_km=$request->kms_total;

        $parisishthaB->diesel_as_per_gov=$request->gov_diesel;

        $parisishthaB->extra_filled_diesel=$request->extra_diesel;

        $parisishthaB->extra_diesel_charged=$request->extra_diesel_charge;

        $parisishthaB->idling_minutes = $idling_minutes;

        $parisishthaB->remarks = $remarks;

        $parisishthaB->status=$request->status;

        $parisishthaB->is_parisishtha_a_created='0';

		$parisishthaB->updated_by=auth()->user()->id;

        $parisishthaB->save();



        /* delete parisishtha A and bill summary */



        $parisistha = ParisishthaA::where('parisishtha_b_id',$request->id)->get();



        DB::table('parisishtha_as')->where('parisishtha_b_id',$request->id)->update(['delete_status'=>'1']);

        if(! $parisistha->isEmpty()){

            DB::table('billsummaries')->where('parisishtha_a_id',$parisistha[0]->id)->update(['delete_status'=>'1']);

        }

        DB::table('parisishtha_bs_log')->insert(

            ['parisishtha_bs_id' => $request->id, 'user_id' => auth()->user()->id,'updated_at'=>date('Y-m-d H:i:s')]

        );



        return redirect($this->route)->with('msg','Parisishtha B Updated Successfully');

    }





    public function destroy($id){

        $id = Crypt::decryptString($id);



        $parisishthaA = parisishthaA::where('parisishtha_b_id', $id)->where('delete_status', 0)->first();

        if($parisishthaA){

            echo json_encode(false);

        }

        else{



            if(ParisishthaB::findOrFail($id)->delete()){

                echo json_encode(true);

            }

            else{

                echo json_encode(false);

            }

        }



    }





    public function getinvoice(Request $request)

    {

        $vendor_id = $request->vendor_id;
        $route_id = $request->route_id;

        $from = date("Y-m-d",strtotime($request->from_date));
        $to = date("Y-m-d",strtotime($request->to));
        $billing_period = $from.",".$to;

        $rows = Vendorinvoice::where('route_id', $route_id)->where('vendor_id',$request->vendor_id)->where('billing_period',$billing_period)->where('is_approved','1')->get();
        if($request->p_id !='')
        {
            $count = ParisishthaB::where('route_id', $route_id)->where('from_date',$from)->where('to_date',$to)->where('id','!=',$request->p_id)->count();
        }
        else
        {
            $count = ParisishthaB::where('route_id', $route_id)->where('from_date',$from)->where('to_date',$to)->count();
        }

        if(! $rows->isEmpty()){
            $res[0] = $rows[0]->id;
            $res[1] = $rows[0]->invoice_no;
            $res[2] = '';
        } else {
            $res[0] = '';
            $res[1] = '';
            $res[2] = '';
        }

        if($count >0)
        {
            $res[3] =false;
        }
        else
        {
            $res[3]=true;
        }
        echo json_encode($res);
    }

    public function getinvoicedata(Request $request)

    {

        $row=Vendorinvoice::with(['depot','vehicle'])->findorfail($request->invoice_id);

        $dates=explode(",",$row->billing_period);

        $response=array('from'=>date_format(date_create($dates[0]),"d-m-Y"),'to'=>date_format(date_create($dates[1]),"d-m-Y"),'vehicle_id'=>$row->vehicle_id_reff,'depot_id'=>$row->depot_id,'division_id'=>$row->division_id,'vehicle_no'=>$row['vehicle']->vehicle_no,'viewInvoice'=>route('vendorinvoice.show',encrypt($request->invoice_id)));

        echo json_encode($response);

    }

    public function checkinvoice(Request $request)

    {

        if($request->id=='')

        {

            $rows=ParisishthaB::where('vendor_id',$request->vendor_id)->where('vendorinvoice_id',$request->invoice_id)->count();

        }

        else

        {

            $rows=ParisishthaB::where('vendor_id',$request->vendor_id)->where('vendorinvoice_id',$request->invoice_id)->where('id','!=',$request->id)->count();

        }



        if($rows>0)

        {

            echo json_encode(false);

        }

        else

        {

            echo json_encode(true);

        }

    }

    public function checkvoucher(Request $request)

    {

        if($request->id=='')

        {

            $rows=ParisishthaB::where('voucher_no',$request->voucher_no)->count();

        }

        else

        {

            $rows=ParisishthaB::where('voucher_no',$request->voucher_no)->where('id','!=',$request->id)->count();

        }

        if($rows>0)

        {

            echo json_encode(false);

        }

        else

        {

            echo json_encode(true);

        }

    }

    public function checkCityName(Request $request){

        $name = trim($request->name);

        $checkCity = CityMaster::where('name',$name)->get();

        if($checkCity->isEmpty()){

            echo json_encode(true);

        }else{

            echo json_encode(false);

        }

    }

    public function addCityName(Request $request){

        $name = ucwords(trim($request->name));

        $city = new CityMaster();

        $city->name = $name;

        $city->save();



        $res[1] = $city->id;

        $res[2] = $name;

        echo json_encode($res);

        exit;

    }

    // public function getScheduledtime(Request $request)

    // {

    //     $routedata = RouteMaster::findorfail($request->route_id);

    //     $s_time = explode("*++*",$routedata->scheduled_time);

    //     $option = '<option></option>';

    //     foreach($s_time as $time)

    //     {

    //         $option .="<option value='$time'>$time</option>";

    //     }

    //     return $option;

    // }

    public function checkperiod(Request $request)

    {

        $from_date = date('Y-m-d',strtotime($request->from_date));

        $to_date = date('Y-m-d',strtotime($request->to_date));

        $count = ParisishthaB::where('from_date',$from_date)->where('to_date',$to_date)->where('vehicle_id_reff',$request->vehicle_no)->count();

        if($count >0)

        {

            echo json_encode(false);

        }

        else

        {

            echo json_encode(true);

        }

    }

    public function edithistory($id)

    {

        $id = Crypt::decryptString($id);

        $data = DB::table('parisishtha_bs_log')->select('parisishtha_bs_log.*','users.first_name','users.last_name')->join('users', 'parisishtha_bs_log.user_id', '=', 'users.id')->where('parisishtha_bs_log.parisishtha_bs_id',$id)->get();

        $redirect = $this->route;

        $modulename = 'Parisishtha B Edit History';

        if($data->count()>0)

        {

            return view($this->view.'/edithistory',compact('data','redirect','modulename'));

        }

        else

        {

            return redirect($this->route)->with('msg','There is no Edit History For this Parisishtha B ');

        }

    }

    public function checkbus(Request $request)

    {

        $from_date = date('Y-m-d',strtotime($request->from_date));

        $to_date = date('Y-m-d',strtotime($request->to_date));

        if(isset($request->id))

        {

            if($request->id !='')

            {

                $rows=ParisishthaB::where('from_date',$from_date)->where('to_date',$to_date)->where('id','!=',$request->id)->get();

            }

        }

        else

        {

            $rows=ParisishthaB::where('from_date',$from_date)->where('to_date',$to_date)->get();

        }

        // echo $rows->count();

        $cnt=0;



        if($rows->count()>0)

        {

            foreach($rows as $check)

            {

                $dates=$check->date;

                $vehicle_num = $check->vehicle_id;



                $check_date = explode(',',$dates);

                $check_bus = explode("*++*",$vehicle_num);

                if(in_array($request->vechicle_no,$check_bus))

                {

                    foreach($check_date as $dt_pb)

                    if($dt_pb==date('Y-m-d',strtotime($request->dt)))

                    {

                            $cnt++;

                    }

                }

            }

        }

        if($cnt>0)

        {

            echo json_encode(false);

        }

        else

        {

            echo json_encode(true);

        }

    }

    public function printparisishthaB($id)

    {

        $id = Crypt::decryptString($id);

        $parisishthab = ParisishthaB::findorfail($id);

        $modulename = $this->modulename;

        $route = $this->route;

        $vendors = Vendor::get();

        $vehicle = Vehicle::where('status',1)->pluck('vehicle_no', 'id')->toArray();

        $division = Division::get();

        $cities = CityMaster::get();

            $routes = DB::table('route_masters')
            ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
            ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
            ->where('route_masters.status', 1)
            ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')
            ->get();

        $depots = Depot::get();

        //$depots = Depot::where('division_id',$this->divisionId)->get();

        $getdata='getinvoice';

        $checkinvoice='checkinvoice';

        $checkvoucher ='checkvoucher';

        $getinvoicedata='getinvoicedata';

        $userdepo = $this->depotId;

        $userdivision = $this->divisionId;

        $userTypeId = $this->userTypeId;

        $vendorInvoiceId = $parisishthab->vendorinvoice_id;

        if($vendorInvoiceId != ''){

            $vendorinNo = Vendorinvoice::where('id',$vendorInvoiceId)->get();

            $invoiceNo = $vendorinNo[0]->invoice_no;

        }

        else

        {

            $invoiceNo='';

        }

        $html = view($this->view.'/pdf',compact('parisishthab','vendors','modulename','route','dataurl','getdata','getinvoicedata','checkinvoice','checkvoucher','vehicle','depot','division','userdepo','userdivision','depots','cities','routes','userTypeId','invoiceNo'))->render();

        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false);

        return $pdf->stream();

    }

    public function Checkdate(Request $request)

    {

        $from_dt = date_create(date_format($request->from_date),'Y-m-d');

        $to_dt = date_create(date_format($request->to_date),'Y-m-d');

        $from_date = strtotime($request->from_date);

        $to_date = strtotime($request->to_date);

        $current_date = strtotime(date('d-m-Y'));



        $fromDay = date('d',$from_date);

        $toDay = date('d',$to_date);



        $res=array();

        $res['success'] = true;



        if (date('m',$from_date) != date('m',$to_date)) {



            $res['success'] = false;

            $res['message'] = "You Cannot Make Parisishtha B For Diffrent Month";



        } else {



            if($from_date <= $current_date && $to_date<=$current_date)

            {



                $currentDayOfMonth = cal_days_in_month(CAL_GREGORIAN, date('m',$from_date), date('Y',$to_date)); // 31

                /* $diff = abs($to_date - $from_date);

                $years = floor($diff / (365*60*60*24));

                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                $actualdays = $days+1; */



                $diff = $to_date - $from_date;

                $actualdays = abs(round($diff / 86400)) + 1;



                if($currentDayOfMonth==30)

                {

                    $adays = $currentDayOfMonth/2;

                    if($actualdays>$adays)

                    {

                        $res['success'] = false;

                        $res['message'] = "You Cannot Make Parisishtha B For More Than ".$adays." Days";

                    }

                    else

                    {

                        $res['success'] = true;

                    }



                    if ($fromDay <= 15) {

                        if ($toDay > 15) {

                            $res['success'] = false;

                            $res['message'] = "Parishistha B can not be created  for more than 15 days. Please select billing period 1 to 15 or 16 to 30/31 as applicable.";

                        } else {

                            $res['success'] = true;

                        }

                    }

                }

                else if($currentDayOfMonth==31)

                {

                    $fdays = floor($currentDayOfMonth/2);

                    $ldays = ceil($currentDayOfMonth/2);



                    if(date('j')>15)

                    {

                        if($actualdays>$ldays)

                        {

                            $res['success'] = false;

                            $res['message'] = "You Cannot Make Parisishtha B For More Than ".$ldays." Days";

                        }

                        else

                        {

                            $res['success'] = true;

                        }

                    }

                    else

                    {

                        if($actualdays>$ldays)

                        {

                            $res['success'] = false;

                            $res['message'] = "You Cannot Make Parisishtha B For More Than ".$fdays." Days";

                        }

                        else

                        {

                            $res['success'] = true;

                        }

                    }



                    if ($fromDay <= 15) {

                        if ($toDay > 15) {

                            $res['success'] = false;

                            $res['message'] = "Parishistha B can not be created  for more than 15 days. Please select billing period 1 to 15 or 16 to 30/31 as applicable.";

                        } else {

                            $res['success'] = true;

                        }

                    }

                }

                else if($currentDayOfMonth==28)

                {

                    $fdays = 15;

                    $ldays = 13;

                    if(date('j')>15)

                    {

                        if($actualdays>$ldays)

                        {

                            $res['success'] = false;

                            $res['message'] = "You Cannot Make Vendor Invoice For More Than ".$ldays." Days";

                        }

                        else

                        {

                            $res['success'] = true;

                        }

                    }

                    else

                    {

                        if($actualdays>$fdays)

                        {

                            $res['success'] = false;

                            $res['message'] = "You Cannot Make Vendor Invoice For More Than ".$fdays." Days";

                        }

                        else

                        {

                            $res['success'] = true;

                        }

                    }



                    if ($fromDay <= 15) {

                        if ($toDay > 15) {

                            $res['success'] = false;

                            $res['message'] = "Invoice can not be created for more than 15 days. Please select billing period 1 to 15 or 16 to 30/31 as applicable.";

                        } else {

                            $res['success'] = true;

                        }

                    }

                }

                else if($currentDayOfMonth==29)

                {

                    $fdays = floor($currentDayOfMonth/2);

                    $ldays = ceil($currentDayOfMonth/2);

                    if(date('j')>15)

                    {

                        if($actualdays>$ldays)

                        {

                            $res['success'] = false;

                            $res['message'] = "You Cannot Make Parisishtha B For More Than ".$ldays." Days";

                        }

                        else

                        {

                            $res['success'] = true;

                        }

                    }

                    else

                    {

                        if($actualdays>$fdays)

                        {

                            $res['success'] = false;

                            $res['message'] = "You Cannot Make Parisishtha B For More Than ".$fdays." Days";

                        }

                        else

                        {

                            $res['success'] = true;

                        }

                    }



                    if ($fromDay <= 15) {

                        if ($toDay > 15) {

                            $res['success'] = false;

                            $res['message'] = "Parishistha B can not be created  for more than 15 days. Please select billing period 1 to 15 or 16 to 30/31 as applicable.";

                        } else {

                            $res['success'] = true;

                        }

                    }

                }

            }

            else if($from_date <=$current_date && $to_date >= $current_date)

            {

                $currentDayOfMonth = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); // 31



                /* $diff = abs($to_date - $from_date);

                $years = floor($diff / (365*60*60*24));

                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

                $days = floor(($diff - $years * 365*60*60*24 -

                $months*30*60*60*24)/ (60*60*24));

                $actualdays = $days+1; */



                $diff = $to_date - $from_date;

                $actualdays = abs(round($diff / 86400)) + 1;



                if($currentDayOfMonth==30)

                {

                    $adays = $currentDayOfMonth/2;

                    if($actualdays>$adays)

                    {

                        $res['success'] = false;

                        $res['message'] = "You Cannot Make Parisishtha B For More Than ".$adays." Days";

                    }

                    else

                    {

                        $res['success'] = true;

                    }



                    if ($fromDay <= 15) {

                        if ($toDay > 15) {

                            $res['success'] = false;

                            $res['message'] = "Parishistha B can not be created  for more than 15 days. Please select billing period 1 to 15 or 16 to 30/31 as applicable.";

                        } else {

                            $res['success'] = true;

                        }

                    }

                }

                else if($currentDayOfMonth==31)

                {

                    $fdays = floor($currentDayOfMonth/2);

                    $ldays = ceil($currentDayOfMonth/2);

                    if(date('j')>15)

                    {

                        if($actualdays>$ldays)

                        {

                            $res['success'] = false;

                            $res['message'] = "You Cannot Make Parisishtha B For More Than ".$ldays." Days";

                        }

                        else

                        {

                            $res['success'] = true;

                        }

                    }

                    else

                    {

                        if($actualdays>$ldays)

                        {

                            $res['success'] = false;

                            $res['message'] = "You Cannot Make Parisishtha B For More Than ".$fdays." Days";

                        }

                        else

                        {

                            $res['success'] = true;

                        }

                    }



                    if ($fromDay <= 15) {

                        if ($toDay > 15) {

                            $res['success'] = false;

                            $res['message'] = "Parishistha B can not be created  for more than 15 days. Please select billing period 1 to 15 or 16 to 30/31 as applicable.";

                        } else {

                            $res['success'] = true;

                        }

                    }

                }

                else if($currentDayOfMonth==28)

                {

                    $adays = $currentDayOfMonth/2;

                    if($currentDayOfMonth>$adays)

                    {

                        $res['success'] = false;

                        $res['message'] = "You Cannot Make Parisishtha B For More Than ".$adays." Days";

                    }

                    else

                    {

                        $res['success'] = true;

                    }



                    if ($fromDay <= 15) {

                        if ($toDay > 15) {

                            $res['success'] = false;

                            $res['message'] = "Parishistha B can not be created  for more than 15 days. Please select billing period 1 to 15 or 16 to 30/31 as applicable.";

                        } else {

                            $res['success'] = true;

                        }

                    }

                }

                else if($currentDayOfMonth==29)

                {

                    $fdays = floor($currentDayOfMonth/2);

                    $ldays = ceil($currentDayOfMonth/2);

                    if(date('j')>15)

                    {

                        if($actualdays>$ldays)

                        {

                            $res['success'] = false;

                            $res['message'] = "You Cannot Make Parisishtha B For More Than ".$ldays." Days";

                        }

                        else

                        {

                            $res['success'] = true;

                        }

                    }

                    else

                    {

                        if($actualdays>$fdays)

                        {

                            $res['success'] = false;

                            $res['message'] = "You Cannot Make Parisishtha B For More Than ".$fdays." Days";

                        }

                        else

                        {

                            $res['success'] = true;

                        }

                    }



                    if ($fromDay <= 15) {

                        if ($toDay > 15) {

                            $res['success'] = false;

                            $res['message'] = "Parishistha B can not be created  for more than 15 days. Please select billing period 1 to 15 or 16 to 30/31 as applicable.";

                        } else {

                            $res['success'] = true;

                        }

                    }

                }

            }

            else

            {

                $res['success'] = false;

                $res['message'] = "Parishistha B can not be created for future date.";

            }

        }





        echo json_encode($res);

    }

    public function getschedulekm(Request $request){
        $route_id = $request->route_id;
        $scheduleKm = RouteMaster::where('id',$route_id)->first();
        $res[0] = $scheduleKm->scheduled_km;
        echo json_encode($res);
    }

    public function checkDisealPrice(Request $request){

        $diese_per_ltr_price = $request->diese_per_ltr_price;
        $result = Charge::first();

        if(($result->diesel_rate) >= $diese_per_ltr_price) {
            $res[0] = true;
        } else {
            $res[0] = false;
        }
        $res[1] = $result->diesel_rate;
        echo json_encode($res);
    }

}

