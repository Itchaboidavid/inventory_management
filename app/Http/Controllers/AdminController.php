<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\Product;

class AdminController extends Controller
{
    public function index() {
        $products = Product::all();
        return Inertia::render('Admin/Index', ['products' => $products]);
    }
}
