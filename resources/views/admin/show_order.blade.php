@extends('admin.master_layout')
@section('title')
    <title>{{ __('admin.Order Details') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('admin.Invoice') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.dashboard') }}">{{ __('admin.Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('admin.Invoice') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2><img src="{{ asset($setting->logo) }}" alt="" width="120px"></h2>
                                    <div class="invoice-number">{{ __('admin.Order Id') }} #{{ $order->order_id }}</div>
                                </div>
                                <hr>
                                @php
                                    $orderAddress = $order->user;
                                @endphp
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>{{ __('admin.User Information') }}:</strong><br>
                                            {{ $orderAddress->name }}<br>
                                            @if ($orderAddress->email)
                                                {{ $orderAddress->email }}<br>
                                            @endif
                                            @if ($orderAddress->phone)
                                                {{ $orderAddress->phone }}<br>
                                            @endif
                                            {{ $orderAddress->address }},
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>{{ __('admin.Payment Information') }}:</strong><br>
                                            {{ __('admin.Method') }}: {{ $order->payment_method }}<br>
                                            {{ __('admin.Status') }} : @if ($order->payment_status == 'success')
                                                <span class="badge badge-success">{{ __('admin.Complete') }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ __('admin.Pending') }}</span>
                                            @endif <br>
                                            {{ __('admin.Transaction') }}: {!! Purifier::clean(nl2br($order->transection_id)) !!}
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>{{ __('admin.Order Information') }}:</strong><br>
                                            {{ __('admin.Date') }}:
                                            {{ Carbon\Carbon::parse($order->created_at)->format('d F, Y') }}<br>

                                            {{ __('admin.Status') }} :
                                            @if ($order->order_status == 1)
                                                <span class="badge badge-success">{{ __('admin.Complete') }} </span>
                                            @else
                                                <span class="badge badge-danger">{{ __('admin.Pending') }}</span>
                                            @endif
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="section-title">{{ __('admin.Order Summary') }}</div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="25%">{{ __('admin.Product') }}</th>
                                            <th width="20%">{{ __('admin.Service name') }}</th>
                                            <th width="20%">{{ __('admin.Option') }}</th>
                                            <th width="10%">{{ __('admin.Author') }}</th>
                                            <th width="10%" class="text-center">{{ __('admin.Unit Price') }}</th>
                                            <th width="10%" class="text-center">{{ __('admin.Qty') }}</th>
                                            <th width="10%" class="text-right">{{ __('admin.Total') }}</th>
                                        </tr>

                                        @foreach ($order->orderItems as $index => $item)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td><a
                                                        href="{{ route('admin.product.edit', ['product' => $item->product_id, 'lang_code' => 'en']) }}">{{ $item->product->name }}</a>
                                                </td>
                                                <td>{{ $item->variant_name }} </td>
                                                <td>{{ $item->option_name }} </td>

                                                <td>
                                                    @if ($item->author)
                                                        <a
                                                            href="{{ route('admin.provider-show', $item->author_id) }}">{{ $item?->author?->name }}</a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $setting->currency_icon }}{{ $item->option_price }}</td>
                                                <td class="text-center">{{ $item->qty }}</td>
                                                @php
                                                    $total = $item->option_price * $item->qty;
                                                @endphp
                                                <td class="text-right">{{ $setting->currency_icon }}{{ $total }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-lg-6 order-status">

                                    </div>

                                    <div class="col-lg-6 text-right">
                                        @php
                                            $sub_total = $order->total_amount;
                                            $sub_total = $sub_total - $order->shipping_cost;
                                            $sub_total = $sub_total + $order->coupon_coast;
                                        @endphp

                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-value invoice-detail-value-lg">
                                                {{ __('admin.Total') }} :
                                                {{ $setting->currency_icon }}{{ round($order->total_amount, 2) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
