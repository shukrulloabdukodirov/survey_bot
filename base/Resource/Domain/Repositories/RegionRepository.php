<?php

namespace Base\Resource\Domain\Repositories;

use Base\Resource\Domain\Models\Region;
use App\Repositories\BaseRepository;

/**
 * Class RegionRepository
 * @package Base\Resource\Domain\Repositories
 * @version August 11, 2022, 1:24 pm UTC
*/

class RegionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return Region::class;
    }
}
