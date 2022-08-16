<?php

namespace Base\Survey\Domain\Repositories;

use Base\Survey\Domain\Models\Question;
use App\Repositories\BaseRepository;
use Illuminate\Container\Container as Application;

/**
 * Class QuestionRepository
 * @package Base\Survey\Domain\Repositories
 * @version August 11, 2022, 12:53 pm UTC
*/

class QuestionRepository extends BaseRepository
{
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Question::class;
    }
}
