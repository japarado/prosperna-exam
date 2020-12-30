<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller {
	public function index()
	{

	}

	public function create()
	{

	}

	public function store()
	{

	}

	public function mine()
	{
		$user = User::where('id', Auth::user()->id)->with('subscriptions')->first();
		dd($user->name);
		return view('subscriptions.mine');
	}
}
