<?php

namespace Base\Survey\Domain\Repositories;

use Base\Survey\Domain\Models\QuestionTranslation;
use App\Repositories\BaseRepository;

/**
 * Class QuestionTranslationRepository
 * @package Base\Survey\Domain\Repositories
 * @version August 8, 2022, 10:53 am UTC
*/

class QuestionTranslationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'text',
        'locale',
        'question_id'
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
        return QuestionTranslation::class;
    }
}
