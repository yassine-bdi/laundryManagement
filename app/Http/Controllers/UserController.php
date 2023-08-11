<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }

   public function ShowProfile(User $user)
   {
      return view('auth.profile', compact('user'));
   }
}
