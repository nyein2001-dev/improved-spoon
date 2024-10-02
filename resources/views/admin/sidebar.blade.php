@php
    $setting = App\Models\Setting::first();
@endphp


<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ $setting->sidebar_lg_header }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">{{ $setting->sidebar_lg_header }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    <span>{{ __('admin.Dashboard') }}</span></a></li>

            <li
                class="nav-item dropdown {{ Route::is('admin.all-booking') || Route::is('admin.order-show') || Route::is('admin.pending-order') || Route::is('admin.complete-order') || Route::is('admin.complete-request') || Route::is('admin.completed-booking') || Route::is('admin.declined-booking') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-shopping-cart"></i><span>{{ __('admin.All Orders') }}</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.all-booking') || Route::is('admin.order-show') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('admin.all-booking') }}">{{ __('admin.All Orders') }}</a>
                    </li>

                    <li class="{{ Route::is('admin.pending-order') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.pending-order') }}">{{ __('admin.Pending Orders') }}</a></li>

                    <li class="{{ Route::is('admin.complete-order') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.complete-order') }}">{{ __('admin.Complete Orders') }}</a></li>

                </ul>
            </li>

        </ul>
    </aside>
</div>
