<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\File;
use Auth;
use DB;
use Storage;

class AdditionalOption extends Model
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
     public $table="tbl_additional_options";
     protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}