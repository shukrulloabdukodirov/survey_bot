<?php

namespace Base\Resource\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SpecialtyTranslation
 * @package Base\Resource\Domain\Models
 * @version August 11, 2022, 1:52 pm UTC
 *
 * @property string $name
 * @property string $locale
 * @property integer $specialty_id
 */
class SpecialityTranslation extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'speciality_translations';

    public $timestamps = false;

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'locale',
        'speciality_id'
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
        'speciality_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
