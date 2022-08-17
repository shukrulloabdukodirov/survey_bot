<?php

namespace Base\Survey\Domain\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Question
 * @package Base\Survey\Domain\Models
 * @version August 11, 2022, 12:53 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $questionAnswers
 * @property boolean $status
 * @property integer $survey_id
 */
class Question extends Model
{
    use SoftDeletes;

    use HasFactory;

    use Translatable;

    public $table = 'questions';


    protected $dates = ['deleted_at'];

    public $translatedAttributes = ['text'];

    public $fillable = [
        'status',
        'survey_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'boolean',
        'survey_id' => 'integer'
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
    public function questionAnswers()
    {
        return $this->hasMany(\Base\Survey\Domain\Models\QuestionAnswer::class, 'question_id', 'id');
    }
}
