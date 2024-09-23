<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            abort(403); // Or redirect to a login page
        }

        // Fetch counts for the current user's orders with different statuses
        $orderStatuses = Order::selectRaw('status, COUNT(*) as count')
            ->where('user_id', Auth::id()) // Only fetch orders for the authenticated user
            ->groupBy('status')
            ->get()
            ->keyBy('status')
            ->map(function ($row) {
                return $row->count;
            });

        // Return counts, defaulting to 0 if not found
        return Inertia::render('User/Index', [
            'pendingOrders' => $orderStatuses->get('pending', 0),
            'shippedOrders' => $orderStatuses->get('shipped', 0),
            'completedOrders' => $orderStatuses->get('completed', 0),
            'cancelledOrders' => $orderStatuses->get('cancelled', 0),
        ]);
    }
}
