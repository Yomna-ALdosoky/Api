<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        return "user profile";
    }
}
