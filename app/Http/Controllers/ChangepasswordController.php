<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangepasswordController extends Controller
{
    public function index()
    {
        $modulename='Change Password';
       return view('partials.changepassword',compact('modulename'));
    }
    public function checkpassword(Request $request)
    {
        $id = $request->id;
        $oldpassword =$request->old_password;
        $u=User::findorFail($id);
        if(!Hash::check($oldpassword, $u->password)){
            echo(json_encode(false));
        }else{
            echo(json_encode(true));
        }
        exit;
    }
    public function update()
    {
        parse_str($_POST['formdata'], $value);
        User::findorFail($value['user_id'])->update(['password' => Hash::make($value['password'])]);
        echo true;
    }
}
