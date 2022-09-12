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

    public function deleteSpeciality($request,$speciality){
        $data = $this->speciality->find($speciality);
        if(empty($data)){
            return $data;
        }
        return $data->educationCenters()->detach($request->education_center_id);
    }
}
