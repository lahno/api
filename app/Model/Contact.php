<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Contact extends Model
{
    use Searchable;

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
        "soc",
        "soc_id",
        "soc_url",
        "photo",
        "photo_soc",
        "contact_site"
    ];


}
