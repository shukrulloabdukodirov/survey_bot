<?php

namespace Base\Survey\Domain\Repositories;

use Base\Survey\Domain\Models\QuestionAnswerTranslation;
use App\Repositories\BaseRepository;

/**
 * Class QuestionAnswerTranslationRepository
 * @package Base\Survey\Domain\Repositories
 * @version August 11, 2022, 1:19 pm UTC
*/

class QuestionAnswerTranslationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'string',
        'locale',
        'question_answer_id'
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
        return QuestionAnswerTranslation::class;
    }
}
