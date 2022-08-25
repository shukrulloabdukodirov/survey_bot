<?php

namespace Base\Resource\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TelegramChatQuestionAnswer extends Model
{
    use HasFactory;

    public $table = 'telegram_chat_questions_answers';

    protected $dates = ['created_at','updated_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'applicant_id',
        'telegram_chat_question_id',
        'condition',
        'value',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'applicant_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];
}
