<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\File;
use Auth;
use DB;
use Storage;

class Offer extends Model
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
     public $table="tbl_offers";
     protected $fillable = [
        'additional_option_id',
        'admin_id',
        'prospact_id',
        'number_of_employee',
        'number_of_advised',
        'piece_prise',
        'prise',
        'an_notation',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}