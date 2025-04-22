<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        
        // Check if user is admin
        if ($user->email === 'admin@gmail.com') {
            return redirect()->route('admin');
        }
        
        $orders = Order::with(['orderInfo', 'orderItems.product'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                // Convert date strings to Carbon instances
                $order->date = Carbon::parse($order->date)->format('Y-m-d H:i:s');
                return $order;
            });

        return view('myProfile', compact('user', 'orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::with(['orderInfo', 'orderItems.product'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('orderDetails', compact('order'));
    }
}
