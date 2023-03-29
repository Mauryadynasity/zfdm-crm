<?php

namespace App;
use App\Helpers\ConstantHelper;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
// use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Spatie\MediaLibrary\HasMedia\HasMedia;
// use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

use App\Services\Mailers\Mailer;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes;
    protected $guard = 'admin';

    /** By Abhishek
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     public $table="admin";
     protected $fillable = [
        'name',
        'email',
        'phone',
        'sim_id',
        'password',
        'salt',
        'lang',
        'role_id',
        'created_at',
        'updated_at'
    ];
    protected $hidden = [
        'password', 'remember_token', 'deleted_at', 'media'
    ];
    public function role(){
        return $this->hasOne(Role::class, 'id','role_id');
    }
    public function setting(){
        return $this->hasOne(\App\Models\Setting::class);
    }

    public function setPasswordAttribute($password)
    {
        if (!is_null($password))
            $this->attributes['password'] = bcrypt($password);
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable')
            ->with('city', 'state', 'country');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable')
            ->with('city', 'state', 'country');
    }


    public function registerMediaCollections()
    {
        $this->addMediaCollection('profile_image_url')
            ->singleFile();
    }

  

}