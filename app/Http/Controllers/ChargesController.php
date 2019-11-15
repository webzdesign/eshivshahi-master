<?php

namespace App\Http\Controllers;

use App\Model\Charge;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Crypt;

class ChargesController extends Controller
{
    public $route = 'charges';
    public $view = 'charge';
	public $primaryid = 'id';
    public $modulename = 'Rate / Charges';
    public $msgName = 'Charge';

    public function index()
    {
        $modulename = $this->modulename;
        $route = $this->route;
        $dataurl = 'getchargesdata';
        return view($this->view.'/index',compact('modulename','route','dataurl'));
    }

    public function getchargesdata()
    {
        return DataTables::eloquent(Charge::query())
        ->addColumn('action', function ($charge) {
            $viewUrl = route('charges.show', Crypt::encryptString($charge->id));

            return "<a href='charges/".encrypt($charge->id)."/edit' class='btn btn-warning  btn-xs' data-id='$charge->id'><i class='fa fa-pencil'></i> Edit</a>
            <a href='".$viewUrl."' class='btn btn-success  btn-xs' data-id='$charge->id'><i class='fa fa-eye'></i> View</a>";
        })

        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);

    }


    public function create()
    {
        $route = $this->route;
        $moduleName = $this->modulename;
        return view($this->view.'.form',compact('route','moduleName'));
    }


    public function store(Request $request)
    {
        $charge= Charge::create([
            'diesel_rate' => $request->diesel_rate,
            'vor_charges' => implode(",", $request->vor_charges),
            'washing_charges' => implode(",", $request->washing_charges),
            'parking_charges' => implode(",", $request->parking_charges),
        ]);

        session()->flash('msgName', $this->msgName.' Inserted Successfully');
        return redirect($this->route);
    }


    public function show($id)
    {
        $route = $this->route;
        $moduleName = $this->moduleName;
        $charges = Charge::find(Crypt::decryptString($id));
        return view($this->view.'/show', compact('route','moduleName','charges'));
    }


    public function edit($id)
    {
        $route = $this->route;
        $moduleName = $this->moduleName;
        $action = 'update';
        $charges = Charge::find(decrypt($id));
        return view($this->view.'/_form', compact('route', 'charges','action','moduleName'));
    }


    public function update(Request $request, $id)
    {
        Charge::find($id)->update(['diesel_rate'=>$request->diesel_rate,'vor_charges'=>implode(",", $request->vor_charges), 'washing_charges'=>implode(",", $request->washing_charges), 'parking_charges'=>implode(",",$request->parking_charges)]);

        session()->flash('msgName', $this->msgName.' Updated Successfully');
        return redirect($this->route);
    }

    public function destroy($id)
    {

    }
}
