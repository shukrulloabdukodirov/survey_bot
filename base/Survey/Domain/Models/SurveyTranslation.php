<?php

namespace Base\Survey\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SurveyTranslation
 * @package Base\Survey\Domain\Models
 * @version August 8, 2022, 5:27 am UTC
 *
 * @property \Base\Survey\Domain\Models\Survey $survey
 * @property string $name
 * @property string $locale
 * @property integer $survey_id
 */
class SurveyTranslation extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'survey_translations';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'locale',
        'survey_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'locale' => 'string',
        'survey_id' => 'integer'
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
    public function survey()
    {
        return $this->belongsTo(\Base\Survey\Domain\Models\Survey::class, 'survey_id', 'id');
    }
}
