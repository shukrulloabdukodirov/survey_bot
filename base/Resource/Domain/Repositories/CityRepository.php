<?php

namespace Base\Resource\Domain\Repositories;

use Base\Resource\Domain\Models\City;
use App\Repositories\BaseRepository;

/**
 * Class CityRepository
 * @package Base\Resource\Domain\Repositories
 * @version August 11, 2022, 1:36 pm UTC
*/

class CityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'region_soato_id'
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
        return City::class;
    }
}
