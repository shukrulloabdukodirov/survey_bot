<?php

namespace Base\Survey\Domain\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Survey
 * @package Base\Survey\Domain\Models
 * @version August 8, 2022, 5:26 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $questions
 * @property boolean $status
 */
class Survey extends Model
{
    use SoftDeletes;

    use HasFactory;

    use Translatable;

    public $table = 'surveys';

    public $translatedAttributes = ['name'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function questions()
    {
        return $this->hasMany(\Base\Survey\Domain\Models\Question::class);
    }
}
