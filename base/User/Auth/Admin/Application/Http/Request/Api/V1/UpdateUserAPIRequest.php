<?php

namespace Base\User\Auth\Admin\Application\Http\Request\Api\V1;

use App\Models\User;
use Base\User\Applicant\Domain\Models\Applicant;
use InfyOm\Generator\Request\APIRequest;

class UpdateUserAPIRequest extends APIRequest
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
        $rules = User::$rules;
        $rules['email']=$rules['email'].',email,'.$this->user;
        $rules['username']=$rules['username'].',username,'.$this->user;
        return $rules;
    }
}
