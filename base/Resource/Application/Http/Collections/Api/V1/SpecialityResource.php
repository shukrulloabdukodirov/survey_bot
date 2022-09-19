<?php

namespace Base\Resource\Application\Http\Collections\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecialityResource extends JsonResource
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
            'id' => $this->id,
            'name_uz'=>isset($this->translate('uz')->name)?$this->translate('uz')->name:'',
            'name_ru'=>isset($this->translate('ru')->name)?$this->translate('ru')->name:'',
            'name_en'=>isset($this->translate('en')->name)?$this->translate('en')->name:'',
            'status' => $this->status
        ];
    }
}
