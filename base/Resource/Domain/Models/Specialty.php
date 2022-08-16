<?php

namespace Base\Resource\Domain\Models;

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
class Specialty extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'specialties';
    

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

    
}
