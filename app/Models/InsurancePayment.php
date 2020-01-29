<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InsurancePayment
 * @package App\Models
 */
class InsurancePayment extends Model
{
    protected $fillable = ['vehicle_id', 'contract_date', 'amount'];
}
