<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'userID',
        'ic',
        'address',
        'remark',
        'status',
        'handphone_number',
    ];
}
