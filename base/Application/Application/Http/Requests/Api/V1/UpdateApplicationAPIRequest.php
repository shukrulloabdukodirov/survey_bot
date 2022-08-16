<?php

namespace Base\Application\Application\Http\Requests\Api\V1;

use Base\Application\Domain\Models\Application;
use InfyOm\Generator\Request\APIRequest;

class UpdateApplicationAPIRequest extends APIRequest
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
        $rules = Application::$rules;
        
        return $rules;
    }
}
