<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FuelEntry
 * @package App\Models
 */
class FuelEntry extends Model
{
    protected $fillable = ['vehicle_id', 'entry_date', 'cost'];
}
