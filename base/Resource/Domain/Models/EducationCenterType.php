<?php

namespace Base\Resource\Domain\Models;

use Astrotomic\Translatable\Translatable;
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
class EducationCenterType extends Model
{
    use SoftDeletes;

    use HasFactory;

    use Translatable;

    public $translatedAttributes = ['name'];

    public $table = 'education_center_types';


    protected $dates = ['deleted_at'];

}
