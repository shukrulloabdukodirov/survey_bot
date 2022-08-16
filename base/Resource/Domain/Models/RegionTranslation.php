<?php

namespace Base\Resource\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RegionTranslation
 * @package Base\Resource\Domain\Models
 * @version August 11, 2022, 1:25 pm UTC
 *
 * @property string $name
 * @property string $locale
 * @property integer $region_id
 */
class RegionTranslation extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'region_translations';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'locale',
        'region_id'
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
        'region_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
