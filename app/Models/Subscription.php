<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

	protected $fillable = [
		'name',
		'order_id',
		'payment_id',
		'subscription_id',
		'facilitator_access_token',
		'user_id'
	];
}
