<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'logo' => 'nullable|image|dimensions:min_width=100,min_height=100',
            'name' => 'required',
            'email' => 'nullable|email|unique:companies,email,'. $this->route('company'),
            'url' => 'nullable|url|unique:companies,url,' .$this->route('company')
        ];
    }
}
