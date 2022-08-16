<?php

namespace Base\User\Applicant\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ApplicantInfo
 * @package Base\User\Applicant\Domain\Models
 * @version August 11, 2022, 12:42 pm UTC
 *
 * @property \Base\User\Applicant\Domain\Models\ApplicantInfo $applicantInfo
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 * @property string $nickname
 * @property string $passport
 * @property string $source
 * @property integer $applicant_id
 */
class ApplicantInfo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'applicant_infos';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'nickname',
        'passport',
        'source',
        'applicant_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'patronymic' => 'string',
        'nickname' => 'string',
        'passport' => 'string',
        'source' => 'string',
        'applicant_id' => 'integer'
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
    public function applicantInfo()
    {
        return $this->belongsTo(\Base\User\Applicant\Domain\Models\ApplicantInfo::class);
    }
}
