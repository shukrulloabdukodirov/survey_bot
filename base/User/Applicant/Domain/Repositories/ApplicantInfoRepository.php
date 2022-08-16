<?php

namespace Base\User\Applicant\Domain\Repositories;

use Base\User\Applicant\Domain\Models\ApplicantInfo;
use App\Repositories\BaseRepository;

/**
 * Class ApplicantInfoRepository
 * @package Base\User\Applicant\Domain\Repositories
 * @version August 11, 2022, 12:42 pm UTC
*/

class ApplicantInfoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'patronymic',
        'nickname',
        'passport',
        'source',
        'applicant_id'
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
        return ApplicantInfo::class;
    }
}
