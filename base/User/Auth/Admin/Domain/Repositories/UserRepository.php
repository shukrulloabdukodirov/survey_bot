<?php

namespace Base\User\Auth\Admin\Domain\Repositories;

use App\Models\User;
use Base\User\Applicant\Domain\Models\Applicant;
use App\Repositories\BaseRepository;

/**
 * Class ApplicantRepository
 * @package Base\User\Applicant\Domain\Repositories
 * @version August 11, 2022, 12:38 pm UTC
*/

class UserRepository extends BaseRepository
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
        return User::class;
    }
}
