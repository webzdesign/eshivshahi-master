<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth,DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    /*protected $redirectTo = '/home';*/

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    public function checkMobileNumber(Request $request){
        $mobile = trim($request->mobile);
        $checkMobile = DB::table('users')->where('mobile',$mobile)->get();

        if(! $checkMobile->isEmpty()){
            if($checkMobile[0]->status == '1')
            {
                $response_array['msg'] = 'Please Reset your password';
                $response_array['status'] = 0;
            }
            else{
                $response_array['msg'] = '';
                $response_array['status'] = 1;
            }
        }else{
            $response_array['msg'] = 'Mobile Number Does Not Exist.';
            $response_array['status'] = 0;
        }

        echo json_encode($response_array);

    }
    public function resetcheckMobileNumber(Request $request){
        $mobile = trim($request->mobile);
        $checkMobile = DB::table('users')->where('mobile',$mobile)->where('status','1')->get();
        if($checkMobile->isEmpty()){
            echo json_encode(false);
        }else{
            echo json_encode(true);
        }
    }
    public function sendOtp(Request $request){
        $verifyMobile = $request->verifyMobile;
        //$otpCreate = str_random(6);
       // $otpCreate = mt_rand(100000,999999);
        $otpCreate = '123456';

        $user = DB::table('users')->where('mobile',$verifyMobile)->first();
        //$msg = 'Dear '.$user->first_name.' '.$user->last_name.', OTP to login in EShivshahi application is '.$otpCreate.' Please contact support, if you have not requested it.';

        /* send otp start */
        //$q = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=mGLLAiuy1U645KWiCCAKOQ&senderid=ESHIVS&channel=2&DCS=0&flashsms=0&number='.$verifyMobile.'&text='.$msg;

        //$q = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=mGLLAiuy1U645KWiCCAKOQ&senderid=ESHIVS&channel=2&DCS=0&flashsms=0&number=8980610406&text=my first msg in eshivshahi application.';

       // $res = file_get_contents($q);



		/* $apikey = "mGLLAiuy1U645KWiCCAKOQ";
        $apisender = "ESHIVS";
        $msg ="Dear ".$user->first_name." ".$user->last_name.", OTP to login in EShivshahi application is ".$otpCreate." Please contact support, if you have not requested it.";
        $num = $verifyMobile;

        $ms = rawurlencode($msg);   //This for encode your message content

        $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';

        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
        $data = curl_exec($ch); */

        /* send otp end */
        $storeOtp = DB::table('users')->where('mobile',$verifyMobile)->update(['otp'=>$otpCreate]);
        return view('auth.verifyotp',compact('verifyMobile','otpCreate'));
    }
    public function checkOtp(Request $request){
        $mobile = trim($request->mobile);
        $otp = trim($request->otp);
        $checkOtp = DB::table('users')->where('mobile',$mobile)->where('otp',$otp)->get();
        if($checkOtp->isEmpty()){
            echo json_encode(false);
        }else{
            echo json_encode(true);
        }
    }
    public function changePwd(Request $request){
        $mobile = $request->mobile;
        $otp = $request->otp;

        return view('auth.changepwd',compact('mobile'));
    }
    public function changePassword(Request $request){
        $mobile = $request->mobile;
        $password = Hash::make($request->password);

        DB::table('users')->where('mobile',$mobile)->update(['password'=>$password,'status'=>'1']);
        $user = User::where('mobile',$mobile)->first();
        Auth::login($user);

        return redirect()->route('home');
    }
    public function login(Request $request){
        if(Auth::attempt(['mobile'=>$request->mobile,'password'=>$request->password,'status'=>'1', 'active_status'=>'1'])){
            return redirect()->route('home');
        }else{
            $errors = ['mobile' => trans('auth.failed')];
            $errors = ['mobile' => 'Mobile or Password Does Not Match.'];
            if ($request->expectsJson()) {
                return response()->json($errors, 422);
            }

           return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
        }
    }
    public function resetsendotp(Request $request){
        $verifyMobile = $request->verifyMobile;
        //$otpCreate = str_random(6);
      //  $otpCreate = mt_rand(100000,999999);
        $otpCreate = '123456';

        $user = DB::table('users')->where('mobile',$verifyMobile)->first();
        //$msg = 'Dear '.$user->first_name.' '.$user->last_name.', OTP to login in EShivshahi application is '.$otpCreate.' Please contact support, if you have not requested it.';

        /* send otp start */
        //$q = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=mGLLAiuy1U645KWiCCAKOQ&senderid=ESHIVS&channel=2&DCS=0&flashsms=0&number='.$verifyMobile.'&text='.$msg;

        //$q = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=mGLLAiuy1U645KWiCCAKOQ&senderid=ESHIVS&channel=2&DCS=0&flashsms=0&number=8980610406&text=my first msg in eshivshahi application.';

       // $res = file_get_contents($q);



        /* $apikey = "mGLLAiuy1U645KWiCCAKOQ";
        $apisender = "ESHIVS";
        $msg ="Dear ".$user->first_name." ".$user->last_name.", OTP For Reset Password in EShivshahi application is ".$otpCreate." Please contact support, if you have not requested it.";
        $num = $verifyMobile;

        $ms = rawurlencode($msg);   //This for encode your message content

        $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';


        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
        $data = curl_exec($ch); */

        /* send otp end */
        $storeOtp = DB::table('users')->where('mobile',$verifyMobile)->update(['otp'=>$otpCreate]);
        return view('auth.verifyotp',compact('verifyMobile','otpCreate'));
    }
}
