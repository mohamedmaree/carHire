@extends('admin.layout.master')

@section('content')
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
                                    <i class="feather icon-globe mr-50 font-medium-3"></i>
                                    @lang('admin.general_details')
                                </a>
                            </li>
                            <li class="nav-item" style="margin-top: 3px">
                                <a class="nav-link d-flex py-75" id="tab-pill-2" data-toggle="pill"
                                   href="#tab-2" aria-expanded="false">
                                    <i class="feather icon-dollar-sign mr-50 font-medium-3"></i>
                                    @lang('admin.price_packages')
                                </a>
                            </li>
                            <li class="nav-item" style="margin-top: 3px">
                                <a class="nav-link d-flex py-75" id="tab-pill-3" data-toggle="pill"
                                   href="#tab-3" aria-expanded="false">
                                    <i class="feather icon-star mr-50 font-medium-3"></i>
                                    @lang('admin.features')
                                </a>
                            </li>
                            <li class="nav-item" style="margin-top: 3px">
                                <a class="nav-link d-flex py-75" id="tab-pill-4" data-toggle="pill"
                                   href="#tab-4" aria-expanded="false">
                                    <i class="feather icon-image mr-50 font-medium-3"></i>
                                    @lang('admin.car_images')
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

                                        <div role="tabpanel" class="tab-pane active" id="tab-1"
                                             aria-labelledby="tab-pill-1" aria-expanded="true">
                                            <div class="row">
                                                <div class="col-3">
                                                    @lang('admin.general_details')
                                                </div>
                                                <div class="col-9">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.image_') }}</label>
                                                                            <div class="controls">
                                                                                <img src="{{ $car->image }}" alt="{{ $car->name }}" class="img-fluid" style="max-width: 200px;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.name') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $car->name }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.brand') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $car->brand ?? '-' }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.model') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $car->model ?? '-' }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.year') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $car->year ?? '-' }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.seats') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $car->seats }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.bags') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $car->bags }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.transmission') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $car->transmission_text }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.fuel_type') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $car->fuel_type ?? '-' }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.engine_size') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $car->engine_size ?? '-' }}L</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.status') }}</label>
                                                                            <div class="controls">
                                                                                @if ($car->is_active)
                                                                                    <span class="btn btn-sm round btn-outline-success">
                                                                                        {{ __('admin.activate') }} <i class="la la-check font-medium-2"></i>
                                                                                    </span>
                                                                                @else
                                                                                    <span class="btn btn-sm round btn-outline-danger">
                                                                                        {{ __('admin.dis_activate') }} <i class="la la-close font-medium-2"></i>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.description') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $car->description ?? '-' }}</p>
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

                                        <div role="tabpanel" class="tab-pane" id="tab-2" aria-labelledby="tab-pill-2" aria-expanded="false">
                                            <div class="row">
                                                <div class="col-3">
                                                    @lang('admin.price_packages')
                                                </div>
                                                <div class="col-9">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                @if($car->pricePackages->count() > 0)
                                                                    @foreach($car->pricePackages as $package)
                                                                    <div class="price-package-item mb-3 p-3 border rounded">
                                                                        <h5>{{ $package->name }}</h5>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>{{ __('admin.price') }}</label>
                                                                                    <p class="form-control-static">{{ $package->formatted_price }}</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>{{ __('admin.kilometer_limit') }}</label>
                                                                                    <p class="form-control-static">{{ $package->kilometer_limit_text }}</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label>{{ __('admin.description') }}</label>
                                                                                    <p class="form-control-static">{{ $package->description ?? '-' }}</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>{{ __('admin.status') }}</label>
                                                                                    <div class="controls">
                                                                                        @if ($package->is_active)
                                                                                            <span class="btn btn-sm round btn-outline-success">
                                                                                                {{ __('admin.activate') }} <i class="la la-check font-medium-2"></i>
                                                                                            </span>
                                                                                        @else
                                                                                            <span class="btn btn-sm round btn-outline-danger">
                                                                                                {{ __('admin.dis_activate') }} <i class="la la-close font-medium-2"></i>
                                                                                            </span>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                @else
                                                                    <div class="text-center">
                                                                        <p>{{ __('admin.no_price_packages_found') }}</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Features Tab -->
                                        <div role="tabpanel" class="tab-pane" id="tab-3" aria-labelledby="tab-pill-3" aria-expanded="false">
                                            <div class="row">
                                                <div class="col-3">
                                                    @lang('admin.features')
                                                </div>
                                                <div class="col-9">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                @if($car->features && count($car->features) > 0)
                                                                    <div class="row">
                                                                        @foreach (languages() as $lang)
                                                                            <div class="col-md-6 mb-3">
                                                                                <div class="form-group">
                                                                                    <label>{{ __('admin.features') }} {{ $lang }}</label>
                                                                                    <div class="controls">
                                                                                        @php
                                                                                            $features = $car->getTranslation('features', $lang);
                                                                                            $featuresArray = is_array($features) ? $features : [];
                                                                                        @endphp
                                                                                        @if(count($featuresArray) > 0)
                                                                                            <ul class="list-group">
                                                                                                @foreach($featuresArray as $feature)
                                                                                                    <li class="list-group-item d-flex align-items-center">
                                                                                                        <i class="feather icon-check-circle text-success mr-2"></i>
                                                                                                        {{ $feature }}
                                                                                                    </li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        @else
                                                                                            <p class="form-control-static text-muted">{{ __('admin.no_features_found') }}</p>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <div class="text-center">
                                                                        <p class="text-muted">{{ __('admin.no_features_found') }}</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Car Images Tab -->
                                        <div role="tabpanel" class="tab-pane" id="tab-4" aria-labelledby="tab-pill-4" aria-expanded="false">
                                            <div class="row">
                                                <div class="col-3">
                                                    @lang('admin.car_images')
                                                </div>
                                                <div class="col-9">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                @if($car->images->count() > 0)
                                                                    <div class="row">
                                                                        @foreach($car->images as $carImage)
                                                                            <div class="col-md-3 mb-3">
                                                                                <img src="{{ $carImage->image }}" alt="Car Image" class="img-thumbnail" style="width: 100%; height: 200px; object-fit: cover;">
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <div class="text-center">
                                                                        <p class="text-muted">{{ __('admin.no_images_found') }}</p>
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
                </div>
            </section>
            <!-- account setting page end -->
        </div>
    </section>
</div>

<div class="col-12 d-flex justify-content-center mt-3">
    <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-primary mr-1 mb-1">
        <i class="feather icon-edit"></i> {{ __('admin.edit') }}
    </a>
    <a href="{{ route('admin.cars.index') }}" class="btn btn-outline-warning mr-1 mb-1">
        <i class="feather icon-arrow-left"></i> {{ __('admin.back') }}
    </a>
</div>

@endsection
