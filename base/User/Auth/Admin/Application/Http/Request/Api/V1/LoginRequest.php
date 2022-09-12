<?php

namespace Base\User\Auth\Admin\Application\Http\Request\Api\V1;

use InfyOm\Generator\Request\APIRequest;

class LoginRequest extends APIRequest
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
        return [
            'email' => ['required', 'string', 'email', 'max:255', ],
            'password' => ['required', 'string', 'min:8', ],
        ];
    }
}
