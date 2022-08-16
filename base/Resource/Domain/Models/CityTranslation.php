<?php

namespace Base\Resource\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CityTranslation
 * @package Base\Resource\Domain\Models
 * @version August 11, 2022, 1:36 pm UTC
 *
 * @property string $name
 * @property string $locale
 * @property integer $city_id
 */
class CityTranslation extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'city_translations';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'locale',
        'city_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'locale' => 'string',
        'city_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
