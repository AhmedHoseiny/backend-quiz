<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vehicle
 * @package App\Models
 */
class Vehicle extends Model
{
    protected $fillable = ['name', 'plate_number'];
}
