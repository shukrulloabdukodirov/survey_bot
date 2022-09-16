<?php

namespace Base\User\Auth\Admin\Domain\Repositories;

use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository
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
        return Permission::class;
    }
}
