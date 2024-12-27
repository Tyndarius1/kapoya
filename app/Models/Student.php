<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'address',
        'course',
        'studentid',
        'contact',
        'econtact',
        'datebirth',
        'ename',
        'signature',
        'qr',
        'proimage',
    ];
}
