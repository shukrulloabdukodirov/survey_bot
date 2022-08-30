<?php

namespace Base\Survey\Application\Http\Collections\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'type'=>$this->type,
            'text_uz'=>$this->translate('uz')->text,
            'text_ru'=>$this->translate('ru')->text,
            'text_en'=>$this->translate('en')->text,
            'answers'=>new QuestionAnswerCollection($this->questionAnswers),
        ];
    }
}
