<?php

namespace Base\Resource\Domain\Services;

use App\Services\BaseService;
use Base\Resource\Domain\Repositories\RegionRepository;

class RegionStoreService extends BaseService
{
    public $regionRepository;
    public function __construct(RegionRepository $regionRepository){
        $this->regionRepository = $regionRepository;
    }

    public function storeRegion($request){
       $input = $this->load($request);
       return $this->regionRepository->create($input);
    }

    public function updateRegion($request,$id){
        $input = $this->load($request);
        return $this->regionRepository->update($input,$id);
    }
}
