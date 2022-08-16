<?php

namespace Base\Application\Domain\Repositories;

use Base\Application\Domain\Models\ApplicationAnswer;
use App\Repositories\BaseRepository;

/**
 * Class ApplicationAnswerRepository
 * @package Base\Application\Domain\Repositories
 * @version August 11, 2022, 2:13 pm UTC
*/

class ApplicationAnswerRepository extends BaseRepository
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
        return ApplicationAnswer::class;
    }
}
