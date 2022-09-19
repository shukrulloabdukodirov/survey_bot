<?php

namespace Base\Resource\Application\Http\Requests\Api\V1;

use Base\Resource\Domain\Models\Speciality;
use InfyOm\Generator\Request\APIRequest;

class UpdateSpecialtyAPIRequest extends APIRequest
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

    public function prepareForValidation()
    {
        $this->status = boolval($this->status);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Speciality::$rules;

        return $rules;
    }
}
