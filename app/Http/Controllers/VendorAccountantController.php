<?php

/*

        By : Puja Ramvani - API

*/

namespace App\Http\Controllers;



use App\Model\VendorAccountant;

use Illuminate\Http\Request;

use App\Model\Usertype;

use App\Model\Division;

use App\Model\Allowuser;

use DataTables;

use App\Model\Depot;

use App\Model\Vendor;

use App\Model\VendorManager;

use App\User;

use Illuminate\Support\Facades\Hash;

use App\Model\Accesstype;

use App\Http\Requests\VendorAccountantRequest;

use Illuminate\Support\Facades\Crypt;

use Auth;

use DB; /* Hardik */



class VendorAccountantController extends Controller

{

    public $route = 'vendoraccountant';

    public $view = 'vendoraccountant';

    public $primaryid = 'id';

    public $modulename = 'VendorAccountant';

    public $msgName = 'VendorAccountant';

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $route=$this->route;

        $title=$this->modulename;

        $dataurl='getvendoraccountant';

        return view($this->view.'/index',compact('dataurl','title','route'));

    }



    public function getvendoraccountant()

    {





        if(Auth::user()->usertype_id ==1)

        {

            $accoutants=VendorAccountant::with(['user','vendor'])->get();

        }

        else{

            $vendor=VendorManager::where('user_id',Auth::user()->id)->get();

            if($vendor->count()>0)

            {

                $vendor_id=$vendor[0]->vendor_id;

            }

            else

            {

                $vendor_id='';

            }

            $accoutants=VendorAccountant::with(['user','vendor'])->where('vendor_id',$vendor_id)->get();

        }



      /*  $accoutants = DB::table('vendor_accountants')

            ->join('vendors', 'vendors.id', '=', 'vendor_accountants.vendor_id')

            ->join('users', 'users.id', '=', 'vendor_accountants.user_id')

            ->select('vendor_accountants.id','users.first_name','users.last_name','users.email', 'vendors.vendor_name')

            ->get()->toArray();

            */

        return Datatables::of($accoutants)



                        ->addColumn('actions', function($accoutants) {

                            return "<a id='view' href='$this->route/".Crypt::encryptString($accoutants->id)."' class='btn  btn-primary btn-xs'><i class='fa fa-eye'></i> View</a>&nbsp;&nbsp;<a id='edit' href='$this->route/".Crypt::encryptString($accoutants->id)."/edit' class='btn  btn-warning  btn-xs'><i class='fa fa-pencil'></i> Edit</a>";

                            })

                        ->editColumn('user_name', function($accoutants) {

                                    return  $accoutants['user']->first_name." ".$accoutants['user']->last_name;



                         })

                         ->editColumn('user_email', function($accoutants) {

                            return  $accoutants['user']->email;



                        })

                        ->editColumn('user_mobile', function($accoutants) {

                            return  $accoutants['user']->mobile;

                        })



                        ->addIndexColumn()

                        ->rawColumns(['user_name'])

                        ->make(true);

    }

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {



        $modulename = $this->modulename;

        $route = $this->route;

        $depots= Depot::get();

        $user=User::findorfail(Auth::user()->id)->get();

        $divisions = Division::get();

        $accesstypes = Accesstype::get();

        $usertypes = Usertype::get();

        $vendors=Vendor::get();

        $vendorselected=VendorManager::with('vendor')->where('user_id',Auth::user()->id)->get();

        $action = 'insert';

        return view($this->view.'/create',compact('modulename','route','depots','divisions','accesstypes','action','usertypes','user','vendors','vendorselected'));

    }





    public function store(VendorAccountantRequest $request)

    {

        /* Check Allow User Parts Hardik 09-12-18 */

        $vendorId = $request->vendor_id;

        $userTypeId = $request->usertype_id;

        $accessTypeId = $request->accesstype_id;



        /* Allow User In Get No of User */

        $getNoOfUser  = Allowuser::where('usertype_id',$userTypeId)->where('accesstype_id',$accessTypeId)->get();

        if(count($getNoOfUser) > 0){

            $noOfUser =  $getNoOfUser[0]->no_of_users;

            $getNoofAc  = VendorAccountant::where('vendor_id',$vendorId)->count();



            if($noOfUser!=$getNoofAc){

               /* Actual Insert Code Start Here.. */

                    $created_by=Auth::user()->id;

                    $data = $request->except(['password_confirmation','vendor_id']);

                    $firstName = $request->first_name;

                    $lastName = $request->last_name;

                    $mobile = $request->mobile;



                    $data['depot_id']=0;

                    $data['division_id']=0;

                    $user_id=User::create(array_merge($data,['created_by' =>$created_by]));



                    $vendoraccountant=new VendorAccountant();

                    $vendoraccountant->vendor_id = $request->vendor_id;

                    $vendoraccountant->user_id=$user_id->id;

                    $vendoraccountant->save();



                    /* $msg = 'Dear '.$firstName.' '.$lastName.', OTP to login in EShivshahi application. Please use https://www.eshivshahi.com/login link to login.';



                    $q = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=mGLLAiuy1U645KWiCCAKOQ&senderid=TESTIN&channel=INT&DCS=0&flashsms=0&number='.$mobile.'&text='.$msg.'&route=16';



                    $res = file_get_contents($q); */



                    return redirect($this->route)->with('msg', 'Inserted Successfully');

               /* Actual Insert Code End Here..*/



            }else{

                return redirect($this->route)->with('msgAlert','Already '.$getNoofAc.' Vendor Accoutant Created');

            }

        }else{

            return redirect($this->route)->with('msgAlert', 'No Record Found In Allow User LogIn');

        }





    }





    public  function checkAllowUser(Request $req) /* Hardik Date:12-9-18 */

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

                $getNoofAc  = VendorAccountant::where('vendor_id',$vendorId)->count();

            }else{

                $getNoofAc  = VendorAccountant::where('vendor_id',$vendorId)->where('id','!=',$id)->count();

            }



            if($noOfUser!=$getNoofAc){

                $data[0] = true;

                $data[1] = '';

            }else{

                $data[0] = false;

                $data[1] = 'Already '.$getNoofAc.' Vendor Accoutant Created';

            }

        }else{

            $data[0] = false;

            $data[1] = 'No Record Found In Allow User LogIn';

        }

        echo json_encode($data);

    }

    /**

     * Display the specified resource.

     *

     * @param  \App\Model\VendorAccountant  $vendorAccountant

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $id = Crypt::decryptString($id);

        $vendoraccountant = VendorAccountant::with('user')->findorfail($id);

        $action = 'view';

        $modulename = $this->modulename;

        $route = $this->route;

        $depots = Depot::get();

        $divisions = Division::get();

        $accesstypes = Accesstype::get();

        $usertypes = Usertype::get();

        $user=User::findorfail(Auth::user()->id)->get();

        $vendors=Vendor::get();

        $vendorselected=VendorManager::with('vendor')->where('user_id',Auth::user()->id)->get();

        return view($this->view.'/create',compact('vendoraccountant','modulename','route','depots','divisions','accesstypes','usertypes','action','user','vendors','vendorselected'));

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Model\VendorAccountant  $vendorAccountant

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $id = Crypt::decryptString($id);

        $vendoraccountant = VendorAccountant::with('user')->findorfail($id);

        $action = 'update';

        $modulename = $this->modulename;

        $route = $this->route;

        $depots = Depot::get();

        $divisions = Division::get();

        $accesstypes = Accesstype::get();

        $usertypes = Usertype::get();

        $vendors=Vendor::get();

        $vendorselected=VendorManager::with('vendor')->where('user_id',Auth::user()->id)->get();

        $user=User::findorfail(Auth::user()->id)->get();

        return view($this->view.'/create',compact('vendoraccountant','modulename','route','depots','divisions','accesstypes','usertypes','action','user','vendors','vendorselected'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Model\VendorAccountant  $vendorAccountant

     * @return \Illuminate\Http\Response

     */

    public function update(VendorAccountantRequest $request, VendorAccountant $vendorAccountant)

    {

        $id = $request->id;

        $vendorId = $request->vendor_id;

        $userTypeId = $request->usertype_id;

        $accessTypeId = $request->accesstype_id;



        /* Allow User In Get No of User Hardik 12-09-18 */

        $getNoOfUser  = Allowuser::where('usertype_id',$userTypeId)->where('accesstype_id',$accessTypeId)->get();



        if(count($getNoOfUser) > 0){



            $noOfUser =  $getNoOfUser[0]->no_of_users;

            $getNoofAc  = VendorAccountant::where('vendor_id',$vendorId)->where('id','!=',$id)->count();





            if($noOfUser!=$getNoofAc){

                $updated_by = Auth::user()->id;

                User::find($request->user_id)->update(array_merge($request->except(['user_id','id','vendor_id']),['updated_by'=>$updated_by]));

                $vendoraccountant= VendorAccountant::findorfail($request->id);

                $vendoraccountant->vendor_id=$request->vendor_id;

                $vendoraccountant->save();

                return redirect($this->route)->with('msg', 'Updated Successfully');



            }else{

                return redirect($this->route)->with('msgAlert','Already '.$getNoofAc.' Vendor Accoutant Created');

            }

        }else{

             return redirect($this->route)->with('msgAlert','No Record Found In Allow User LogIn');

        }





    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Model\VendorAccountant  $vendorAccountant

     * @return \Illuminate\Http\Response

     */

    public function destroy(VendorAccountant $vendorAccountant)

    {

        //

    }

}

