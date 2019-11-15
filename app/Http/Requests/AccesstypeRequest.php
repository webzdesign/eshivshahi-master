<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccesstypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->isMethod('post')){
            return [
                'name' => 'required|unique:accesstypes',
            ];
        }else{
            return [
                'title' => "required|unique:accesstypes,title,{$this->id}",
                'name' =>'required',
            ];
        }
    }
}
