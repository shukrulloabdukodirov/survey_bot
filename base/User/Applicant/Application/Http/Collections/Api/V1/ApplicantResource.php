<?php

namespace Base\User\Applicant\Application\Http\Collections\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
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
            'name'=>$this->applicantInfos[0]->first_name,
            'phone'=>$this->phone,
        ];
    }
}
