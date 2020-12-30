<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class UserController extends Controller
{
	public function debugDeleteAll()
	{
		Subscription::whereNotNull('id')->delete();
		User::whereNotNull('id')->delete();
		return back();
	}
}
