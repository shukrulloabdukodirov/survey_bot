<?php

namespace Base\Resource\Domain\Repositories;

use Base\Resource\Domain\Models\RegionTranslation;
use App\Repositories\BaseRepository;

/**
 * Class RegionTranslationRepository
 * @package Base\Resource\Domain\Repositories
 * @version August 11, 2022, 1:25 pm UTC
*/

class RegionTranslationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'locale',
        'region_id'
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
        return RegionTranslation::class;
    }
}
