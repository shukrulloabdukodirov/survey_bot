<?php

namespace Base\Application\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EducationCenterSpeciality
 * @package Base\Application\Domain\Models
 * @version August 17, 2022, 4:27 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $cities
 * @property boolean $status
 */
class EducationCenterSpeciality extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'education_center_specialties';


    protected $dates = ['deleted_at'];


    protected $primaryKey = 'id';

    public $fillable = [
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'education_center_id' => 'integer',
        'specialty_id' => 'integer',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'status' => 'required|boolean'
    ];

}
