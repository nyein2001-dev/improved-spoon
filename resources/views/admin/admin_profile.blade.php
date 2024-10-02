@extends('admin.master_layout')
@section('title')
    <title>{{ __('admin.My Profile') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('admin.My Profile') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('admin.Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('admin.My Profile') }}</div>
                </div>
            </div>
        </section>
    </div>
@endsection
