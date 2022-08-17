<?php

namespace Base\Resource\Domain\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Region
 * @package Base\Resource\Domain\Models
 * @version August 11, 2022, 1:24 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $cities
 * @property boolean $status
 */
class Region extends Model
{
    use SoftDeletes;

    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name'];
    public $table = 'regions';


    protected $dates = ['deleted_at'];


    protected $primaryKey = 'id';

    public $fillable = [
        'soato_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'soato_id' => 'integer',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function cities()
    {
        return $this->hasMany(\Base\Resource\Domain\Models\City::class, 'region_soato_id', 'soato_id');
    }
}
