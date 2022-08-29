<?php

namespace Base\Application\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ApplicationAnswer
 * @package Base\Application\Domain\Models
 * @version August 11, 2022, 2:13 pm UTC
 *
 */
class ApplicationAnswer extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'application_answers';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'application_id',
        'question_id',
        'answer_by_input',
        'question_answer_id',
        'condition'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'application_id' => 'integer',
        'question_id' => 'integer',
        'answer_by_input' => 'string',
        'question_answer_id' => 'integer',
        'condition' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function application(){
        return $this->belongsTo(\Base\Application\Domain\Models\Application::class, 'application_id', 'id');
    }

    public function question(){
        return $this->belongsTo(\Base\Survey\Domain\Models\Question::class, 'question_id', 'id');
    }

    public function questionAnswer(){
        return $this->belongsTo(\Base\Survey\Domain\Models\QuestionAnswer::class, 'question_answer_id', 'id');
    }

}
