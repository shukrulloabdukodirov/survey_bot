<?php

namespace Base\Application\Application\Http\Collections\Api\V1;

use Base\Resource\Application\Http\Collections\Api\V1\EducationCenterResource;
use Base\User\Applicant\Application\Http\Collections\Api\V1\ApplicantResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
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
            'applicant'=>new ApplicantResource($this->applicant),
            'education_center'=>new EducationCenterResource($this->educaitonCenter),
            'answers'=>new ApplicationAnswerCollection($this->answers)
        ];
    }
}
