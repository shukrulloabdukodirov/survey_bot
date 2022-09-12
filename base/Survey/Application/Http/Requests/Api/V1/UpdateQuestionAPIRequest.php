<?php

namespace Base\Survey\Application\Http\Requests\Api\V1;

use Base\Survey\Domain\Models\Question;
use InfyOm\Generator\Request\APIRequest;

class UpdateQuestionAPIRequest extends APIRequest
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
    public function prepareForValidation(){
        if($this->has('answers')){
            $this->answers = json_decode($this->answers,true);
        }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'answers'=>'array'
        ];
    }
}
