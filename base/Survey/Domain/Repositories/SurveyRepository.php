<?php

namespace Base\Survey\Domain\Repositories;

use Base\Survey\Domain\Models\Survey;
use App\Repositories\BaseRepository;

/**
 * Class SurveyRepository
 * @package Base\Survey\Domain\Repositories
 * @version August 8, 2022, 5:26 am UTC
*/

class SurveyRepository extends BaseRepository
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
        return Survey::class;
    }
}
