<?php

namespace App\Http\Controllers;
use App\Model\ParisishthaB;
use App\Model\ParisishthaA;
use App\Model\Billsummary;
use App\Model\Depot;
use App\Model\Division;
use App\Model\Vendor;
use App\Model\Vendorinvoice;
use App\Model\Vehicle;
use App\Model\VendorManager;
use App\Model\VendorAccountant;
use App\Model\CityMaster;
use App\Model\RouteMaster;
use App\Model\Charge;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Crypt;
use DB,Helper,Auth,PDF;


class VendorinvoicesController extends Controller
{
    public $route = 'vendorinvoice';
    public $view = 'vendorinvoice';
	public $primaryid = 'id';
    public $modulename = 'Vendor Invoice';
    public $msgName = 'Vendor Invoice';

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
        $modulename = $this->modulename;
        $route = $this->route;
        return view($this->view.'/index', compact('modulename', 'route'));
    }

    public function getVehicle(Request $request)
	{
		$vendorId = $request->vendor_id;
		$vehicleData = Vehicle::where('status', 1)->where('vendor_id', $vendorId)->get();
		if(count($vehicleData) > 0){
			echo '<option value=""></option>';
			foreach($vehicleData as $vehicleVal){
				echo '<option value="'.$vehicleVal->id.'">'.$vehicleVal->vehicle_no.'</option>';
			}
		} else {
			echo '<option value=""></option>';
		}
    }

    public function getschedulekm(Request $request){
        $route_id = $request->route_id;
        $scheduleKm = RouteMaster::where('id', $route_id)->first();
        $res[0] = $scheduleKm->scheduled_km;
        echo json_encode($res);
    }

    public function getavgrate(Request $request){
        $avgKm = $request->avgKm;
        $route_id = $request->route_id;
        $rate = Helper::getRate($avgKm, $route_id);
        $res[0] = $rate;
        echo json_encode($res);
    }

    public function getDepot(Request $request)
    {
        $division_id =  $request->division_id;
        $getDepot = Depot::where('division_id', $division_id)->get();

        if(count($getDepot) > 0){
			echo '<option value=""></option>';
			foreach($getDepot as $depo){
				echo '<option value="'.$depo->id.'">'.$depo->name.'</option>';
			}
		}else{
			echo '<option value=""></option>';
		}
    }

    public function getRoutesVehicle(Request $request)
    {
        $division_id =  $request->division_id;
        $depot_id =  $request->depot_id;
        $vendor_id =  $request->vendor_id;

        if ($division_id > 0 && $depot_id > 0) {
            $routes = DB::table('route_masters')
                ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
                ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
                ->where('route_masters.division_id', $division_id)
                ->where('route_masters.from_depot', $depot_id)
                ->where('route_masters.status', 1)
                ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot', 'route_masters.scheduled_number')
                ->get();

            $return['status'] = true;
            $return['routes'] = $routes;

        } else  {
            $return['status'] = false;
        }
        echo json_encode($return);

    }

    public function getvendorinvoicedata()
    {
        $vendorinvoice_id=ParisishthaB::pluck('vendorinvoice_id')->toArray();
		if(auth()->user()->usertype_id=='1'){
				$vendorinvoice = DB::table('vendorinvoices')
                ->join('vendors', 'vendorinvoices.vendor_id', '=', 'vendors.id')
                ->join('route_masters', 'vendorinvoices.route_id', '=', 'route_masters.id')
                ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
                ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
                ->select('vendorinvoices.*', 'vendors.vendor_name','route_masters.from_depot','d1.name as from_depot','d2.name as to_depot', 'route_masters.scheduled_time', 'route_masters.scheduled_number')
                ->orderBy('vendorinvoices.id', 'desc')
                ->whereNull('vendorinvoices.deleted_at')
				->get();
		}else{
			if(auth()->user()->usertype_id=='2'){
				$id = auth()->user()->id;
				$getvendorId = VendorManager::where('user_id',$id)->first();
				$vendor_id = $getvendorId['vendor_id'];
				$vendordetail = Vendor::where('id',$vendor_id)->get();
				$vendorinvoice = DB::table('vendorinvoices')
                ->join('vendors', 'vendorinvoices.vendor_id', '=', 'vendors.id')
                ->join('route_masters', 'vendorinvoices.route_id', '=', 'route_masters.id')
                ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
                ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
                ->where('vendorinvoices.vendor_id',$vendor_id)
                ->select('vendorinvoices.*', 'vendors.vendor_name','route_masters.from_depot','d1.name as from_depot','d2.name as to_depot', 'route_masters.scheduled_time', 'route_masters.scheduled_number')
                ->orderBy('vendorinvoices.id', 'desc')
                ->whereNull('vendorinvoices.deleted_at')
				->get();
			}else if(auth()->user()->usertype_id=='3'){
				$id = auth()->user()->id;
                $getvendoracId = VendorAccountant::where('user_id',$id)->first();
				$vendor_id = $getvendoracId->vendor_id;
				$vendordetail = Vendor::where('id',$vendor_id)->get();
				$vendorinvoice = DB::table('vendorinvoices')
                ->join('vendors', 'vendorinvoices.vendor_id', '=', 'vendors.id')
                ->join('route_masters', 'vendorinvoices.route_id', '=', 'route_masters.id')
                ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
                ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
				->where('vendorinvoices.vendor_id',$vendor_id)
                ->select('vendorinvoices.*', 'vendors.vendor_name',
                'route_masters.from_depot','d1.name as from_depot','d2.name as to_depot', 'route_masters.scheduled_time', 'route_masters.scheduled_number')
                ->orderBy('vendorinvoices.id', 'desc')
                ->whereNull('vendorinvoices.deleted_at')
				->get();
            }else{
                if($this->accessTypeId == '3'){
                    $depotId = $this->depotId;
                    $vendorinvoice = DB::table('vendorinvoices')
                    ->join('vendors', 'vendorinvoices.vendor_id', '=', 'vendors.id')
                    ->join('route_masters', 'vendorinvoices.route_id', '=', 'route_masters.id')
                    ->join('parisishtha_bs','vendorinvoices.id', '=', 'parisishtha_bs.vendorinvoice_id')
                    ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
                    ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
                    ->where('vendorinvoices.depot_id',$depotId)
                    ->select('vendorinvoices.*', 'vendors.vendor_name','parisishtha_bs.vendorinvoice_id', 'route_masters.from_depot','d1.name as from_depot','d2.name as to_depot', 'route_masters.scheduled_time', 'route_masters.scheduled_number')
                    ->orderBy('vendorinvoices.id', 'desc')
                    ->whereNull('vendorinvoices.deleted_at')
                    ->get();

                }
                if($this->accessTypeId == '2'){
                    $divisionId = $this->divisionId;

                    $vendorinvoice = DB::table('vendorinvoices')
                    ->join('vendors', 'vendorinvoices.vendor_id', '=', 'vendors.id')
                    ->join('route_masters', 'vendorinvoices.route_id', '=', 'route_masters.id')
                    ->join('parisishtha_bs','vendorinvoices.id', '=', 'parisishtha_bs.vendorinvoice_id')
                    ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
                    ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
                    ->where('vendorinvoices.division_id',$divisionId)
                    ->select('vendorinvoices.*', 'vendors.vendor_name','parisishtha_bs.vendorinvoice_id', 'parisishtha_bs.vendorinvoice_id', 'route_masters.from_depot','d1.name as from_depot','d2.name as to_depot', 'route_masters.scheduled_time', 'route_masters.scheduled_number')
                    ->orderBy('vendorinvoices.id', 'desc')
                    ->whereNull('vendorinvoices.deleted_at')
                    ->get();
                }

            }
		}

        return DataTables::of($vendorinvoice)
				->addIndexColumn('id')
                ->addColumn('route', function ($vendorinvoice){
                    return $vendorinvoice->from_depot.'-'.$vendorinvoice->to_depot.'('.$vendorinvoice->scheduled_number.' - '.$vendorinvoice->scheduled_time.')';
                })
                ->editColumn('billing_period', function($vendorinvoice) {
                    $billing_period=explode(",",$vendorinvoice->billing_period);
                    $from=date("d-m-Y",strtotime($billing_period[0]));
                    $to=date("d-m-Y",strtotime($billing_period[1]));
                    return  $from ." to ".$to;
                    })
                ->editColumn('date', function($vendorinvoice){
                    $date = date("d-m-Y",strtotime($vendorinvoice->created_at));
                    return $date;
                })
				->addColumn('action', function ($vendorinvoice) use($vendorinvoice_id){
                $editId = $vendorinvoice->id;
                $showId = $vendorinvoice->id;
                $printId = $vendorinvoice->id;
                $deleteId = $vendorinvoice->id;
                $route = $this->route;
                $btn="";

                
                if (Auth::user()->usertype_id == '3') {
                    if ($vendorinvoice->is_approved == 0) {
                        $btn .='<a href="'.url($route.'/'.encrypt($editId)).'/edit" class="btn btn-warning btn-xs" ><i class="fa fa-eye"></i> Edit</a><a class="btn btn-danger btn-xs vendor-confirm-delete" data-id="'.Crypt::encryptString($deleteId).'" ><i class="fa fa-trash"></i> Delete</a>';
                    }
                    $btn .="<a href='".url($route.'/'.encrypt($showId))."' class='btn btn-primary btn-xs' ><i class='fa fa-eye'></i> View </a><a id='print'  target ='_blank' href='printVendorinvoice/".Crypt::encryptString($vendorinvoice->id)."' class='btn btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";
                } else if (Auth::user()->usertype_id == '2') {
                    if ($vendorinvoice->is_approved == 0) {
                        if ($vendorinvoice->publish_flag == 1) {
                            $btn .="<a href='".url($route.'/'.encrypt($showId))."' class='btn btn-primary btn-xs'><i class='fa fa-eye'></i> View / Confirm</a><a id='print'  target ='_blank' href='printVendorinvoice/".Crypt::encryptString($vendorinvoice->id)."' class='btn btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";
                        } else {
                            $btn .="<a href='".url($route.'/'.encrypt($showId))."' class='btn btn-primary btn-xs' ><i class='fa fa-eye'></i> View </a><a id='print'  target =
                            '_blank' href='printVendorinvoice/".Crypt::encryptString($vendorinvoice->id)."' class='btn btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";
                        }
                    } else {
                        if ($vendorinvoice->update_status_division == 0) {
                            $btn .="<a href='".url($route.'/'.encrypt($editId))."/edit' class='btn btn-warning btn-xs' ><i class='fa fa-eye'></i> Edit</a>";
                        }
                        $btn .="<a href='".url($route.'/'.encrypt($showId))."' class='btn btn-primary btn-xs' ><i class='fa fa-eye'></i> View </a><a id='print'  target =
                            '_blank' href='printVendorinvoice/".Crypt::encryptString($vendorinvoice->id)."' class='btn btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";
                    }
                } else {
                    if ($vendorinvoice->is_approved == 1) {
                        $btn .="<a href='".url($route.'/'.encrypt($showId))."' class='btn btn-primary btn-xs' ><i class='glyphicon glyphicon-edit'></i> View </a><a id='print'  target =
                            '_blank' href='printVendorinvoice/".Crypt::encryptString($vendorinvoice->id)."' class='btn btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";
                    } else {
                        if ($vendorinvoice->publish_flag == 1) {
                            $btn .="<a href=
                            '".url($route.'/'.encrypt($showId))."' class='btn btn-primary btn-xs' ><i class='fa fa-eye'></i> View / Confirm</a><a id='print'  target =
                            '_blank' href='printVendorinvoice/".Crypt::encryptString($vendorinvoice->id)."' class='btn btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";
                        } else {
                            $btn .="<a href='".url($route.'/'.encrypt($showId))."' class='btn btn-primary btn-xs ><i class='fa fa-eye'></i> View </a><a id='print'  target =
                            '_blank' href='printVendorinvoice/".Crypt::encryptString($vendorinvoice->id)."' class='btn btn-info btn-xs'><i class='fa fa-print'></i>  Print</a>";
                        }
                    }
                }

                return $btn;
			})
			->make(true);
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

    public function create(){

        if (auth()->user()->usertype_id=='1') {
            return redirect('home');
        }

        $action = 'insert';
        $modulename = $this->modulename;
        $route = $this->route;
        $vendors = Vendor::get();
        $division = Division::get();
        $depots = Depot::where('division_id', $this->divisionId)->get();
        $userdepo = $this->depotId;
        $userdivision = $this->divisionId;

        if(auth()->user()->usertype_id=='1'){
            $vehicle = Vehicle::where('status',1)->get();
            $vendor_id = '';
        }else{
            if(auth()->user()->usertype_id=='2'){
                $id = auth()->user()->id;
                $getvendorId = VendorManager::where('user_id',$id)->first();
                $vendor_id = $getvendorId['vendor_id'];
                $vehicle = Vehicle::where('status',1)->where('vendor_id',$vendor_id)->get();
            }
            else if(auth()->user()->usertype_id=='3')
            {
                $id = auth()->user()->id;
                $getAccoutantId = VendorAccountant::where('user_id',$id)->first();
                $vendor_id = $getAccoutantId['vendor_id'];
                $vehicle = Vehicle::where('status',1)->where('vendor_id',$vendor_id)->get();
            }
        }

        $default_diseal = Charge::first();

        return view($this->view.'/form',compact('vendors', 'modulename', 'route', 'division','userdepo', 'userdivision', 'depots', 'vendor_id', 'default_diseal', 'action', 'vehicle'));
    }


    public function store(Request $request)
    {
        $from = date("Y-m-d",strtotime($request->from_date));
        $to = date("Y-m-d",strtotime($request->to));
        $billing_period = $from.",".$to;
        $voucher_date =  date("Y-m-d",strtotime($request->voucher_date));
        $dates = $request->date_pb;
        $datearray = array();
        foreach($dates as $date)
        {
             $datearray[] = date("Y-m-d",strtotime($date));
        }
        $date =  implode(",",$datearray);
        $vehicle_id = implode("*++*",$request->vehicle_id);
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


        $vendorInvoice = Vendorinvoice::create([
            'route_id'=>$request->route_id,
            'depot_id'=>$request->depot_id,
            'division_id'=>$request->division_id,
            'billing_period'=>$billing_period,
            'vendor_id'=>$request->vendor_id,
            'invoice_no'=>$request->invoice_no,
            'vehicle_id'=>$vehicle_id,
            'date'=>$date,
            'kms'=>$kms,
            'schedule_complete'=>$schedule_complete,
            'diesel_ltr'=>$diesel_ltr,
            'diese_per_ltr_price'=>$diese_per_ltr_price,
            'adblue'=>$adblue,
            'adblue_price'=>$adblue_price,
            'breaddown_charge'=>$breaddown_charge,
            'vor_exp'=>$vor_exp,
            'parking_exp'=>$parking_exp,
            'hault_tax'=>$hault_tax,
            'wash_exp'=>$wash_exp,
            'other_exp'=>$other_exp,
            'total_km'=>$request->kms_total,
            'diesel_as_per_gov'=>$request->gov_diesel,
            'extra_filled_diesel'=>$request->extra_diesel,
            'extra_diesel_charged'=>$request->extra_diesel_charge,
            'total_amount'=>$request->total_amount,
            'total_charge'=>$request->total_charge,
            'grand_amount'=>$request->grand_amount,
            'idling_minutes'=>$idling_minutes,
            'remarks'=>$remarks,
            'publish_flag'=>$request->status,
			'created_by'=>auth()->user()->id,
        ]);

        /* connect invoice to parishistha B,A and Bill Summary */

        $vendor_id = $request->vendor_id;
        $route_id = $request->route_id;
        $billingPeriod = $billing_period;

        $lastInsertedId = $vendorInvoice->id;

        $getParisishthaB = ParisishthaB::where('vendor_id', $vendor_id)->where('route_id', $route_id)->where('billing_period', $billingPeriod)->first();

        if($getParisishthaB){
            ParisishthaB::where('id', $getParisishthaB->id)->update(['vendorinvoice_id'=>$lastInsertedId]);
            ParisishthaA::where('parisishtha_b_id', $getParisishthaB->id)->update(['vendorinvoice_id'=>$lastInsertedId]);
            Billsummary::where('parisishtha_b_id', $getParisishthaB->id)->update(['vendorinvoice_id'=>$lastInsertedId]);
        }

        return redirect($this->route)->with('msg','Vendor Invoice Inserted Successfully');
    }

    public function show($id)
    {
        $parisishthab = Vendorinvoice::with('depot')->findorfail(decrypt($id));
        $modulename = $this->modulename;
        $route = $this->route;
        $action = 'view';
        $vendors = Vendor::get();
        $vendorinvoices = Vendorinvoice::get();
        $depots = Depot::get();
        $division = Division::get();
        $vehicle = Vehicle::where('status',1)->get();
        $routes = DB::table('route_masters')
            ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
            ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
            ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')
            ->get();
        $confirmvendorinvoice='confirmvendorinvoice';
        $getSchKm = RouteMaster::where('id',$parisishthab->route_id)->first();
        $schduleKm = $getSchKm->scheduled_km;
        $schTimeNum = $getSchKm->scheduled_number.' - '.$getSchKm->scheduled_time;
        $default_diseal = Charge::first();

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

        return view($this->view.'/viewForm',compact('vendors','modulename','route','action','depots','vehicle', 'parisishthab','vendorinvoices','division','confirmvendorinvoice','routes','schduleKm', 'default_diseal', 'schTimeNum', 'edit_ideal_min'));
    }


    public function edit($id){

        if (auth()->user()->usertype_id=='1') {
            return redirect('home');
        }

        $parisishthab = Vendorinvoice::with('depot')->where('id', decrypt($id))->first();

        $modulename = $this->modulename;
        $route = $this->route;
        $action = 'update';
        $vendors = Vendor::get();
        $depots = Depot::get();
        $division = Division::get();
        $vendorId = $parisishthab->vendor_id;

        if($this->userTypeId == '1'){

            $vendorinvoices_id = ParisishthaB::where('id','!=',$parisishthab->id)->pluck('vendorinvoice_id')->toArray();
            $vendorinvoices_id = array_filter($vendorinvoices_id);
            $vendorinvoices = Vendorinvoice::whereNotIn('id',$vendorinvoices_id)->where('is_approved','1')->where('vendor_id',$vendorId)->get();
        } else {
           if($this->userTypeId != '2' || $this->userTypeId != '3'){
                $depot_id = $this->depotId;
                $division_id = $this->divisionId;
                $vendorinvoices_id = ParisishthaB::where('id','!=',$parisishthab->id)->pluck('vendorinvoice_id')->toArray();
                $vendorinvoices_id = array_filter($vendorinvoices_id);
                $vendorinvoices = Vendorinvoice::whereNotIn('id',$vendorinvoices_id)->where('is_approved','1')->where('vendor_id',$vendorId)->where('depot_id',$depot_id)->where('division_id',$division_id)->get();

           } else {
                $vendorinvoices_id = ParisishthaB::where('id','!=',$parisishthab->id)->pluck('vendorinvoice_id')->toArray();
                $vendorinvoices_id = array_filter($vendorinvoices_id);
                $vendorinvoices = Vendorinvoice::whereNotIn('id',$vendorinvoices_id)->where('is_approved','1')->where('vendor_id',$vendorId)->get();
           }
        }

        if($this->userTypeId == '1'){
            $vehicle = Vehicle::where('status', 1)->get();
            $vendor_id = '';
        } else {
            if($this->userTypeId == '2'){
                $id = auth()->user()->id;
                $getvendorId = VendorManager::where('user_id', $id)->first();
                $vendor_id = $getvendorId['vendor_id'];
                $vehicle = Vehicle::where('status', 1)->where('vendor_id', $vendor_id)->get();
            }
            else if($this->userTypeId == '3')
            {
                $id = auth()->user()->id;
                $getAccoutantId = VendorAccountant::where('user_id', $id)->first();
                $vendor_id = $getAccoutantId['vendor_id'];
                $vehicle = Vehicle::where('status', 1)->where('vendor_id', $vendor_id)->get();
            }
        }

        $default_diseal = Charge::first();
        $getSchKm = RouteMaster::where('id',$parisishthab->route_id)->first();
        $schduleKm = $getSchKm->scheduled_km;
        $schTimeNum = $getSchKm->scheduled_number.' - '.$getSchKm->scheduled_time;

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

        return view($this->view.'/_form',compact('vehicle', 'vendors', 'modulename', 'route','action', 'depots', 'parisishthab', 'vendorinvoices', 'division', 'schduleKm', 'default_diseal', 'schTimeNum', 'edit_ideal_min'));
    }


    public function update(Request $request, ParisishthaB $parisishthaB)
    {
        $voucher_date =  date("Y-m-d",strtotime($request->voucher_date));
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
        $vehicle_id = implode("*++*",$request->vehicle_id);
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

        if(isset($request->save))
        {
            $status=0;
        }
        else
        {
            $status=1;
        }


       $vendorinvoice=Vendorinvoice::findorfail($request->id);
       $vendorinvoice->route_id = $request->route_id;
        $vendorinvoice->billing_period=$billing_period;
        $vendorinvoice->vendor_id=$request->vendor_id;
        $vendorinvoice->invoice_no=$request->invoice_no;
        $vendorinvoice->vehicle_id=$vehicle_id;
        $vendorinvoice->date=$date;
        $vendorinvoice->schedule_complete=$schedule_complete;
        $vendorinvoice->kms=$kms;
        $vendorinvoice->diesel_ltr=$diesel_ltr;
        $vendorinvoice->diese_per_ltr_price=$diese_per_ltr_price;
        $vendorinvoice->adblue=$adblue;
        $vendorinvoice->adblue_price=$adblue_price;
        $vendorinvoice->breaddown_charge=$breaddown_charge;
        $vendorinvoice->vor_exp=$vor_exp;
        $vendorinvoice->parking_exp=$parking_exp;
        $vendorinvoice->hault_tax=$hault_tax;
        $vendorinvoice->wash_exp = $wash_exp;
        $vendorinvoice->other_exp=$other_exp;
        $vendorinvoice->total_km=$request->kms_total;
        $vendorinvoice->diesel_as_per_gov=$request->gov_diesel;
        $vendorinvoice->extra_filled_diesel=$request->extra_diesel;
        $vendorinvoice->extra_diesel_charged=$request->extra_diesel_charge;
        $vendorinvoice->total_amount = $request->total_amount;
        $vendorinvoice->total_charge = $request->total_charge;
        $vendorinvoice->grand_amount = $request->grand_amount;
        $vendorinvoice->idling_minutes = $idling_minutes;
        $vendorinvoice->remarks = $remarks;
        $vendorinvoice->publish_flag=$request->status;
		$vendorinvoice->updated_by=auth()->user()->id;
        $vendorinvoice->save();

        return redirect($this->route)->with('msg','Vendor Invoice Updated Successfully');
    }


    public function destroy($id){

        $id = Crypt::decryptString($id);

        if(Vendorinvoice::findOrFail($id)->delete()){
            echo json_encode(true);
        }
        else{
            echo json_encode(false);
        }

    }


    public function getinvoice(Request $request)
    {
        if($this->userTypeId == '1'){
            $vendorinvoices_id=ParisishthaB::pluck('vendorinvoice_id')->toArray();
            $vendorinvoices_id = array_filter($vendorinvoices_id);
            $rows=Vendorinvoice::where('vendor_id',$request->vendor_id)->whereNotIn('id',$vendorinvoices_id)->where('is_approved','1')->get();
        }else{
            if($this->userTypeId != '2' || $this->userTypeId != '3'){
                $depot_id = $this->depotId;
                $division_id = $this->divisionId;
                $vendorinvoices_id=ParisishthaB::pluck('vendorinvoice_id')->toArray();
                $vendorinvoices_id = array_filter($vendorinvoices_id);
                $rows=Vendorinvoice::where('vendor_id',$request->vendor_id)->where('depot_id',$depot_id)->where('division_id',$division_id)->whereNotIn('id',$vendorinvoices_id)->where('is_approved','1')->get();
            }else{
                $vendorinvoices_id=ParisishthaB::pluck('vendorinvoice_id')->toArray();
                $vendorinvoices_id = array_filter($vendorinvoices_id);
                $rows=Vendorinvoice::where('vendor_id',$request->vendor_id)->whereNotIn('id',$vendorinvoices_id)->where('is_approved','1')->get();
            }
        }

        echo "<option></option>";
        foreach ($rows as $key => $value) {
            echo "<option value='".$value->id."'>".$value->invoice_no.'</option>';
        }
    }

    public function checkinvoice(Request $request)
    {
        if($request->id=='')
        {
            $rows=Vendorinvoice::where('vendor_id',$request->vendor_id)->where('vendorinvoice_id',$request->invoice_id)->count();
        }
        else
        {
            $rows=Vendorinvoice::where('vendor_id',$request->vendor_id)->where('vendorinvoice_id',$request->invoice_id)->where('id','!=',$request->id)->count();
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
            $rows=Vendorinvoice::where('voucher_no',$request->voucher_no)->count();
        }
        else
        {
            $rows=Vendorinvoice::where('voucher_no',$request->voucher_no)->where('id','!=',$request->id)->count();
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

    public function printInvoice($id)
    {
         $data = Vendorinvoice::find(decrypt($id))->toArray();
         $depotId =  $data['depot_id'];
         $divisonId =  $data['division_id'];
         $vehicleId =  $data['vehicle_id'];
         $vendorId =  $data['vendor_id'];
         $divisonName = Division::find($divisonId)->toArray();
         $depotName = Depot::find($depotId)->toArray();
         $vehicleNo = Vehicle::find($vehicleId)->toArray();
         $vendors = Vendor::find($vendorId)->toArray();
         $data = ['result' => $data , 'depot'=>$depotName['name'],'divison'=>$divisonName['name'],'vehicleNo'=>$vehicleNo['vehicle_no'],'vendors'=>$vendors];
         $pdf = PDF::loadView($this->view.'/print',$data);
        return $pdf->stream();
    }

    public function confirmvendorinvoice(Request $request)
    {

        $vendor=Vendorinvoice::findorfail($request->id);
        $vendor->is_approved=1;
        $vendor->save();

        $checkParishisthb = ParisishthaB::where('vendor_id',$vendor->vendor_id)->where('route_id',$vendor->route_id)->where('billing_period',$vendor->billing_period)->get();


        if(! $checkParishisthb->isEmpty()){
            foreach($checkParishisthb as $key=>$val){
                $updateId = $val->id;
                ParisishthaB::where('id',$val->id)->update(['vendorinvoice_id'=>$vendor->id]);
                ParisishthaA::where('parisishtha_b_id',$val->id)->update(['vendorinvoice_id'=>$vendor->id]);
                Billsummary::where('parisishtha_b_id',$val->id)->update(['vendorinvoice_id'=>$vendor->id,'vendor_invoice_amt'=>$vendor->grand_amount]);
            }
        }
        session()->flash('msg',$this->msgName.' Approved Successfully');
        return redirect(url($this->route));
    }

    public function checkDuplicateInvoice(Request $req)
    {
        $action = $req->action;
        if($action=='update'){
            $rows = Vendorinvoice::where('invoice_no',$req->invoice_no)->where('id','!=',$req->id)->count();
        }else{
            $rows = Vendorinvoice::where('invoice_no',$req->invoice_no)->count();
        }
        if($rows > 0){
            echo json_encode(false);
        }else{
            echo json_encode(true);
        }
    }

    public function printVendorinvoice($id)
    {
    	$id = Crypt::decryptString($id);
        $vendorinvoice_data = Vendorinvoice::findorfail($id);
        $vendors = Vendor::get();
        $depots = Depot::get();
        $cities = CityMaster::get();
        $division = Division::get();
        $vehicle = Vehicle::where('status',1)->pluck('vehicle_no', 'id')->toArray();
        $routes = DB::table('route_masters')
            ->join('depots as d1', 'd1.id', '=', 'route_masters.from_depot')
            ->join('depots as d2', 'd2.id', '=', 'route_masters.to_depot')
            ->select('route_masters.*','d1.name as from_depot','d2.name as to_depot')
            ->get();
        $html = view($this->view.'/pdf',compact('vendors','depots','vehicle','vendorinvoice_data','routes','division'))->render();
        $pdf = PDF::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->stream('vendorinvoice','compress');
    }

    public function checkInvoiceDateVehicle(Request $request) {

        $routeId = $request->routeId;
        $fromDate = date("Y-m-d", strtotime($request->fromDate));
        $toDate = date("Y-m-d", strtotime($request->toDate));
        $action = $request->action;
        $id = $request->id;
        $vendorId = $request->vendor_id;

        $billingPeriod = $fromDate.",".$toDate;

        if ($action == 'insert') {
            $checkInvoice = Vendorinvoice::where('route_id', $routeId)->where('billing_period', $billingPeriod)->count();
        } else {
            $checkInvoice = Vendorinvoice::where('id', '!=', $id)->where('route_id', $routeId)->where('billing_period', $billingPeriod)->count();
        }

        if ($checkInvoice > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }


    public function invoiceCheckdate(Request $request)
    {
        $from_date = strtotime($request->from_date);
        $to_date = strtotime($request->to_date);
        $current_date = strtotime(date('d-m-Y'));

        $fromDay = date('d',$from_date);
        $toDay = date('d',$to_date);

        $res=array();
        $res['success'] = true;

        if (date('m',$from_date) != date('m',$to_date)) {

            $res['success'] = false;
            $res['message'] = "You Cannot Make Vendor Invoice For Diffrent Month";

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
                        $res['message'] = "You Cannot Make Vendor Invoice For More Than ".$adays." Days";
                    }
                    else
                    {
                        $res['success'] = true;
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
                else if($currentDayOfMonth==31)
                {
                    $fdays = floor($currentDayOfMonth/2);
                    $ldays = ceil($currentDayOfMonth/2);

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
                        if($actualdays>$ldays)
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
                        $res['message'] = "You Cannot Make Vendor Invoice For More Than ".$adays." Days";
                    }
                    else
                    {
                        $res['success'] = true;
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
                else if($currentDayOfMonth==31)
                {
                    $fdays = floor($currentDayOfMonth/2);
                    $ldays = ceil($currentDayOfMonth/2);

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
                        if($actualdays>$ldays)
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
                else if($currentDayOfMonth==28)
                {
                    $adays = $currentDayOfMonth/2;
                    if($currentDayOfMonth>$adays)
                    {
                        $res['success'] = false;
                        $res['message'] = "You Cannot Make Vendor Invoice For More Than ".$adays." Days";
                    }
                    else
                    {
                        $res['success'] = true;
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
            }
            else
            {
                $res['success'] = false;
                $res['message'] = "Invoice can not be created for future date.";
            }
        }


        echo json_encode($res);
    }

    public function getScheduleNumber(Request $request) 
    {
        $routeData = RouteMaster::where('id', $request->route_id)->first();
        if ($routeData) {
            $route = $routeData->scheduled_number.' - '.$routeData->scheduled_time;
        } else {
            $route = '-';
        }
       
        echo json_encode($route);
    }

}
