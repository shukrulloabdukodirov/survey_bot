<?php

namespace Base\Resource\Domain\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Specialty
 * @package Base\Resource\Domain\Models
 * @version August 11, 2022, 1:52 pm UTC
 *
 * @property boolean $status
 */
class Speciality extends Model
{
    use SoftDeletes;

    use HasFactory;

    use Translatable;

    public $table = 'specialities';

    public $translatedAttributes = ['name'];

    protected $dates = ['deleted_at'];


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

    public function educationCenters()
    {
        return $this->belongsToMany(\Base\Resource\Domain\Models\EducationCenter::class,'education_center_specialities','education_center_id','speciality_id');
    }
}
