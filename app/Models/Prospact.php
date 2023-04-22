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

class Prospact extends Model implements HasMedia
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
     public $table="tbl_prospects";
     protected $fillable = [
        'company_name',
        'cust_name',
        'cust_email',
        'cust_phone',
        'street_name',
        'post_code',
        'place_name',
        'wants_offer',
        'no_employee',
        'cust_msg',
        'news',
        'device_type',
        'packet',
        'cust_source',
        'callback',
        'date_of_contact',
        'protocol',
        'no_device',
        'admin_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

     protected $appends = [
        'upload_file',
    ];

     public function getUploadFileAttribute(){
        if ($this->getMedia('upload_file')->isEmpty()) {
            return false;
        }else{
            return $this->getMedia('upload_file')->first()->getFullUrl();
        }
    }
    public function registerMediaCollections(){
        $this->addMediaCollection('upload_file')
            ->singleFile();
     }

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