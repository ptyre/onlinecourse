<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Titlefooter
 *
 * @package App
 * @property string $title
 * @property string $qoute
 * @property text $small_descriptive_footer
*/
class Titlefooter extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'qoute', 'small_descriptive_footer'];
    protected $hidden = [];
    
    
    
}
