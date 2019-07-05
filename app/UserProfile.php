<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserProfile
 * @package App
 * @property string $phone
 * @property string $name
 * @property string $about
 */
class UserProfile extends Model
{
    protected $table = 'user_profiles';
    protected $fillable = [
        'phone',
        'name',
        'about'
    ];

}
