<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'qr_code_path', 'is_confirmed'];

}
