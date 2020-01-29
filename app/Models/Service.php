<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 * @package App\Models
 */
class Service extends Model
{
    protected $fillable = ['vehicle_id', 'total', 'created_at'];
}
