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

class Protocol extends Model implements HasMedia
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
     public $table="tbl_protocols";
     protected $fillable = [
        'prospect_id',
        'admin_id',
        'messages',
        'date',
        'deleted_at'
    ];


    public function quotation(){
        return $this->hasOne(Quotation::class,'prospact_id');
    }
    public function statusMaster(){
        return $this->hasOne(statusMaster::class);
    }
    public function quotations(){
        return $this->hasMany(Quotation::class);
    }

    public function getStatus(){
        return $this->hasOne(StatusMaster::class,'status','status');
    }



}