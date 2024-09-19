<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('product', 'user')->get();
        return Inertia::render('Orders/Index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $orderForm = $request->validated();

        $product = Product::findOrFail($orderForm['product_id']);

        if($product->quantity < $orderForm['quantity']) {
            return back();
        }

        $product->quantity -= $orderForm['quantity'];
        $product->save();

        $request->user()->orders()->create($orderForm);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.x
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
            // Find the product related to the order
        $product = $order->product;

        // Add the ordered quantity back to the product stock
        $product->quantity += $order->quantity;
        $product->save();

        // Delete the order
        $order->delete();

        return redirect()->route('orders.index');
    }
}
