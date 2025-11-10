@extends('admin.layout.master')

@section('title')
    @lang('admin.orders.show')
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('admin.orders.show') - #{{$order->id}}</h4>
                            <div class="card-tools">
                                <a href="{{route('admin.orders.edit', $order->id)}}" class="btn btn-warning">
                                    <i class="feather icon-edit"></i> @lang('admin.orders.edit')
                                </a>
                                <a href="{{route('admin.orders.index')}}" class="btn btn-secondary">
                                    <i class="feather icon-arrow-left"></i> @lang('admin.back')
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Order Summary -->
                                <div class="col-12">
                                    <div class="card border-info">
                                        <div class="card-header bg-info text-white">
                                            <h5 class="mb-0">@lang('admin.order_summary')</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>@lang('admin.order_status'):</strong>
                                                    <span class="badge {{$order->order_status?->getBadgeClass()}}">{{$order->order_status?->getLabel()}}</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>@lang('admin.payment_status'):</strong>
                                                    <span class="badge {{$order->payment_status?->getBadgeClass()}}">{{$order->payment_status?->getLabel()}}</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>@lang('admin.rental_days'):</strong>
                                                    <span class="badge badge-primary">{{$order->rental_days}} @lang('admin.days')</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>@lang('admin.total_amount'):</strong>
                                                    <span class="text-success h5">{{$order->formatted_total_amount}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Customer Information -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>@lang('admin.customer_information')</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>@lang('admin.full_name'):</strong></td>
                                                    <td>{{$order->full_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>@lang('admin.email'):</strong></td>
                                                    <td>{{$order->email}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>@lang('admin.phone'):</strong></td>
                                                    <td>{{$order->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>@lang('admin.customer_age'):</strong></td>
                                                    <td>{{$order->customer_age}} @lang('admin.years')</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>@lang('admin.customer_country'):</strong></td>
                                                    <td>{{$order->customerCountry->name ?? 'N/A'}}</td>
                                                </tr>
                                                @if($order->address)
                                                <tr>
                                                    <td><strong>@lang('admin.address'):</strong></td>
                                                    <td>{{$order->address}}</td>
                                                </tr>
                                                @endif
                                                @if($order->city)
                                                <tr>
                                                    <td><strong>@lang('admin.city_name'):</strong></td>
                                                    <td>{{$order->city->name ?? 'N/A'}}</td>
                                                </tr>
                                                @endif
                                                @if($order->country)
                                                <tr>
                                                    <td><strong>@lang('admin.country_name'):</strong></td>
                                                    <td>{{$order->country->name ?? 'N/A'}}</td>
                                                </tr>
                                                @endif
                                                @if($order->birthdate)
                                                <tr>
                                                    <td><strong>@lang('admin.birthdate'):</strong></td>
                                                    <td>{{$order->birthdate->format('Y-m-d')}}</td>
                                                </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Car Information -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>@lang('admin.car_information')</h5>
                                        </div>
                                        <div class="card-body">
                                            @if($order->car)
                                                <div class="text-center mb-3">
                                                    @if($order->car->image)
                                                        <img src="{{$order->car->image}}" alt="{{$order->car->name}}" class="img-thumbnail" style="max-width: 200px;">
                                                    @endif
                                                </div>
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td><strong>@lang('admin.name'):</strong></td>
                                                        <td>{{$order->car->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>@lang('admin.brand'):</strong></td>
                                                        <td>{{$order->car->brand}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>@lang('admin.model'):</strong></td>
                                                        <td>{{$order->car->model}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>@lang('admin.year'):</strong></td>
                                                        <td>{{$order->car->year}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>@lang('admin.seats'):</strong></td>
                                                        <td>{{$order->car->seats}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>@lang('admin.transmission'):</strong></td>
                                                        <td>{{$order->car->transmission}}</td>
                                                    </tr>
                                                </table>
                                            @else
                                                <p class="text-muted">@lang('admin.no_car_selected')</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Location Information -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>@lang('admin.location_information')</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>@lang('admin.pickup_location'):</strong></td>
                                                    <td>
                                                        @if($order->pickupLocation)
                                                            <span class="badge badge-info">{{$order->pickupLocation->name}}</span>
                                                            @if($order->pickupLocation->type == 'airport')
                                                                <span class="badge badge-warning">@lang('admin.airport')</span>
                                                            @endif
                                                        @elseif($order->pickup_address)
                                                            {{$order->pickup_address}}
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>@lang('admin.return_location'):</strong></td>
                                                    <td>
                                                        @if($order->same_return_location)
                                                            <span class="badge badge-success">@lang('admin.same_return_location')</span>
                                                        @elseif($order->returnLocation)
                                                            <span class="badge badge-info">{{$order->returnLocation->name}}</span>
                                                            @if($order->returnLocation->type == 'airport')
                                                                <span class="badge badge-warning">@lang('admin.airport')</span>
                                                            @endif
                                                        @elseif($order->return_address)
                                                            {{$order->return_address}}
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>@lang('admin.pickup_date'):</strong></td>
                                                    <td>{{$order->pickup_date ? $order->pickup_date->format('Y-m-d') : '-'}} {{$order->pickup_time}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>@lang('admin.return_date'):</strong></td>
                                                    <td>{{$order->return_date ? $order->return_date->format('Y-m-d') : '-'}} {{$order->return_time}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price Information -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>@lang('admin.price_information')</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                @if($order->pricePackage)
                                                <tr>
                                                    <td><strong>@lang('admin.price_packages'):</strong></td>
                                                    <td>{{$order->pricePackage->name}}</td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td><strong>@lang('admin.subtotal_amount'):</strong></td>
                                                    <td>{{$order->formatted_subtotal_amount}}</td>
                                                </tr>
                                                @if($order->fees)
                                                <tr>
                                                    <td><strong>@lang('admin.fees'):</strong></td>
                                                    <td>{{$order->formatted_fees}}</td>
                                                </tr>
                                                @endif
                                                @if($order->options->isNotEmpty())
                                                <tr>
                                                    <td><strong>@lang('admin.options_total'):</strong></td>
                                                    <td>{{$order->formatted_options_total}}</td>
                                                </tr>
                                                @endif
                                                @if($order->coupon_code)
                                                <tr>
                                                    <td><strong>@lang('admin.coupon_code'):</strong></td>
                                                    <td>{{$order->coupon_code}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>@lang('admin.coupon_discount_amount'):</strong></td>
                                                    <td class="text-danger">-{{$order->formatted_coupon_discount}}</td>
                                                </tr>
                                                @endif
                                                <tr class="border-top">
                                                    <td><strong>@lang('admin.total_amount'):</strong></td>
                                                    <td><strong class="text-success h5">{{$order->formatted_total_amount}}</strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Flight Information -->
                                @if($order->has_flight_info)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>@lang('admin.flight_information')</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @if($order->flight_arrival_date)
                                                <div class="col-md-6">
                                                    <h6>@lang('admin.flight_arrival')</h6>
                                                    <table class="table table-borderless table-sm">
                                                        <tr>
                                                            <td><strong>@lang('admin.flight_arrival_date'):</strong></td>
                                                            <td>{{$order->flight_arrival_date->format('Y-m-d')}} {{$order->flight_arrival_time}}</td>
                                                        </tr>
                                                        @if($order->flight_number_arrival)
                                                        <tr>
                                                            <td><strong>@lang('admin.flight_number_arrival'):</strong></td>
                                                            <td>{{$order->flight_number_arrival}}</td>
                                                        </tr>
                                                        @endif
                                                        @if($order->flight_airline_arrival)
                                                        <tr>
                                                            <td><strong>@lang('admin.flight_airline_arrival'):</strong></td>
                                                            <td>{{$order->flight_airline_arrival}}</td>
                                                        </tr>
                                                        @endif
                                                    </table>
                                                </div>
                                                @endif
                                                @if($order->flight_departure_date)
                                                <div class="col-md-6">
                                                    <h6>@lang('admin.flight_departure')</h6>
                                                    <table class="table table-borderless table-sm">
                                                        <tr>
                                                            <td><strong>@lang('admin.flight_departure_date'):</strong></td>
                                                            <td>{{$order->flight_departure_date->format('Y-m-d')}} {{$order->flight_departure_time}}</td>
                                                        </tr>
                                                        @if($order->flight_number_departure)
                                                        <tr>
                                                            <td><strong>@lang('admin.flight_number_departure'):</strong></td>
                                                            <td>{{$order->flight_number_departure}}</td>
                                                        </tr>
                                                        @endif
                                                        @if($order->flight_airline_departure)
                                                        <tr>
                                                            <td><strong>@lang('admin.flight_airline_departure'):</strong></td>
                                                            <td>{{$order->flight_airline_departure}}</td>
                                                        </tr>
                                                        @endif
                                                    </table>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Options -->
                                @if($order->options->isNotEmpty())
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>@lang('admin.selected_options')</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>@lang('admin.name')</th>
                                                            <th>@lang('admin.description')</th>
                                                            <th>@lang('admin.quantity')</th>
                                                            <th>@lang('admin.price')</th>
                                                            <th>@lang('admin.total_price')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($order->options as $option)
                                                        <tr>
                                                            <td>
                                                                @if($option->icon)
                                                                    <img src="{{$option->icon}}" alt="{{$option->name}}" class="img-thumbnail me-2" style="width: 30px; height: 30px;">
                                                                @endif
                                                                {{$option->name}}
                                                            </td>
                                                            <td>{{$option->description}}</td>
                                                            <td>{{$option->pivot->quantity}}</td>
                                                            <td>${{number_format($option->pivot->price, 2)}}</td>
                                                            <td>${{number_format($option->pivot->total_price, 2)}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Driver License & Documents -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>@lang('admin.driver_license_information')</h5>
                                        </div>
                                        <div class="card-body">
                                            @if($order->driver_license_number)
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>@lang('admin.driver_license_number'):</strong></td>
                                                    <td>{{$order->driver_license_number}}</td>
                                                </tr>
                                                @if($order->driver_license_expiration_date)
                                                <tr>
                                                    <td><strong>@lang('admin.driver_license_expiration_date'):</strong></td>
                                                    <td>{{$order->driver_license_expiration_date->format('Y-m-d')}}</td>
                                                </tr>
                                                @endif
                                            </table>
                                            @if($order->front_driver_license_image || $order->back_driver_license_image)
                                                <div class="mt-3">
                                                    @if($order->front_driver_license_image)
                                                        <div class="mb-3">
                                                            <strong>@lang('admin.front_driver_license_image'):</strong><br>
                                                            <img src="{{$order->front_driver_license_image}}" alt="Front Driver License" class="img-thumbnail" style="max-width: 300px;">
                                                        </div>
                                                    @endif
                                                    @if($order->back_driver_license_image)
                                                        <div>
                                                            <strong>@lang('admin.back_driver_license_image'):</strong><br>
                                                            <img src="{{$order->back_driver_license_image}}" alt="Back Driver License" class="img-thumbnail" style="max-width: 300px;">
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                            @else
                                                <p class="text-muted">@lang('admin.no_driver_license_info')</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- International Customer Information -->
                                @if($order->current_country_address || $order->passport_expiration_date || $order->passport_image)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>@lang('admin.international_customer_information')</h5>
                                        </div>
                                        <div class="card-body">
                                            @if($order->current_country_address)
                                            <div class="mb-3">
                                                <strong>@lang('admin.current_country_address'):</strong><br>
                                                {{$order->current_country_address}}
                                            </div>
                                            @endif
                                            @if($order->passport_expiration_date)
                                            <div class="mb-3">
                                                <strong>@lang('admin.passport_expiration_date'):</strong><br>
                                                {{$order->passport_expiration_date->format('Y-m-d')}}
                                            </div>
                                            @endif
                                            @if($order->passport_image)
                                            <div class="mb-3">
                                                <strong>@lang('admin.passport_image'):</strong><br>
                                                <img src="{{$order->passport_image}}" alt="Passport" class="img-thumbnail" style="max-width: 300px;">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Client Signature -->
                                @if($order->client_signature)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>@lang('admin.client_signature')</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="{{$order->client_signature}}" alt="Client Signature" class="img-thumbnail" style="max-width: 400px; border: 2px solid #007bff;">
                                                <p class="mt-2 text-muted"><small>@lang('admin.digital_signature_captured')</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Payment Information -->
                                @if($order->payment_method || $order->payment_reference)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>@lang('admin.payment_information')</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                @if($order->payment_method)
                                                <tr>
                                                    <td><strong>@lang('admin.payment_method'):</strong></td>
                                                    <td>{{$order->payment_method}}</td>
                                                </tr>
                                                @endif
                                                @if($order->payment_reference)
                                                <tr>
                                                    <td><strong>@lang('admin.payment_reference'):</strong></td>
                                                    <td>{{$order->payment_reference}}</td>
                                                </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Notes -->
                                @if($order->notes || $order->admin_notes)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>@lang('admin.notes')</h5>
                                        </div>
                                        <div class="card-body">
                                            @if($order->notes)
                                            <div class="mb-3">
                                                <strong>@lang('admin.customer_notes'):</strong><br>
                                                <div class="alert alert-info">{{$order->notes}}</div>
                                            </div>
                                            @endif
                                            @if($order->admin_notes)
                                            <div class="mb-3">
                                                <strong>@lang('admin.admin_notes'):</strong><br>
                                                <div class="alert alert-warning">{{$order->admin_notes}}</div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- Order Timestamps -->
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>@lang('admin.order_details')</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>@lang('admin.created_at'):</strong></td>
                                                    <td>{{$order->created_at->format('Y-m-d H:i:s')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>@lang('admin.updated_at'):</strong></td>
                                                    <td>{{$order->updated_at->format('Y-m-d H:i:s')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>@lang('admin.status'):</strong></td>
                                                    <td>
                                                        @if($order->is_active)
                                                            <span class="badge badge-success">@lang('admin.activate')</span>
                                                        @else
                                                            <span class="badge badge-danger">@lang('admin.dis_activate')</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
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
@endsection
