<?php

namespace Base\Survey\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class QuestionAnswerTranslation
 * @package Base\Survey\Domain\Models
 * @version August 11, 2022, 1:19 pm UTC
 *
 * @property \Base\Survey\Domain\Models\Question $question
 * @property string $string
 * @property string $locale
 * @property integer $question_answer_id
 */
class QuestionAnswerTranslation extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'question_answer_translations';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'string',
        'locale',
        'question_answer_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'string' => 'string',
        'locale' => 'string',
        'question_answer_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function question()
    {
        return $this->belongsTo(\Base\Survey\Domain\Models\Question::class, 'question_id', 'id');
    }
}
