<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParisishthaBRequest extends FormRequest
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
                'depot_id' => 'required',
                'billing_period' => 'required',
                'vendor_id' => 'required',
                'vendorinvoice_id' => 'required',
                'voucher_no' => 'required',
                'voucher_date' => 'required',
                'vehicle_id' => 'required',
                'date'=>'required|array|min:1',
                'kms'=>'required|array|min:1',
                'diesel_ltr'=>'required|array|min:1',
                'diese_per_ltr_price'=>'required|array|min:1',
                'adblue'=>'required|array|min:1',
                'adblue_price'=>'required|array|min:1',
                'breaddown_charge'=>'required|array|min:1',
                'vor_exp'=>'required|array|min:1',
                'parking_exp'=>'required|array|min:1',
                'hault_tax'=>'required|array|min:1',
                'other_exp'=>'required|array|min:1',
              ];
          }else{
              return [
                'depot_id' => 'required',
                'billing_period' => 'required',
                'vendor_id' => 'required',
                'vendorinvoice_id' => 'required',
                'voucher_no' => 'required',
                'voucher_date' => 'required',
                'vehicle_id' => 'required',
                'date'=>'required|array|min:1',
                'kms'=>'required|array|min:1',
                'diesel_ltr'=>'required|array|min:1',
                'diese_per_ltr_price'=>'required|array|min:1',
                'adblue'=>'required|array|min:1',
                'adblue_price'=>'required|array|min:1',
                'breaddown_charge'=>'required|array|min:1',
                'vor_exp'=>'required|array|min:1',
                'parking_exp'=>'required|array|min:1',
                'hault_tax'=>'required|array|min:1',
                'other_exp'=>'required|array|min:1',
              ];
            }
    }
}