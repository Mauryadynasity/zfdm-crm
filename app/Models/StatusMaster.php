<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;
use Auth;
use DB;
use Storage;

class StatusMaster extends Model implements HasMedia
{
    use HasMediaTrait,SoftDeletes;

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
     public $table="tbl_prospect_status";
     protected $fillable = [
        'status',
        'color',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function statusmaster(){
        return $this->hasOne(Prospact::class,'status');
    }


}