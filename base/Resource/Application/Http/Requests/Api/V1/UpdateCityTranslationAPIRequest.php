<?php

namespace Base\Resource\Application\Http\Requests\Api\V1;

use Base\Resource\Domain\Models\CityTranslation;
use InfyOm\Generator\Request\APIRequest;

class UpdateCityTranslationAPIRequest extends APIRequest
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
        $rules = CityTranslation::$rules;
        
        return $rules;
    }
}
