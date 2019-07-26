<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Title
 *
 * @package App
 * @property string $title
 * @property string $header_photo
 * @property string $type
 * @property tinyInteger $show
*/
class Title extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'header_photo', 'type', 'show'];
    protected $hidden = [];
    
    
    
}
