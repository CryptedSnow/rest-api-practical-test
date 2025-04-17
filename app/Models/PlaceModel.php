<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceModel extends Model
{
    use HasFactory;

    protected $table = 'places';
    protected $primary_key = 'id';
    protected $fillable = [
        'name',
        'slug',
        'state',
        'city',
    ];
}
