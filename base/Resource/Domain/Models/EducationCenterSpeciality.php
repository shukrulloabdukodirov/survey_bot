<?php

namespace Base\Resource\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public $table = 'education_center_specialities';


    protected $dates = ['deleted_at'];


    protected $primaryKey = 'id';

    public $fillable = [
        'education_center_id',
        'speciality_id',
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
    // public function specialities(){
    //     return $this->(EducationCenter::class, 'region_id','id');
    // }
    public function educationCenter(){
        return $this->belongsTo(EducationCenter::class,'education_center_id','id');
    }

    public function speciality(){
        return $this->belongsTo(Speciality::class,'speciality_id','id');
    }
}
