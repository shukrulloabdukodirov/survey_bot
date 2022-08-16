<?php

namespace Base\Survey\Domain\Repositories;

use Base\Survey\Domain\Models\QuestionAnswer;
use App\Repositories\BaseRepository;

/**
 * Class QuestionAnswerRepository
 * @package Base\Survey\Domain\Repositories
 * @version August 8, 2022, 10:54 am UTC
*/

class QuestionAnswerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return QuestionAnswer::class;
    }
}
