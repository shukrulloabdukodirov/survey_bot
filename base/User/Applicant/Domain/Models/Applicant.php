<?php

namespace Base\User\Applicant\Domain\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Applicant
 * @package Base\User\Applicant\Domain\Models
 * @version August 11, 2022, 12:38 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $applicantInfos
 * @property integer $phone
 * @property integer $pin
 */
class Applicant extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'applicants';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'phone',
        'pin',
        'chat_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'phone' => 'integer',
        'pin' => 'integer',
        'chat_id'=>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function applicantInfos()
    {
        return $this->hasMany(\Base\User\Applicant\Domain\Models\ApplicantInfo::class);
    }
}
