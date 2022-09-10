<?php

namespace Base\Resource\Domain\Services;

use App\Services\BaseService;
use Base\Resource\Domain\Repositories\SpecialityRepository;

class SpecialityStoreService extends BaseService
{
    public $speciality;
    public function __construct(SpecialityRepository $speciality){
        $this->speciality = $speciality;
    }

    public function storeSpeciality($data){
        $input = $this->load($data);
        return $this->speciality->create($input);
    }

    public function updateSpeciality($data,$id){
        $input = $this->load($data);
        return $this->speciality->update($input, $id);
    }
}
