<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phonebook extends Model
{
    protected $table = "phone_books";

    protected $fillable = [
        'contact_name', 'contact_phone','contact_address','status'
    ];
}
