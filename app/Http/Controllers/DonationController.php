<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function create(User $user)
    {
        return view('donations.create', compact('user'));
    }
}
