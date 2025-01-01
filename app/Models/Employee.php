<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'address',
        'contact',
        'econtact',
        'position',
        'employeeid',
        'datebirth',
        'ename',
        'qr',
        'signature',
        'proimage',
        'color',
    ];
}
