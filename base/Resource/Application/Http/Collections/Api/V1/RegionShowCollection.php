<?php

namespace Base\Resource\Application\Http\Collections\Api\V1;

use Base\Resource\Domain\Models\Region;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RegionShowCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public $collects = Region::class;
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
