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

class Setting extends Model implements HasMedia
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
     public $table="tbl_settings";
     protected $fillable = [
        'company_name',
        'person_name',
        'website_url',
        'company_logo',
        'phone',
        'email',
        'company_address',
        'ust_number',
        'bank_name',
        'account_number',
        'ifsc_code',
        'branch_address',
        'tax_number',
        'admin_id',
        'mobile_number',
        'landline_number',
        'streat_name_1',
        'streat_name_2',
        'streat_name_3',
        'place_code',
        'place_name',
        'country',
        'tax_identification_no',
        'quotation_start_no',
        'quotation_current_no',
        'footer_text',
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


}