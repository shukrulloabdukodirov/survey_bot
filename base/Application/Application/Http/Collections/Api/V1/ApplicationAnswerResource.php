<?php

namespace Base\Application\Application\Http\Collections\Api\V1;

use Base\Survey\Application\Http\Collections\Api\V1\QuestionAnswerResource;
use Base\Survey\Application\Http\Collections\Api\V1\QuestionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationAnswerResource extends JsonResource
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
            'question'=>new QuestionResource($this->question),
            'question_answer' => new QuestionAnswerResource($this->questionAnswer)
        ];
    }
}
