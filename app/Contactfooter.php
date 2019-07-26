<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Contact
 *
 * @package App
 * @property string $location
 * @property string $phone
 * @property string $email
 * @property tinyInteger $show
*/
class Contactfooter extends Model
{
    use SoftDeletes;

    protected $fillable = ['phone', 'email', 'show', 'location_address', 'location_latitude', 'location_longitude'];
    protected $hidden = [];
    
    
    
}
