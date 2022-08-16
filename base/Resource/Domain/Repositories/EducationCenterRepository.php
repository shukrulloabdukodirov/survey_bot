<?php

namespace Base\Resource\Domain\Repositories;

use Base\Resource\Domain\Models\EducationCenter;
use App\Repositories\BaseRepository;

/**
 * Class EducationCenterRepository
 * @package Base\Resource\Domain\Repositories
 * @version August 11, 2022, 1:44 pm UTC
*/

class EducationCenterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'region_id',
        'city_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EducationCenter::class;
    }
}
