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
            'question_uz'=>$this->translate('uz')->text,
            'question_ru'=>$this->translate('ru')->text,
            'question_en'=>$this->translate('en')->text,
            'answers_uz'=>new QuestionAnswerCollection($this->questionAnswers),
            'answers_ru'=>new QuestionAnswerCollection($this->questionAnswers),
            'answers_en'=>new QuestionAnswerCollection($this->questionAnswers),
            'status'=>$this->status,
        ];
    }
}
