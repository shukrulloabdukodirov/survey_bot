<?php

namespace Base\Application\Application\Http\Requests\Api\V1;

use Base\Application\Domain\Models\ApplicationAnswer;
use InfyOm\Generator\Request\APIRequest;

class UpdateApplicationAnswerAPIRequest extends APIRequest
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
        $rules = ApplicationAnswer::$rules;
        
        return $rules;
    }
}
