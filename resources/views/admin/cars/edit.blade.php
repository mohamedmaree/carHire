@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@endsection
{{-- extra css files --}}

@section('content')
<form method="POST" action="{{route('admin.cars.update', $car->id)}}" class="store form-horizontal" novalidate>

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
                                                    <div class="col-3 ">
                                                        @lang('admin.general_details')
                                                    </div>
                                                    <div class="col-9 ">
                                                        <div class="card">
                                                            <div class="card-content">
                                                                <div class="card-body">

                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-body">
                                                                        <div class="row">

                                                                            <div class="col-12">
                                                                                <div class="imgMontg col-12 text-center">
                                                                                        <div class="dropBox">
                                                                                            <div class="textCenter">
                                                                                                <div class="imagesUploadBlock">
                                                                                                    <label class="uploadImg">
                                                                                                        <span><i class="feather icon-image"></i></span>
                                                                                                        <input type="file" accept="image/*" name="image" class="imageUploader">
                                                                                                    </label>
                                                                                                    <div class="uploadedBlock">
                                                                                                        <img src="{{$car->image}}">
                                                                                                        <button class="close"><i class="la la-times"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="col-12">
                                                                                    <ul class="nav nav-tabs mb-3">
                                                                                        @foreach (languages() as $lang)
                                                                                            <li class="nav-item">
                                                                                                <a class="nav-link @if($loop->first) active @endif" data-toggle="pill" href="#first_{{$lang}}" aria-expanded="true">{{ __('admin.data') }} {{ $lang }}</a>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>

                                                                                <div class="tab-content">
                                                                                    @foreach (languages() as $lang)
                                                                                        <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif" id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                                                            <div class="col-md-12 col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                                                                    <div class="controls">
                                                                                                        <input type="text" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" value="{{ $car->getTranslation('name', $lang) }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-12 col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="first-name-column">{{__('admin.description')}} {{ $lang }}</label>
                                                                                                    <div class="controls">
                                                                                                        <textarea class="form-control" name="description[{{$lang}}]" cols="30" rows="5" placeholder="{{__('admin.write') . __('admin.description')}} {{ $lang }}">{{ $car->getTranslation('description', $lang) }}</textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.brand') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="brand"
                                                                                               class="form-control"
                                                                                               placeholder="{{ __('admin.brand') }}"
                                                                                               value="{{ $car->brand }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.model') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="model"
                                                                                               class="form-control"
                                                                                               placeholder="{{ __('admin.model') }}"
                                                                                               value="{{ $car->model }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.year') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="number" name="year"
                                                                                               class="form-control"
                                                                                               placeholder="{{ __('admin.year') }}"
                                                                                               value="{{ $car->year }}"
                                                                                               min="1900" max="{{ date('Y') + 1 }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.seats') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="number" name="seats"
                                                                                               class="form-control"
                                                                                               placeholder="{{ __('admin.seats') }}"
                                                                                               value="{{ $car->seats }}"
                                                                                               required
                                                                                               min="1" max="50"
                                                                                               data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.bags') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="number" name="bags"
                                                                                               class="form-control"
                                                                                               placeholder="{{ __('admin.bags') }}"
                                                                                               value="{{ $car->bags }}"
                                                                                               required
                                                                                               min="1" max="20"
                                                                                               data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.transmission') }}</label>
                                                                                    <div class="controls">
                                                                                        <select name="transmission"
                                                                                                class="select2 form-control"
                                                                                                required
                                                                                                data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                            <option value="">{{ __('admin.select') }}</option>
                                                                                            <option value="auto" {{ $car->transmission == 'auto' ? 'selected' : '' }}>{{ __('admin.auto') }}</option>
                                                                                            <option value="manual" {{ $car->transmission == 'manual' ? 'selected' : '' }}>{{ __('admin.manual') }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.fuel_type') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="fuel_type"
                                                                                               class="form-control"
                                                                                               placeholder="{{ __('admin.fuel_type') }}"
                                                                                               value="{{ $car->fuel_type }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.engine_size') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="number" name="engine_size"
                                                                                               class="form-control"
                                                                                               placeholder="{{ __('admin.engine_size') }}"
                                                                                               value="{{ $car->engine_size }}"
                                                                                               step="0.1" min="0.1" max="10.0">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.status') }}</label>
                                                                                    <div class="controls">
                                                                                        <select name="is_active"
                                                                                                class="select2 form-control"
                                                                                                required
                                                                                                data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                            <option value="1" {{ $car->is_active ? 'selected' : '' }}>{{ __('admin.activate') }}</option>
                                                                                            <option value="0" {{ !$car->is_active ? 'selected' : '' }}>{{ __('admin.dis_activate') }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12 d-flex justify-content-center mt-3">
                                                                                <button type="submit"
                                                                                        class="btn btn-primary mr-1 mb-1 submit_button">{{ __('admin.update') }}</button>
                                                                                <a href="{{ url()->previous() }}"
                                                                                   type="reset"
                                                                                   class="btn btn-outline-warning mr-1 mb-1">{{ __('admin.back') }}</a>
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
                                                                    <div id="price-packages-container">
                                                                        <div class="col-12">
                                                                            <ul class="nav nav-tabs mb-3">
                                                                                @foreach (languages() as $lang)
                                                                                    <li class="nav-item">
                                                                                        <a class="nav-link @if($loop->first) active @endif" data-toggle="pill" href="#price_package_{{$lang}}" aria-expanded="true">{{ __('admin.price_packages') }} {{ $lang }}</a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>

                                                                        <div class="tab-content">
                                                                            @foreach (languages() as $lang)
                                                                                <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif" id="price_package_{{$lang}}" aria-labelledby="price_package_{{$lang}}" aria-expanded="true">
                                                                                    @foreach($car->pricePackages as $index => $package)
                                                                                    <div class="price-package-item mb-3 p-3 border rounded">
                                                                                        <h5>{{ $package->getTranslation('name', $lang) }}</h5>
                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label>{{ __('admin.name') }} {{ $lang }}</label>
                                                                                                    <input type="text" name="price_packages[{{ $index }}][name][{{$lang}}]" class="form-control" value="{{ $package->getTranslation('name', $lang) }}" required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label>{{ __('admin.price') }}</label>
                                                                                                    <input type="number" name="price_packages[{{ $index }}][price]" class="form-control" step="0.01" min="0" value="{{ $package->price }}" required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label>{{ __('admin.kilometer_limit') }}</label>
                                                                                                    <input type="number" name="price_packages[{{ $index }}][kilometer_limit]" class="form-control" min="1" value="{{ $package->kilometer_limit }}" {{ $package->is_unlimited ? 'disabled' : '' }}>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label>{{ __('admin.description') }} {{ $lang }}</label>
                                                                                                    <input type="text" name="price_packages[{{ $index }}][description][{{$lang}}]" class="form-control" value="{{ $package->getTranslation('description', $lang) }}">
                                                                                                </div>
                                                                                            </div>
                                                                                            <input type="hidden" name="price_packages[{{ $index }}][is_unlimited]" value="{{ $package->is_unlimited ? 1 : 0 }}">
                                                                                            <input type="hidden" name="price_packages[{{ $index }}][is_active]" value="{{ $package->is_active ? 1 : 0 }}">
                                                                                            <input type="hidden" name="price_packages[{{ $index }}][sort_order]" value="{{ $package->sort_order }}">
                                                                                        </div>
                                                                                    </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-center mt-3">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.update')}}</button>
                                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
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
                                                                    <div class="col-12">
                                                                        <ul class="nav nav-tabs mb-3">
                                                                            @foreach (languages() as $lang)
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link @if($loop->first) active @endif" data-toggle="pill" href="#features_{{$lang}}" aria-expanded="true">{{ __('admin.features') }} {{ $lang }}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>

                                                                    <div class="tab-content">
                                                                        @foreach (languages() as $lang)
                                                                            <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif" id="features_{{$lang}}" aria-labelledby="features_{{$lang}}" aria-expanded="true">
                                                                                <div class="col-md-12 col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="features_{{ $lang }}">{{__('admin.features')}} {{ $lang }}</label>
                                                                                        <div class="controls">
                                                                                            @php
                                                                                                $features = $car->getTranslation('features', $lang);
                                                                                                $featuresText = is_array($features) ? implode(', ', $features) : ($features ?? '');
                                                                                            @endphp
                                                                                            <textarea class="form-control" name="features[{{$lang}}]" id="features_{{ $lang }}" cols="30" rows="5" placeholder="{{__('admin.write') . __('admin.features')}} {{ $lang }} ({{__('admin.separate_by_comma')}})">{{ $featuresText }}</textarea>
                                                                                            <small class="form-text text-muted">{{__('admin.features_help_text')}}</small>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-center mt-3">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.update')}}</button>
                                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
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

    {{-- submit update form script --}}
    @include('admin.shared.submitEditForm')
    {{-- submit update form script --}}
@endsection
