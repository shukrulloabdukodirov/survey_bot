<?php

namespace App\Http\Resources;

use Base\Survey\Domain\Models\Question;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'question'=>$this->text,
            'type'=>$this->type,
            'answers'=>AnswerResource::collection(Question::find($this->id)->questionAnswers()->get())
        ];
    }
}
