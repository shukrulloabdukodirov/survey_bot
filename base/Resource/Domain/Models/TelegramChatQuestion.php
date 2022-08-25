<?php

namespace Base\Resource\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TelegramChatQuestion extends Model
{
    use HasFactory;

    public $table = 'telegram_chat_questions';

    protected $dates = ['created_at','updated_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'question'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'question' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'question' => 'required|string'
    ];
}
