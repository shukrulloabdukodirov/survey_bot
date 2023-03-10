<?php

namespace Base\Resource\Domain\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use function PHPUnit\Framework\isEmpty;

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

    use Translatable;

    public $translatedAttributes = ['name'];

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
        // 'status' => 'required|boolean'
    ];

    protected static function booted()
    {
        static::addGlobalScope('by_role', function (Builder $builder) {
            $user = request()->user();
            if(!isEmpty( $user))
            {
                $rolesList = $user->getRoleNames()->toArray();
                if(in_array('education_center',$rolesList)){
                    $builder->where('id',$user->education_center_id);
                }
            }
        });
    }

    public function specialities()
    {
        return $this->belongsToMany(\Base\Resource\Domain\Models\Speciality::class,'education_center_specialities','education_center_id','speciality_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
