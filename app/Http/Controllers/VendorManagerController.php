<?php
/*
    Hardik Ponkiya
    Date:07-09-18
*/
namespace App\Http\Controllers;
use App\Model\VendorManager;
use App\Model\Accesstype;
use App\Model\Usertype;
use App\Model\Vendor;
use App\Model\Allowuser;
use App\User;
use App\Http\Requests\VendorManagerRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use DataTables;
use DB;

class VendorManagerController extends Controller
{
    public $route = 'vendormanager';
    public $view = 'vendormanager';
    public $primaryid = 'id';
    public $modulename = 'Vendor Manager';
    public $userid =0;
    public $msgName = 'VendorManager';

    public function index()
    {
        $route=$this->route;
        $title=$this->modulename;
        $dataurl='getvendormanger';
        return view($this->view.'/index',compact('dataurl','title','route'));
    }

    public function getVendorManager()
    {
        $data = DB::table('vendor_managers')
        ->join('users', 'users.id', '=', 'vendor_managers.user_id')
        ->join('vendors', 'vendors.id', '=', 'vendor_managers.vendor_id')
        ->select('users.email','users.mobile', 'vendors.vendor_name','vendor_managers.id')
		->orderBy('vendor_managers.id','desc')
        ->get();
        return DataTables::of($data)
            ->addIndexColumn('id')
            ->addColumn('actions', function ($data){
            $editId = $data->id;
            $DeleteId = $data->id;
            $route = $this->route;
            return view('shared.data_table_actions',compact('editId','DeleteId','route'));
        })
        ->make(true);
    }

    public function create()
    {
        $modulename = $this->modulename;
        $route = $this->route;
        $accesstypes = Accesstype::where('name','Vendor')->get();
        $usertypes = Usertype::where('name','Vendor Manager')->get();
        $vendors = vendor::get();
        $action = 'insert';
        return view($this->view.'/create',compact('modulename','route','accesstypes','action','usertypes','vendors'));
    }


    public function store(VendorManagerRequest $request)
    {
        /* Note:  Depo And Division Pending */

        $userIdGet = User::create([
           'first_name'=>$request->first_name,
           'last_name'=>$request->last_name,
           'email'=>$request->email,
           'mobile'=>$request->mobile,
           'division_id'=>0,
           'depot_id'=>0,
           'usertype_id'=>$request->usertype_id,
           'accesstype_id'=>$request->accesstype_id,
           'created_by'=>auth()->user()->id
        ]);

        $firstName = $request->first_name;
        $lastName = $request->last_name;
        $mobile = $request->mobile;

        /*$msg = 'Dear '.$firstName.' '.$lastName.', OTP to login in EShivshahi application. Please use https://www.eshivshahi.com/login link to login.';

        $q = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=mGLLAiuy1U645KWiCCAKOQ&senderid=TESTIN&channel=INT&DCS=0&flashsms=0&number='.$mobile.'&text='.$msg.'&route=16';

        $res = file_get_contents($q);*/

        $userId = $userIdGet['id'];
        $vendorId = $request->vendor_id;
        VendorManager::create([
            'user_id'=>$userId,
            'vendor_id'=>$vendorId
        ]);
        return redirect($this->route)->with('msg', $this->msgName.' Inserted Successfully');
    }


    public  function checkAllowUser(Request $req)
    {
        $id = $req->id;
        $vendorId = $req->vendor_id;
        $userTypeId = $req->usertype_id;
        $accessTypeId = $req->accesstype_id;
        $data = array();
        $data[0] = '';
        $data[1] = '';
        /* Allow User In Get No of User */
        $getNoOfUser  = Allowuser::where('usertype_id',$userTypeId)->where('accesstype_id',$accessTypeId)->get();
        if(count($getNoOfUser) > 0){
            $noOfUser =  $getNoOfUser[0]->no_of_users;
            if($req->id==''){
                $getNoofManager  = VendorManager::where('vendor_id',$vendorId)->count();
            }else{
                $getNoofManager  = VendorManager::where('vendor_id',$vendorId)->where('id','!=',$id)->count();
            }

            if($noOfUser!=$getNoofManager){
                $data[0] = true;
                $data[1] = '';
            }else{
                $data[0] = false;
                $data[1] = 'Already '.$getNoofManager.' Vendor Manager Created';
            }
        }else{
            $data[0] = false;
            $data[1] = 'No Record Found In Allow User LogIn';
        }
        echo json_encode($data);
    }


    public function edit($id)
    {
        $result = DB::table('vendor_managers')
        ->join('users', 'users.id', '=', 'vendor_managers.user_id')
        ->where('vendor_managers.id', '=', decrypt($id))
        ->select('users.id As user_id','users.email','users.mobile','users.first_name','users.last_name','users.usertype_id','users.accesstype_id','vendor_managers.id','vendor_managers.vendor_id')
        ->get();


        $action = 'update';
        $modulename = $this->modulename;
        $route = $this->route;
        $vendors = vendor::get();
          $accesstypes = Accesstype::where('name','Vendor')->get();
        $usertypes = Usertype::where('name','Vendor Manager')->get();
        return view($this->view.'/create',compact('result','vendors','modulename','route','depots','divisions','accesstypes','usertypes','action'));
    }


    public function update(VendorManagerRequest $request, VendorManager $vendormanager)
    {


        /* User Update */
        $userId = $vendormanager->user_id;
        $user = User::findorfail($userId);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email=$request->email;
        $user->mobile = $request->mobile;
        $user->division_id=0;
        $user->depot_id=0;
        $user->usertype_id=$request->usertype_id;
        $user->accesstype_id=$request->accesstype_id;
        $user->updated_by=auth()->user()->id;
        $user->save();
        /* Vendor Update */
        $vendormanager->vendor_id = $request->vendor_id;
        $vendormanager->save();
        return redirect($this->route)->with('msg', $this->msgName.' Updated Successfully');
    }


    public function destroy(VendorManager $vendorManager)
    {

    }
}
