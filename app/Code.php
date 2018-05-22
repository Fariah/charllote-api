<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.05.18
 * Time: 11:14
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    public $table = 'codes';

    public $timestamps = false;

    protected $fillable = ['code'];
}