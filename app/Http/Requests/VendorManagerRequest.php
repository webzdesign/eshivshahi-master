<?php
 /*
    Hardik Ponkiya
    Date:09-07-18
  */
namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class VendorManagerRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        if($this->method()=='PUT'){

                return [
                    'vendor_id' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'mobile' => 'required|min:10|unique:users,mobile,'.$this->user_id,
                    'accesstype_id' => 'required'
                ];

        }else{
            return [
                'vendor_id' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'mobile' => 'required|min:10|unique:users,mobile',
                /*'password' => 'required|min:6',
                'confirm_password'=>'required|same:password',*/
                'accesstype_id' => 'required'
            ];
        }
    }

    public function messages()
	{

        return [
            'vendor_id.required'=>'Please Select Vendor',
            'first_name.required'=>'Please Enter First Name',
            'last_name.required'=>'Please Enter Last Name',
            'mobile.required'=>'Please Enter Mobile Number',
            /* 'password.required'=>'Please Enter Password',
            'confirm_password.required'=>'Please Enter Confirm Password',
            'confirm_password.same'=>'Password Not Matched', */
            'accesstype_id.required'=>'Please Select Access Type',
        ];
	}
}
