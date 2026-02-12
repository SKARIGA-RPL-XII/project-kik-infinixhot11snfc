<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    public function boot()
    {
        View::composer('*', function ($view) {
            $cartCount = 0;

            if (Auth::check()) {
                $cartCount = Cart::where('id_user', Auth::id())->count();
            }

            $view->with('cartCount', $cartCount);
        });
    }
}
