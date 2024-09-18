<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index() {
        $staff = User::where('role', '!=', 'admin')->get();
        
        return Inertia::render('Staff/Index', ['staff' => $staff]);
    }
}
