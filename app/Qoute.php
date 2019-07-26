<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Qoute
 *
 * @package App
 * @property string $title
 * @property text $description
 * @property string $picture_qoute
 * @property tinyInteger $show
*/
class Qoute extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'picture_qoute', 'show'];
    protected $hidden = [];
    
    
    
}
