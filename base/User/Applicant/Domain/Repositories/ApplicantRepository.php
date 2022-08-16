<?php

namespace Base\User\Applicant\Domain\Repositories;

use Base\User\Applicant\Domain\Models\Applicant;
use App\Repositories\BaseRepository;

/**
 * Class ApplicantRepository
 * @package Base\User\Applicant\Domain\Repositories
 * @version August 11, 2022, 12:38 pm UTC
*/

class ApplicantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'phone',
        'pin'
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
        return Applicant::class;
    }
}
