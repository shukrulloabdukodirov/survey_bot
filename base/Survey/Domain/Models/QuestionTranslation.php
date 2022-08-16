<?php

namespace Base\Survey\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class QuestionTranslation
 * @package Base\Survey\Domain\Models
 * @version August 8, 2022, 10:53 am UTC
 *
 * @property \Base\Survey\Domain\Models\Question $question
 * @property string $text
 * @property string $locale
 * @property integer $question_id
 */
class QuestionTranslation extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'question_translations';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'text',
        'locale',
        'question_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'text' => 'string',
        'locale' => 'string',
        'question_id' => 'integer'
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
