<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiscFee extends Model
{
    use HasFactory;
    protected $table = 'miscfee';
    protected $connection = 'billingDB';
}
