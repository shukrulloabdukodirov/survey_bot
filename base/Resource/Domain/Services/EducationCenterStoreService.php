<?php

namespace Base\Resource\Domain\Services;

use App\Services\BaseService;
use Base\Resource\Domain\Models\EducationCenter;
use Base\Resource\Domain\Repositories\EducationCenterRepository;

class EducationCenterStoreService extends BaseService
{
    public $educationCenter;

    public function __construct(EducationCenterRepository $educationCenter){
        $this->educationCenter = $educationCenter;
    }

    public function storeEducationCenter($data){
        $input = $this->load($data);
        return $this->educationCenter->create($input);
    }

    public function updateEducationCenter($data,$id){
        $input = $this->load($data);
        return $this->educationCenter->update($input,$id);
    }
}
