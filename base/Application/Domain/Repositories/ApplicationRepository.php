<?php

namespace Base\Application\Domain\Repositories;

use Base\Application\Domain\Models\Application;
use App\Repositories\BaseRepository;

/**
 * Class ApplicationRepository
 * @package Base\Application\Domain\Repositories
 * @version August 11, 2022, 2:09 pm UTC
*/

class ApplicationRepository extends BaseRepository
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
        return Application::class;
    }
}
