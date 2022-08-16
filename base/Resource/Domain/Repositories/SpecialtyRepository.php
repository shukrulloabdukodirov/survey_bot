<?php

namespace Base\Resource\Domain\Repositories;

use Base\Resource\Domain\Models\Specialty;
use App\Repositories\BaseRepository;

/**
 * Class SpecialtyRepository
 * @package Base\Resource\Domain\Repositories
 * @version August 11, 2022, 1:52 pm UTC
*/

class SpecialtyRepository extends BaseRepository
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
        return Specialty::class;
    }
}
