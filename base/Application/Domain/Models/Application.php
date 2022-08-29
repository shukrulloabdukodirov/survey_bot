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



    public $fillable = [
        'applicant_id',
        'survey_id',
        'education_center_id',
        'speciality_id',
        'condition'
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

    
}
