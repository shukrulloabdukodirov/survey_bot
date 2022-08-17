<?php

namespace Base\Resource\Domain\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EducationCenterTranslation
 * @package Base\Resource\Domain\Models
 * @version August 11, 2022, 1:44 pm UTC
 *
 * @property string $name
 * @property string $locale
 * @property integer $education_center_id
 */
class EducationCenterTranslation extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $timestamps = false;

    public $table = 'education_center_translations';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'locale',
        'education_center_id'
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
        'education_center_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
