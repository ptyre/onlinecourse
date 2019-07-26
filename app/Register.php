<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Register
 *
 * @package App
 * @property string $title_register
 * @property text $deskripsi_register
 * @property tinyInteger $show
*/
class Register extends Model
{
    use SoftDeletes;

    protected $fillable = ['title_register', 'deskripsi_register', 'show'];
    protected $hidden = [];
    
    
    
}
