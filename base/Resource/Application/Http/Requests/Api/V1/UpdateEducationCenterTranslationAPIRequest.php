<?php

namespace Base\Resource\Application\Http\Requests\Api\V1;

use Base\Resource\Domain\Models\EducationCenterTranslation;
use InfyOm\Generator\Request\APIRequest;

class UpdateEducationCenterTranslationAPIRequest extends APIRequest
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
        $rules = EducationCenterTranslation::$rules;
        
        return $rules;
    }
}
