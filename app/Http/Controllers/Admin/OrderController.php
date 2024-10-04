<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        Paginator::useBootstrap();

        $orders = Order::with('client', 'provider', 'user')->orderBy('id', 'desc');

        if ($request->provider) {
            $orders = $orders->where('provider_id', $request->provider);
        }

        if ($request->client) {
            $orders = $orders->where('client_id', $request->client);
        }

        if ($request->booking_id) {
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);
        $title = trans('admin_validation.All Order');
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $providers = User::where(['status' => 1, 'is_seller' => 1])->orderBy('name', 'asc')->get();
        $clients = User::where(['status' => 1, 'is_seller' => 0])->orderBy('name', 'asc')->get();

        return view('admin.order', compact('orders', 'title', 'currency_icon', 'providers', 'clients'));
    }

    public function show($id)
    {
        $order = Order::with('user')->find($id);
        $setting = Setting::first();
        return view('admin.show_order', compact('order', 'setting'));
    }
}
