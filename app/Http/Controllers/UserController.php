<?php



/*

  Hardik Ponkiya

  Date:24-8-18

*/



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\User;

use App\Model\Depot;

use App\Model\Division;

use App\Model\Allowuser;

use App\Model\UsermasterLog;

use Illuminate\Support\Facades\Hash;

use App\Model\Accesstype;

use App\Model\Usertype;
use App\Model\VendorManager;
use App\Model\VendorAccountant;


use App\Http\Requests\UserRequest;

use DataTables;

use Helper;

use DB;

use Auth;

class UserController extends Controller

{

    public $route = 'user';

    public $view = 'user';

	public $primaryid = 'id';

    public $modulename = 'User';

    public $msgName = 'User';



    public $userTypeId;



    public function __construct(){

        $this->middleware(function ($request, $next) {

            $this->userTypeId = auth()->user()->usertype_id;

            $this->depotId = auth()->user()->depot_id;

            $this->divisionId = auth()->user()->division_id;

            $this->accessTypeId = auth()->user()->accesstype_id;

            return $next($request);

        });

    }



    public function index()

    {

        $modulename = $this->modulename;

        $route = $this->route;

        $dataurl = '';

        $userTypeId = $this->userTypeId;

        return view($this->view.'/index',compact('modulename','route','dataurl','userTypeId'));

    }





    public function get_data()

	{



			$userVendorManagerId = 2;

			$userSuperAdminId = 1;

            $userVendorAccoutantId = 3;



            if($this->userTypeId == 1){

                $users = User::with('usertype','depot','division')->whereNotIn('usertype_id',[$userVendorAccoutantId,$userSuperAdminId])->orderBy('id', 'asc')->get();

            } elseif ($this->userTypeId == 2)

            {
                $vendor=VendorManager::where('user_id',Auth::user()->id)->get();

                   $vendor_id=$vendor[0]->vendor_id;
                   $userid_list =  VendorAccountant::where('vendor_id',$vendor_id)->pluck('user_id')->toArray();

                $users = User::with('usertype','depot','division')->whereIn('usertype_id',[$userVendorAccoutantId])->whereIn('id', $userid_list)->orderBy('id', 'asc')->get();

            }



			return DataTables::of($users)

                ->addIndexColumn('id')

                ->editColumn('depot', function ($user){

				    return $user->depot->name;

                })

                ->editColumn('division', function ($user){

				    return $user->division->name;

                })

                ->editColumn('role', function ($user){

				    return $user->usertype->name;

			    })

				->addColumn('action', function ($user){

				    $editId = $user->id;

				    $DeleteId = $user->id;

				    $route = $this->route;

                    $actions = view('shared.data_table_actions',compact('editId','DeleteId','route'));





                        if ($user->active_status == '0') {

                            $activeUrl = url('useractiveinactive/active/'.$user->id);

                            $actions .= "<a id='active' href='".$activeUrl."' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Active</a>";

                        } else{

                            $inactiveUrl = url('useractiveinactive/inactive/'.$user->id);

                            $actions .= "<a id='inactive' href='".$inactiveUrl."' class='btn btn-danger btn-xs'><i class='fa fa-times'></i> Inactive</a>";

                        }

                        return $actions;



                })

                ->editColumn('active_status', function($user) {

                    if ($user->active_status == '0') {

                        $status = '<label class="label label-danger">Inactive</label>';

                    } else{

                        $status = '<label class="label label-success">Active</label>';

                    }

                    return $status;

                })

            ->rawColumns(['active_status','action'])

            ->make(true);



    }



    public function useractiveinactive($type,$id)

    {

        if ($type == 'active') {

            User::where('id', $id)->update(['active_status'=>'1']);

            DB::table('user_master_logs')->insert(

                ['user_id' => $id, 'status'=>1, 'updated_by' => auth()->user()->id,'updated_at'=>date('Y-m-d H:i:s')]

            );

            Helper::activeInactiveMsg('active', $this->msgName);

        } else {

            User::where('id', $id)->update(['active_status'=>'0']);

            DB::table('user_master_logs')->insert(

                ['user_id' => $id, 'status'=>0, 'updated_by' => auth()->user()->id,'updated_at'=>date('Y-m-d H:i:s')]

            );

            Helper::activeInactiveMsg('inactive', $this->msgName);

        }

        return redirect('user');

    }



    public function getuserhistroy()

    {

        $user_histroy = UsermasterLog::with('user');

        return DataTables::eloquent($user_histroy)

        ->addColumn('first_name', function ($user_histroy) {

            return $user_histroy->user->first_name;

        })

        ->editColumn('last_name', function($user_histroy){

            return $user_histroy->user->last_name;

        })

        ->editColumn('updated_date', function($user_histroy){

            $udate = date('d-m-Y',strtotime($user_histroy->updated_at));

            return $udate;

        })

        ->editColumn('updated_time', function($user_histroy){

            $utime = date('H:i',strtotime($user_histroy->updated_at));

            return $utime;

        })

        ->addIndexColumn('id')

        ->rawColumns(['updated_date' ,'first_name','updated_time','last_name'])



        ->make(true);

        dd($user_histroy);

    }



	public function getDepotData(Request $req)

	{

		$divisionId = $req->division_id;

		$depot = Depot::where('division_id',$divisionId)->get();

		echo '<option value=""></option>';

		if(!empty($depot)){

			foreach($depot as $depotVal){

				echo '<option value="'.$depotVal->id.'">'.$depotVal->name.'</option>';

			}

		}

	}



    public function create()

