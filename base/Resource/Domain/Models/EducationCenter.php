<?php

namespace Base\Resource\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EducationCenter
 * @package Base\Resource\Domain\Models
 * @version August 11, 2022, 1:44 pm UTC
 *
 * @property boolean $status
 * @property integer $region_id
 * @property integer $city_id
 */
class EducationCenter extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'education_centers';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'status',
        'region_id',
        'city_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'boolean',
        'region_id' => 'integer',
        'city_id' => 'integer'
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
