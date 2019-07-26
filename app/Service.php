<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Service
 *
 * @package App
 * @property string $title_service
 * @property text $description
 * @property string $photo_service
 * @property tinyInteger $show
*/
class Service extends Model
{
    use SoftDeletes;

    protected $fillable = ['title_service', 'description', 'photo_service', 'show'];
    protected $hidden = [];
    
    
    
}
