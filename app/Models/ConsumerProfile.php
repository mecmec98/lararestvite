<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumerProfile extends Model
{
    use HasFactory;
    protected $table = 'consumer_profile';
    protected $connection = 'billingDB';
}
