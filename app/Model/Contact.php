<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        "firstname",
        "secondname",
        "lastname",
        "phone",
        "email",
        "region",
        "city",
        "ip",
        "device",
        "birthday",
        "address",
        "photo",
        "contact_site"
    ];
}
