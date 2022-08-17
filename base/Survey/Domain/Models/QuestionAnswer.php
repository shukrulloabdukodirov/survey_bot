<?php

namespace Base\Survey\Domain\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class QuestionAnswer
 * @package Base\Survey\Domain\Models
 * @version August 8, 2022, 10:54 am UTC
 *
 * @property \Base\Survey\Domain\Models\Questions $question
 * @property boolean $status
 * @property integer $question_id
 */
class QuestionAnswer extends Model
{
    use SoftDeletes;

    use HasFactory;

    use Translatable;

    public $table = 'question_answers';


    protected $dates = ['deleted_at'];

    public $translatedAttributes = ['string'];

    public $fillable = [
        'status',
        'question_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'boolean',
        'question_id' => 'integer'
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
    public function question()
    {
        return $this->belongsTo(\Base\Survey\Domain\Models\Questions::class, 'question_id', 'id');
    }
}
