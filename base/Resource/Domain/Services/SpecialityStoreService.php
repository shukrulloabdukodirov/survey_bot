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
        $data = $this->speciality->find($data['speciality_id']);
        $old =  $this->speciality->find($id);
        if(empty($data)){
            return $data;
        }
        if(isset($request->education_center_id)&&!empty($request->education_center_id)){
            $old->educationCenters()->detach($input['education_center_id']);
            $data->educationCenters()->attach($input['education_center_id']);
        }

        return $this->speciality->update($input, $id);
    }

    public function deleteSpeciality($request,$speciality){
        $data = $this->speciality->find($speciality);

        if(empty($data)){
            return $data;
        }
        if(isset($request->education_center_id)&&!empty($request->education_center_id)){
            return $data->educationCenters()->detach($request->education_center_id);
        }
        else{
            return $data->delete();
        }
    }
}
