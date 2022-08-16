<?php

namespace Base\User\Applicant\Application\Http\Requests\Api\V1;

use Base\User\Applicant\Domain\Models\Applicant;
use InfyOm\Generator\Request\APIRequest;

class CreateApplicantAPIRequest extends APIRequest
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
        return Applicant::$rules;
    }
}
