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
class EducationCenterTypeTranslation extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $timestamps = false;

    public $table = 'education_center_type_translations';


    protected $dates = ['deleted_at'];


}
