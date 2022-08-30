<?php

namespace Base\Resource\Application\Http\Collections\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
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
            'status'=>$this->status,
        ];
    }
}
