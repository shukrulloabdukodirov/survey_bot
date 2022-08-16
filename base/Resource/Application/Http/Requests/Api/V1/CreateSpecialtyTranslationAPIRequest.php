<?php

namespace Base\Resource\Application\Http\Requests\Api\V1;

use Base\Resource\Domain\Models\SpecialtyTranslation;
use InfyOm\Generator\Request\APIRequest;

class CreateSpecialtyTranslationAPIRequest extends APIRequest
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
        return SpecialtyTranslation::$rules;
    }
}
