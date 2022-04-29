<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('emails')->ignore($this->route('email'))
            ],
            'settings' => 'required',
            'settings.send.host' => 'required',
            'settings.send.port' => 'required|integer',
            'settings.send.login' => 'required',
            'settings.send.password' => 'required',
            'settings.send.secure' => 'required',
        ];
    }
}
