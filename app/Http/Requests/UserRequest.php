<?php
/*
    Hardik
   Date: 24-08-18
*/
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules()
    {
      if($this->method()=='PUT'){
        $id = $this->id;
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|min:10|unique:users,mobile,'.$id,
            'division_id' => 'required',
            'depot_id' => 'required',
            'usertype_id' => 'required'
          ];
      }else{
          return [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|min:10|unique:users,mobile',
            /*'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',*/
            'division_id' => 'required',
            'depot_id' => 'required',
            'usertype_id' => 'required'

          ];

      }



    }

    public function messages()
	{

        return [
            'first_name.required'=>'Please Enter First Name',
            'last_name.required'=>'Please Enter LastName',
            'mobile.required'=>'Please Enter Mobile Number',
            /*'password.required'=>'Please Enter Password',
            'confirm_password.required'=>'Please Enter Confirm Password',
            'confirm_password.same'=>'Password Does Not Match !!',*/
            'division_id.required'=>'Please Select Divison',
            'depot_id.required'=>'Please Select Depo',
            'usertype_id.required'=>'Please Select User Type',
            'accesstype_id.required'=>'Please Select AccessType'
        ];


	}
}
