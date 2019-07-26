<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuestionOption
 *
 * @package App
 * @property string $question
 * @property text $option_text
 * @property tinyInteger $correct
*/
class QuestionOption extends Model
{
    use SoftDeletes;

    protected $fillable = ['option_text', 'correct', 'question_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        QuestionOption::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setQuestionIdAttribute($input)
    {
        $this->attributes['question_id'] = $input ? $input : null;
    }
    
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id')->withTrashed();
    }
    
}
