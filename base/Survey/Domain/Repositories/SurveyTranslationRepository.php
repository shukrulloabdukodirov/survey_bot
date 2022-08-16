<?php

namespace Base\Survey\Domain\Repositories;

use Base\Survey\Domain\Models\SurveyTranslation;
use App\Repositories\BaseRepository;

/**
 * Class SurveyTranslationRepository
 * @package Base\Survey\Domain\Repositories
 * @version August 8, 2022, 5:27 am UTC
*/

class SurveyTranslationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'locale',
        'survey_id'
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
        return SurveyTranslation::class;
    }
}
