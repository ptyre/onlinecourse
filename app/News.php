<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class News
 *
 * @package App
 * @property string $title
 * @property string $writer
 * @property string $tags
 * @property text $descriptive
 * @property text $small_descriptive
 * @property string $date_news
 * @property tinyInteger $show
*/
class News extends Model
{
    use SoftDeletes;

    
    protected $table = "news";
    protected $fillable = ['title', 'writer', 'descriptive', 'small_descriptive', 'date_news', 'show', 'tags_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTagsIdAttribute($input)
    {
        $this->attributes['tags_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateNewsAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date_news'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date_news'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateNewsAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    
    public function tags()
    {
        return $this->belongsTo(Tag::class, 'tags_id')->withTrashed();
    }
    
}
