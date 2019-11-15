<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
       return [
            'vendor_name' => 'required',
            'address' => 'required',
            'active_status' => 'required',
          ];
    }
	   public function messages()
	  {
            return [
                'vendor_name.required'=>'Please Enter Vendor Name',
                'address.required'=>'Please Enter Address',
                'active_status.required' => 'Please Enter Status',
            ];
	  }
}
