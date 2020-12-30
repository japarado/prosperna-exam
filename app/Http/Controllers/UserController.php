<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class UserController extends Controller
{
	public function debugDeleteAll()
	{
		Artisan::call('migrate:refresh');
		return back();
	}
}
