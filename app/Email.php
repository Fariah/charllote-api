<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.05.18
 * Time: 11:14
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public $table = 'emails';

    public $timestamps = false;

    protected $fillable = ['email'];

}