<?php

namespace Base\Resource\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class City
 * @package Base\Resource\Domain\Models
 * @version August 11, 2022, 1:36 pm UTC
 *
 * @property \Base\Resource\Domain\Models\Region $regionSoato
 * @property integer $region_soato_id
 * @property boolean $status
 */
class City extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'cities';
    

    protected $dates = ['deleted_at'];


    protected $primaryKey = 'soato_id';

    public $fillable = [
        'region_soato_id',
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
        'region_soato_id' => 'integer',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function regionSoato()
    {
        return $this->belongsTo(\Base\Resource\Domain\Models\Region::class, 'region_soato_id', 'id');
    }
}
