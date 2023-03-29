<?php

namespace App\Models;

use App\User;
use App\Models\Prospact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\File;
use Auth;
use DB;
use Storage;

class Quotation extends Model
{
    use SoftDeletes;

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
     public $table="tbl_quotations";
     protected $fillable = [
        'additional_option_id',
        'admin_id',
        'prospact_id',
        'number_of_position',
        'number_of_article',
        'price',
        'article_description',
        'prise_per_article',
        'quotation_number',
        'quotation_date',
        'ust_number',
        'sub_total',
        'grand_total',
        'comments',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function prospact(){
        return $this->hasOne(prospact::class,'id','prospact_id');
    }

}