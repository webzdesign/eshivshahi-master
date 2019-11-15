<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
/*
        By : Puja Ramvani - API
*/

class VendorAccountantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if($this->method()=='PUT'){
            return [
                'first_name' => 'required',
                'last_name' => 'required',
                'mobile' => 'required|min:10|unique:users,mobile,'.$this->user_id,
                'usertype_id' => 'required',
                'accesstype_id' => 'required',
                'vendor_id'=>'required',
              ];
          }else{
              return [
                'first_name' => 'required',
                'last_name' => 'required',
                'mobile' => 'required|min:10|unique:users,mobile',
                /* 'password' => 'required|min:6',*/
                'usertype_id' => 'required',
                'accesstype_id' => 'required',
                'vendor_id'=>'required',
              ];
            }
        }
            public function messages()
            {

                return [
                    'vendor_id.required'=>'Please Select Vendor',
                    'first_name.required'=>'Please Enter First Name',
                    'last_name.required'=>'Please Enter LastName',
                    'mobile.required'=>'Please Enter Mobile Number',
                    /* 'password.required'=>'Please Enter Password',
                    'password.min'=>'Password Must Be Of Minimum 6 Characters',*/
                    'email.unique'=>'Email Already Exist',
                    'division_id.required'=>'Please Select Divison',
                    'depot_id.required'=>'Please Select Depo',
                    'usertype_id.required'=>'Please Select User Type',
                    'accesstype_id.required'=>'Please Select AccessType'
                ];


            }

}
