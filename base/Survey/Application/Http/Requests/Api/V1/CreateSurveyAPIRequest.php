<?php

namespace Base\Survey\Application\Http\Requests\Api\V1;

use Base\Survey\Domain\Models\Survey;
use InfyOm\Generator\Request\APIRequest;

class CreateSurveyAPIRequest extends APIRequest
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
        return Survey::$rules;
    }
}
