<?php

namespace Base\Resource\Domain\Repositories;

use Base\Resource\Domain\Models\SpecialityTranslation;
use App\Repositories\BaseRepository;

/**
 * Class SpecialtyTranslationRepository
 * @package Base\Resource\Domain\Repositories
 * @version August 11, 2022, 1:52 pm UTC
*/

class SpecialityTranslationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'locale',
        'speciality_id'
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
        return SpecialityTranslation::class;
    }
}
