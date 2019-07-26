<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Commentstudent
 *
 * @package App
 * @property string $name
 * @property text $deskripsi
 * @property string $photo_comment
 * @property string $job
 * @property tinyInteger $show
*/
class Commentstudent extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'deskripsi', 'photo_comment', 'job', 'show'];
    protected $hidden = [];
    
    
    
}
