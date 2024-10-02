<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $setting = Setting::first();
        $default_avatar = array(
            'image' => $setting->default_avatar
        );
        $default_avatar = (object) $default_avatar;
        return view('admin.admin_profile', compact('admin', 'default_avatar'));
    }
}
