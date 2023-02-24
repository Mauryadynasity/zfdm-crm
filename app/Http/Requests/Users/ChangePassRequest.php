<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use \Request;
use App\Admin;
use \Auth;
use \Hash;
class ChangePassRequest extends FormRequest
{
    use \App\Http\Requests\Response;
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
        // dd($this->all());
        return [
            'old_pass' => 'required',
            'new_pass' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,15}$/',
            'con_pass' => 'required|same:new_pass',
        ];
    }

    public function messages()
    {
        return [
            'old_pass.required' => __('Old Password required'),
            'new_pass.required' => 'New Password is required.',
            'new_pass.regex' =>'Password must contain atleast 8 characters with one uppercase,one lowercase and one number',
            'con_pass.required' => 'Confirm password is required.',
            'con_pass.same' => 'The Password and Confirm Password does not match.',
        ];
    }

    public function withValidator($validator){

        $admin = Admin::where(['email' => Auth::guard('admin')->user()->email])->first();
        
        $validator->after(function ($validator) use($admin){
            if(isset($admin)){
                if(!Hash::check($this->old_pass, $admin->password)) {
                    $validator->errors()->add('old_pass', ' Your Old Password is Wrong!');
                }
                
            }
            

        });
    }
}
