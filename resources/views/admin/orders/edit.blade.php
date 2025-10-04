@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
    <style>
        .option-card {
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        .option-card:hover {
            border-color: #007bff;
            box-shadow: 0 2px 8px rgba(0,123,255,0.15);
        }
        .option-card .card-body {
            padding: 1rem;
        }
    </style>
@endsection
{{-- extra css files --}}

@section('content')
<form method="POST" action="{{route('admin.orders.update', $order->id)}}" class="store form-horizontal" novalidate enctype="multipart/form-data">

    <div class="content-body">
        <section id="dashboard-ecommerce">
            <div class="content-body">
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1 card card-body">
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 active" id="tab-pill-1" data-toggle="pill"
                                       href="#tab-1" aria-expanded="true">
                                        <i class="feather icon-map-pin mr-50 font-medium-3"></i>
                                        @lang('admin.location_information')
                                    </a>
                                </li>
                                <li class="nav-item" style="margin-top: 3px">
                                    <a class="nav-link d-flex py-75" id="tab-pill-2" data-toggle="pill"
                                       href="#tab-2" aria-expanded="false">
                                        <i class="feather icon-calendar mr-50 font-medium-3"></i>
                                        @lang('admin.date_time_information')
                                    </a>
                                </li>
                                <li class="nav-item" style="margin-top: 3px">
                                    <a class="nav-link d-flex py-75" id="tab-pill-3" data-toggle="pill"
                                       href="#tab-3" aria-expanded="false">
                                        <i class="feather icon-send mr-50 font-medium-3"></i>
                                        @lang('admin.flight_information')
                                    </a>
                                </li>
                                <li class="nav-item" style="margin-top: 3px">
                                    <a class="nav-link d-flex py-75" id="tab-pill-4" data-toggle="pill"
                                       href="#tab-4" aria-expanded="false">
                                        <i class="feather icon-truck mr-50 font-medium-3"></i>
                                        @lang('admin.car_options')
                                    </a>
                                </li>
                                <li class="nav-item" style="margin-top: 3px">
                                    <a class="nav-link d-flex py-75" id="tab-pill-5" data-toggle="pill"
                                       href="#tab-5" aria-expanded="false">
                                        <i class="feather icon-user mr-50 font-medium-3"></i>
                                        @lang('admin.customer_information')
                                    </a>
                                </li>
                                <li class="nav-item" style="margin-top: 3px">
                                    <a class="nav-link d-flex py-75" id="tab-pill-6" data-toggle="pill"
                                       href="#tab-6" aria-expanded="false">
                                        <i class="feather icon-settings mr-50 font-medium-3"></i>
                                        @lang('admin.order_management')
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">

                                            <!-- Location Information Tab -->
                                            <div role="tabpanel" class="tab-pane active" id="tab-1"
                                                 aria-labelledby="tab-pill-1" aria-expanded="true">
                                                <div class="row">
                                                    <div class="col-3">
                                                        @lang('admin.location_information')
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="card">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-body">
                                                                        <div class="row">

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.pickup_location')</label>
                                                                                    <div class="controls">
                                                                                        <select name="pickup_location_id" class="select2 form-control">
                                                                                            <option value="">@lang('admin.select_pickup_location')</option>
                                                                                            @foreach($locations as $location)
                                                                                                <option value="{{$location->id}}" {{old('pickup_location_id', $order->pickup_location_id) == $location->id ? 'selected' : ''}}>
                                                                                                    {{$location->name}} ({{$location->type_text}})
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.pickup_address')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="pickup_address" class="form-control" value="{{old('pickup_address', $order->pickup_address)}}" placeholder="@lang('admin.pickup_address')">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.return_location')</label>
                                                                                    <div class="controls">
                                                                                        <select name="return_location_id" class="select2 form-control">
                                                                                            <option value="">@lang('admin.select_return_location')</option>
                                                                                            @foreach($locations as $location)
                                                                                                <option value="{{$location->id}}" {{old('return_location_id', $order->return_location_id) == $location->id ? 'selected' : ''}}>
                                                                                                    {{$location->name}} ({{$location->type_text}})
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.return_address')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="return_address" class="form-control" value="{{old('return_address', $order->return_address)}}" placeholder="@lang('admin.return_address')">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <div class="controls">
                                                                                        <label class="form-check-label">
                                                                                            <input type="checkbox" name="same_return_location" value="1" class="form-check-input" {{old('same_return_location', $order->same_return_location) ? 'checked' : ''}}>
                                                                                            @lang('admin.same_return_location')
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Date & Time Information Tab -->
                                            <div role="tabpanel" class="tab-pane" id="tab-2"
                                                 aria-labelledby="tab-pill-2" aria-expanded="false">
                                                <div class="row">
                                                    <div class="col-3">
                                                        @lang('admin.date_time_information')
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="card">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <div class="form-body">
                                                                        <div class="row">

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.pickup_date')</label>
                                                                                    <div class="controls">
                                                                                        <input type="date" name="pickup_date" class="form-control" value="{{old('pickup_date', $order->pickup_date ? $order->pickup_date->format('Y-m-d') : '')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.pickup_time')</label>
                                                                                    <div class="controls">
                                                                                        <input type="time" name="pickup_time" class="form-control" value="{{old('pickup_time', $order->pickup_time)}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.return_date')</label>
                                                                                    <div class="controls">
                                                                                        <input type="date" name="return_date" class="form-control" value="{{old('return_date', $order->return_date ? $order->return_date->format('Y-m-d') : '')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.return_time')</label>
                                                                                    <div class="controls">
                                                                                        <input type="time" name="return_time" class="form-control" value="{{old('return_time', $order->return_time)}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Flight Information Tab -->
                                            <div role="tabpanel" class="tab-pane" id="tab-3"
                                                 aria-labelledby="tab-pill-3" aria-expanded="false">
                                                <div class="row">
                                                    <div class="col-3">
                                                        @lang('admin.flight_information')
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="card">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <div class="form-body">
                                                                        <div class="row">

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.flight_arrival_date')</label>
                                                                                    <div class="controls">
                                                                                        <input type="date" name="flight_arrival_date" class="form-control" value="{{old('flight_arrival_date', $order->flight_arrival_date ? $order->flight_arrival_date->format('Y-m-d') : '')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.flight_arrival_time')</label>
                                                                                    <div class="controls">
                                                                                        <input type="time" name="flight_arrival_time" class="form-control" value="{{old('flight_arrival_time', $order->flight_arrival_time)}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.flight_number_arrival')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="flight_number_arrival" class="form-control" value="{{old('flight_number_arrival', $order->flight_number_arrival)}}" placeholder="@lang('admin.flight_number_arrival')">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.flight_airline_arrival')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="flight_airline_arrival" class="form-control" value="{{old('flight_airline_arrival', $order->flight_airline_arrival)}}" placeholder="@lang('admin.flight_airline_arrival')">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.flight_departure_date')</label>
                                                                                    <div class="controls">
                                                                                        <input type="date" name="flight_departure_date" class="form-control" value="{{old('flight_departure_date', $order->flight_departure_date ? $order->flight_departure_date->format('Y-m-d') : '')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.flight_departure_time')</label>
                                                                                    <div class="controls">
                                                                                        <input type="time" name="flight_departure_time" class="form-control" value="{{old('flight_departure_time', $order->flight_departure_time)}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.flight_number_departure')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="flight_number_departure" class="form-control" value="{{old('flight_number_departure', $order->flight_number_departure)}}" placeholder="@lang('admin.flight_number_departure')">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.flight_airline_departure')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="flight_airline_departure" class="form-control" value="{{old('flight_airline_departure', $order->flight_airline_departure)}}" placeholder="@lang('admin.flight_airline_departure')">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Car & Options Tab -->
                                            <div role="tabpanel" class="tab-pane" id="tab-4"
                                                 aria-labelledby="tab-pill-4" aria-expanded="false">
                                                <div class="row">
                                                    <div class="col-3">
                                                        @lang('admin.car_options')
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="card">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <div class="form-body">
                                                                        <div class="row">

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.customer_age')</label>
                                                                                    <div class="controls">
                                                                                        <input type="number" name="customer_age" class="form-control" value="{{old('customer_age', $order->customer_age)}}" min="18" max="100" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.customer_country')</label>
                                                                                    <div class="controls">
                                                                                        <select name="customer_country_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                            <option value="">@lang('admin.select')</option>
                                                                                            @foreach($countries as $country)
                                                                                                <option value="{{$country->id}}" {{old('customer_country_id', $order->customer_country_id) == $country->id ? 'selected' : ''}}>
                                                                                                    {{$country->name}}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.car')</label>
                                                                                    <div class="controls">
                                                                                        <select name="car_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                            <option value="">@lang('admin.select_car')</option>
                                                                                            @foreach($cars as $car)
                                                                                                <option value="{{$car->id}}" {{old('car_id', $order->car_id) == $car->id ? 'selected' : ''}}>
                                                                                                    {{$car->name}}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.price_packages')</label>
                                                                                    <div class="controls">
                                                                                        <select name="price_package_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                            <option value="">@lang('admin.select_price_package')</option>
                                                                                            @foreach($pricePackages as $package)
                                                                                                <option value="{{$package->id}}" {{old('price_package_id', $order->price_package_id) == $package->id ? 'selected' : ''}}>
                                                                                                    {{$package->name}} - {{$package->formatted_price}}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.options.index')</label>
                                                                                    <div class="controls">
                                                                                        <div class="row">
                                                                                            @foreach($options as $option)
                                                                                                <div class="col-md-6 col-lg-4 mb-3">
                                                                                                    <div class="card option-card">
                                                                                                        <div class="card-body">
                                                                                                            <div class="d-flex align-items-center mb-2">
                                                                                                                @if($option->icon)
                                                                                                                    <img src="{{$option->icon}}" alt="{{$option->name}}" class="img-thumbnail" style="width: 40px; height: 40px; margin-right: 10px;">
                                                                                                                @endif
                                                                                                                <div>
                                                                                                                    <h6 class="mb-0">{{$option->name}}</h6>
                                                                                                                    <small class="text-muted">{{$option->formatted_price}}</small>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            @if($option->description)
                                                                                                                <p class="text-muted small mb-2">{{$option->description}}</p>
                                                                                                            @endif
                                                                                                            <div class="input-group">
                                                                                                                <input type="number" name="options[{{$option->id}}][quantity]" class="form-control" min="0" value="{{old('options.'.$option->id.'.quantity', $order->options->where('id', $option->id)->first()->pivot->quantity ?? 0)}}" placeholder="0">
                                                                                                                <div class="input-group-append">
                                                                                                                    <span class="input-group-text">@lang('admin.qty')</span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.coupon_code')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="coupon_code" class="form-control" value="{{old('coupon_code', $order->coupon_code)}}" placeholder="@lang('admin.coupon_code')">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Customer Information Tab -->
                                            <div role="tabpanel" class="tab-pane" id="tab-5"
                                                 aria-labelledby="tab-pill-5" aria-expanded="false">
                                                <div class="row">
                                                    <div class="col-3">
                                                        @lang('admin.customer_information')
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="card">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <div class="form-body">
                                                                        <div class="row">

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.first_name')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="first_name" class="form-control" value="{{old('first_name', $order->first_name)}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.last_name')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="last_name" class="form-control" value="{{old('last_name', $order->last_name)}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.email')</label>
                                                                                    <div class="controls">
                                                                                        <input type="email" name="email" class="form-control" value="{{old('email', $order->email)}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.phone')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="phone" class="form-control" value="{{old('phone', $order->phone)}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.address')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="address" class="form-control" value="{{old('address', $order->address)}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.city')</label>
                                                                                    <div class="controls">
                                                                                        <select name="city_id" class="select2 form-control">
                                                                                            <option value="">@lang('admin.select')</option>
                                                                                            @foreach($cities as $city)
                                                                                                <option value="{{$city->id}}" {{old('city_id', $order->city_id) == $city->id ? 'selected' : ''}}>
                                                                                                    {{$city->name}}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.country')</label>
                                                                                    <div class="controls">
                                                                                        <select name="country_id" class="select2 form-control">
                                                                                            <option value="">@lang('admin.select')</option>
                                                                                            @foreach($countries as $country)
                                                                                                <option value="{{$country->id}}" {{old('country_id', $order->country_id) == $country->id ? 'selected' : ''}}>
                                                                                                    {{$country->name}}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.zip')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="zip" class="form-control" value="{{old('zip', $order->zip)}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.birthdate')</label>
                                                                                    <div class="controls">
                                                                                        <input type="date" name="birthdate" class="form-control" value="{{old('birthdate', $order->birthdate ? $order->birthdate->format('Y-m-d') : '')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.driver_license_number')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="driver_license_number" class="form-control" value="{{old('driver_license_number', $order->driver_license_number)}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.driver_license_expiration_date')</label>
                                                                                    <div class="controls">
                                                                                        <input type="date" name="driver_license_expiration_date" class="form-control" value="{{old('driver_license_expiration_date', $order->driver_license_expiration_date ? $order->driver_license_expiration_date->format('Y-m-d') : '')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.driver_license_image')</label>
                                                                                    <div class="imgMontg col-12 text-center">
                                                                                        <div class="dropBox">
                                                                                            <div class="textCenter">
                                                                                                <div class="imagesUploadBlock">
                                                                                                    <label class="uploadImg">
                                                                                                        <span><i class="feather icon-image"></i></span>
                                                                                                        <input type="file"
                                                                                                               accept="image/*"
                                                                                                               name="driver_license_image"
                                                                                                               class="imageUploader">
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @if($order->driver_license_image)
                                                                                            <div class="mt-2">
                                                                                                <img src="{{$order->driver_license_image}}" alt="Driver License" class="img-thumbnail" style="max-width: 200px;">
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.current_country_address')</label>
                                                                                    <div class="controls">
                                                                                        <textarea name="current_country_address" class="form-control" rows="3">{{old('current_country_address', $order->current_country_address)}}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.passport_expiration_date')</label>
                                                                                    <div class="controls">
                                                                                        <input type="date" name="passport_expiration_date" class="form-control" value="{{old('passport_expiration_date', $order->passport_expiration_date ? $order->passport_expiration_date->format('Y-m-d') : '')}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.passport_image')</label>
                                                                                    <div class="imgMontg col-12 text-center">
                                                                                        <div class="dropBox">
                                                                                            <div class="textCenter">
                                                                                                <div class="imagesUploadBlock">
                                                                                                    <label class="uploadImg">
                                                                                                        <span><i class="feather icon-image"></i></span>
                                                                                                        <input type="file"
                                                                                                               accept="image/*"
                                                                                                               name="passport_image"
                                                                                                               class="imageUploader">
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @if($order->passport_image)
                                                                                            <div class="mt-2">
                                                                                                <img src="{{$order->passport_image}}" alt="Passport" class="img-thumbnail" style="max-width: 200px;">
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.client_signature')</label>
                                                                                    <div class="imgMontg col-12 text-center">
                                                                                        <div class="dropBox">
                                                                                            <div class="textCenter">
                                                                                                <div class="imagesUploadBlock">
                                                                                                    <label class="uploadImg">
                                                                                                        <span><i class="feather icon-edit-3"></i></span>
                                                                                                        <input type="file"
                                                                                                               accept="image/*"
                                                                                                               name="client_signature"
                                                                                                               class="imageUploader">
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @if($order->client_signature)
                                                                                            <div class="mt-2">
                                                                                                <img src="{{$order->client_signature}}" alt="Client Signature" class="img-thumbnail" style="max-width: 200px;">
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Order Management Tab -->
                                            <div role="tabpanel" class="tab-pane" id="tab-6"
                                                 aria-labelledby="tab-pill-6" aria-expanded="false">
                                                <div class="row">
                                                    <div class="col-3">
                                                        @lang('admin.order_management')
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="card">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <div class="form-body">
                                                                        <div class="row">

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.order_status')</label>
                                                                                    <div class="controls">
                                                                                        <select name="order_status" class="select2 form-control">
                                                                                            @foreach(\App\Enums\OrderStatus::getOptions() as $value => $label)
                                                                                                <option value="{{$value}}" {{old('order_status', $order->order_status?->value) == $value ? 'selected' : ''}}>{{$label}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.payment_status')</label>
                                                                                    <div class="controls">
                                                                                        <select name="payment_status" class="select2 form-control">
                                                                                            @foreach(\App\Enums\PaymentStatus::getOptions() as $value => $label)
                                                                                                <option value="{{$value}}" {{old('payment_status', $order->payment_status?->value) == $value ? 'selected' : ''}}>{{$label}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.payment_method')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="payment_method" class="form-control" value="{{old('payment_method', $order->payment_method)}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.payment_reference')</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="payment_reference" class="form-control" value="{{old('payment_reference', $order->payment_reference)}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.notes')</label>
                                                                                    <div class="controls">
                                                                                        <textarea name="notes" class="form-control" rows="3">{{old('notes', $order->notes)}}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.admin_notes')</label>
                                                                                    <div class="controls">
                                                                                        <textarea name="admin_notes" class="form-control" rows="3">{{old('admin_notes', $order->admin_notes)}}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.status')</label>
                                                                                    <div class="controls">
                                                                                        <select name="is_active" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                            <option value="1" {{old('is_active', $order->is_active) ? 'selected' : ''}}>@lang('admin.activate')</option>
                                                                                            <option value="0" {{!old('is_active', $order->is_active) ? 'selected' : ''}}>@lang('admin.dis_activate')</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label>@lang('admin.sort_order')</label>
                                                                                    <div class="controls">
                                                                                        <input type="number" name="sort_order" class="form-control" placeholder="@lang('admin.sort_order')" value="{{old('sort_order', $order->sort_order)}}" min="0">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12 d-flex justify-content-center mt-3">
                                                                                <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">@lang('admin.update')</button>
                                                                                <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">@lang('admin.back')</a>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                <!-- account setting page end -->
            </div>
        </section>
    </div>
</form>

@endsection
@section('js')
    <script src="{{ asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/scripts/forms/validation/form-validation.js') }}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js') }}"></script>

    {{-- show selected image script --}}
    @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit edit form script --}}
    @include('admin.shared.submitEditForm')
    {{-- submit edit form script --}}
@endsection