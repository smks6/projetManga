<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre Extends Model
{
    protected $table = 'genre';
    protected $primaryKey = 'id_genre';
    public $timestamps = false;
}
