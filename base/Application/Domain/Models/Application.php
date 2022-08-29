<?php

namespace Base\Application\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Application
 * @package Base\Application\Domain\Models
 * @version August 11, 2022, 2:09 pm UTC
 *
 */
class Application extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'applications';


    protected $dates = ['deleted_at'];


    protected $primaryKey = 'condition';

    public $fillable = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'survey_id' => 'integer',
        'education_center_id' => 'integer',
        'speciality_id' => 'integer',
        'applicant_id' => 'integer',
        'condition' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function survey(){
        return  $this->belongsTo(\Base\Survey\Domain\Models\Survey::class, 'survey_id', 'id');
    }

    public function educationCenter(){
        return  $this->belongsTo(\Base\Resource\Domain\Models\EducationCenter::class, 'education_center_id', 'id');
    }

    public function speciality(){
        return  $this->belongsTo(\Base\Resource\Domain\Models\Speciality::class, 'speciality_id', 'id');
    }

    public function applicant(){
        return  $this->belongsTo(\Base\Resource\Domain\Models\Speciality::class, 'speciality_id', 'id');
    }

    public function answers(){
        return  $this->hasMany(\Base\Application\Domain\Models\Application::class, 'application_id', 'id');
    }



}
