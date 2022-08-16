<?php

namespace Base\Resource\Domain\Repositories;

use Base\Resource\Domain\Models\CityTranslation;
use App\Repositories\BaseRepository;

/**
 * Class CityTranslationRepository
 * @package Base\Resource\Domain\Repositories
 * @version August 11, 2022, 1:36 pm UTC
*/

class CityTranslationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'locale',
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
        return CityTranslation::class;
    }
}