    {

        if ($this->userTypeId=='2') {

            return redirect('home');

        }

        $modulename = $this->modulename;

        $route = $this->route;

        $depot = Depot::all();

        $division = Division::all();

        $accesstype = Accesstype::all();

        $userVendorManagerId = 2;

        $userSuperAdminId = 1;

        $userVendorAccoutantId = 3;

		$usertype = Usertype::whereNotIn('id',[$userVendorManagerId,$userVendorAccoutantId,$userSuperAdminId])->orderBy('id', 'asc')->get();

        $action = 'insert';

		 $dataurl = '';

        return view($this->view.'/form',compact('user','modulename','route','depot','division','accesstype','usertype','action','dataurl'));

    }





    public function store(UserRequest $request)

    {



        $userTypeId = $request->usertype_id;

        /* Allow User In Get No of User */

        $getNoOfUser  = Allowuser::where('usertype_id',$userTypeId)->get();



        if(count($getNoOfUser) > 0){



            $noOfUser =  $getNoOfUser[0]->no_of_users;

            $accesstypeId =  $getNoOfUser[0]->accesstype_id;

            if($accesstypeId == '2'){

                $checkId= 'division_id';

                $checkValue = $request->division_id;

            }elseif($accesstypeId == '3'){

                $checkId= 'depot_id';

                $checkValue = $request->depot_id;

            }



            $getNoOfUsertype  = User::where('usertype_id',$userTypeId)->where($checkId,$checkValue)->count();



            if($noOfUser!=$getNoOfUsertype){

                $created_by = auth()->user()->id;

                $firstName = $request->first_name;

                $lastName = $request->last_name;

                $mobile = $request->mobile;

                $request = $request->all();

                $request['accesstype_id'] =$accesstypeId;

                User::create(array_merge($request,['created_by' =>$created_by]));

                /* send msg */



                /*$msg = 'Dear '.$firstName.' '.$lastName.', OTP to login in EShivshahi application. Please use https://www.eshivshahi.com/login link to login.';



                $q = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=mGLLAiuy1U645KWiCCAKOQ&senderid=TESTIN&channel=INT&DCS=0&flashsms=0&number='.$mobile.'&text='.$msg.'&route=16';



                $res = file_get_contents($q);*/



                session()->flash('msg',$this->msgName.' Added Successfully');

                return redirect(url($this->route));

            }else{

                session()->flash('msgAlert','Only one user allowed for this user type');

                return redirect(url($this->route));

            }

        }else{

            session()->flash('msgAlert', 'No Record Found In Allow User LogIn');

            return redirect(url($this->route));

        }



    }





    public function show(User $user)

    {



        $result = $user;

        $action = 'update';

        $modulename = $this->modulename;

        $route = $this->route;

        $depot = Depot::all();

		 $dataurl = '';

        $division = Division::all();

        $accesstype = Accesstype::all();

        $usertype = Usertype::all();

        return view($this->view.'/show',compact('user','modulename','route','depot','division','accesstype','usertype','action','result','dataurl'));

    }



    public function edit($id)

    {

        if ($this->userTypeId=='2' ||  $this->userTypeId=='3') {

            return redirect('home');

        }

        $result = User::find(decrypt($id));



        $action = 'update';

        $modulename = $this->modulename;

        $route = $this->route;

		$division_id = $result->division_id;

        $depot = Depot::where('division_id',$division_id)->get();

        $division = Division::all();

        $accesstype = Accesstype::all();

        $userVendorManagerId = 2;

        $userSuperAdminId = 1;

        $userVendorAccoutantId = 3;

        $usertype = Usertype::whereNotIn('id',[$userVendorManagerId,$userVendorAccoutantId,$userSuperAdminId])->orderBy('id', 'asc')->get();

        $dataurl = '';

        $data = DB::table('user_master_logs')->select('user_master_logs.*','users.first_name','users.last_name')->join('users', 'user_master_logs.user_id', '=', 'users.id')->where('user_master_logs.user_id',decrypt($id))->orderBy('id', 'desc')->get();



        return view($this->view.'/form',compact('user','modulename','route','depot','division','accesstype','usertype','action','result','dataurl','data'));

    }





    public function update(UserRequest $request,User $user)

    {



        $id = $request->id;

        $active_status = $request->active_status;

        $userTypeId = $request->usertype_id;

        /* Allow User In Get No of User */

        $getNoOfUser  = Allowuser::where('usertype_id',$userTypeId)->get();



        if(count($getNoOfUser) > 0){



            $noOfUser =  $getNoOfUser[0]->no_of_users;

            $accesstypeId =  $getNoOfUser[0]->accesstype_id;

            if($accesstypeId == '2'){

                $checkId= 'division_id';

                $checkValue = $request->division_id;

            }elseif($accesstypeId == '3'){

                $checkId= 'depot_id';

                $checkValue = $request->depot_id;

            }



            $getNoOfUsertype  = User::where('usertype_id',$userTypeId)->where($checkId,$checkValue)->where('id','!=',$id)->count();

           // print_r($request->active_status); exit();

            if($noOfUser!=$getNoOfUsertype){

                $updated_by = auth()->user()->id;

                $request = $request->all();

                $request['accesstype_id'] =$accesstypeId;

                $user->update(array_merge($request,['updated_by' =>$updated_by]));



                DB::table('user_master_logs')->insert(

                    ['user_id' => $id, 'status'=>$active_status, 'updated_by' => auth()->user()->id,'updated_at'=>date('Y-m-d H:i:s')]

                );

                session()->flash('msg',$this->msgName.' Updated Successfully');

                return redirect(url($this->route));



            }else{

                session()->flash('msgAlert','Only one user allowed for this user type');

                return redirect(url($this->route));

            }

        }else{

            session()->flash('msgAlert', 'No Record Found In Allow User LogIn');

            return redirect(url($this->route));

        }





    }





    public function destroy(User $user)

    {

           if($user->delete()){

               echo json_encode(true);

           }else{

                echo json_encode(false);

           }

    }

}

