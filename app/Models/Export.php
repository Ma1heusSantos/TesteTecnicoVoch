<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    protected $table = 'exports';
    protected $fillable = [
        'user_id',
        'file_path',
        'status'
    ];
}
