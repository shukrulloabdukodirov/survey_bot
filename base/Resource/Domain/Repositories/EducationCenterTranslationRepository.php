<?php

namespace Base\Resource\Domain\Repositories;

use Base\Resource\Domain\Models\EducationCenterTranslation;
use App\Repositories\BaseRepository;

/**
 * Class EducationCenterTranslationRepository
 * @package Base\Resource\Domain\Repositories
 * @version August 11, 2022, 1:44 pm UTC
*/

class EducationCenterTranslationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'locale',
        'education_center_id'
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
        return EducationCenterTranslation::class;
    }
}
