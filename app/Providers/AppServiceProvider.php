<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share cart items and total price with specific views
        View::composer(['layouts.navigationuser', 'user.order', 'user.order_details'], function ($view) {
            // Get the logged-in user's ID
            $userId = Auth::id();

            // Retrieve cart items for the user
            $cartItems = Cart::where('users_id', $userId)->get();

            // Count the items in the user's cart
            $cartItemCount = Cart::where('users_id', $userId)->count();

            // Calculate the total price of the cart
            $totalPrice = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            $orderDetails = OrderDetail::where('users_id', $userId)->get();

            // Share the variables with the view
            $view->with('cartItemCount', $cartItemCount);
            $view->with('cartItems', $cartItems);
            $view->with('totalPrice', $totalPrice); // Share total price
            $view->with('orderDetails', $orderDetails); // 
        });
    }
}
