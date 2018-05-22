<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.05.18
 * Time: 11:14
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ContactCampaign extends Model
{
    public $table = 'contact_campaigns';

    protected $fillable = [
        'email',
        'code',
        'status'
    ];
}