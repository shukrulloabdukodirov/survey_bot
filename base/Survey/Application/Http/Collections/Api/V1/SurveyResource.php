<?php

namespace Base\Survey\Application\Http\Collections\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class SurveyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name_uz'=>$this->translate('uz')->name,
            'name_ru'=>$this->translate('ru')->name,
            'name_en'=>$this->translate('en')->name,
            'questions' => new QuestionCollection($this->questions),
            'status'=>$this->status,
        ];
    }
}
