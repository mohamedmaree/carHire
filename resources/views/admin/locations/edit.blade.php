@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@endsection
{{-- extra css files --}}

@section('content')
<form method="POST" action="{{route('admin.locations.update', $location->id)}}" class="store form-horizontal" novalidate>

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
                                                                                                        <input type="text" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" value="{{ $location->getTranslation('name', $lang) }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-12 col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="first-name-column">{{__('admin.address')}} {{ $lang }}</label>
                                                                                                    <div class="controls">
                                                                                                        <textarea class="form-control" name="address[{{$lang}}]" cols="30" rows="3" placeholder="{{__('admin.write') . __('admin.address')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">{{ $location->getTranslation('address', $lang) }}</textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.type') }}</label>
                                                                                    <div class="controls">
                                                                                        <select name="type" class="select2 form-control" required data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                            <option value="">{{ __('admin.select') }} {{ __('admin.type') }}</option>
                                                                                            <option value="airport" {{ $location->type == 'airport' ? 'selected' : '' }}>{{ __('admin.airport') }}</option>
                                                                                            <option value="location" {{ $location->type == 'location' ? 'selected' : '' }}>{{ __('admin.location_type') }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.lat') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="lat" class="form-control" placeholder="{{ __('admin.lat') }}" value="{{ $location->lat }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.lng') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="lng" class="form-control" placeholder="{{ __('admin.lng') }}" value="{{ $location->lng }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.working_hours') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="working_hours" class="form-control" placeholder="{{ __('admin.working_hours') }}" value="{{ $location->working_hours }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.holiday_hours') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="text" name="holiday_hours" class="form-control" placeholder="{{ __('admin.holiday_hours') }}" value="{{ $location->holiday_hours }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.working_days') }}</label>
                                                                                    <div class="controls">
                                                                                        <select name="working_days[]" class="select2 form-control" multiple>
                                                                                            <option value="monday" {{ in_array('monday', $location->working_days ?? []) ? 'selected' : '' }}>{{ __('admin.monday') }}</option>
                                                                                            <option value="tuesday" {{ in_array('tuesday', $location->working_days ?? []) ? 'selected' : '' }}>{{ __('admin.tuesday') }}</option>
                                                                                            <option value="wednesday" {{ in_array('wednesday', $location->working_days ?? []) ? 'selected' : '' }}>{{ __('admin.wednesday') }}</option>
                                                                                            <option value="thursday" {{ in_array('thursday', $location->working_days ?? []) ? 'selected' : '' }}>{{ __('admin.thursday') }}</option>
                                                                                            <option value="friday" {{ in_array('friday', $location->working_days ?? []) ? 'selected' : '' }}>{{ __('admin.friday') }}</option>
                                                                                            <option value="saturday" {{ in_array('saturday', $location->working_days ?? []) ? 'selected' : '' }}>{{ __('admin.saturday') }}</option>
                                                                                            <option value="sunday" {{ in_array('sunday', $location->working_days ?? []) ? 'selected' : '' }}>{{ __('admin.sunday') }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.holiday_days') }}</label>
                                                                                    <div class="controls">
                                                                                        <select name="holiday_days[]" class="select2 form-control" multiple>
                                                                                            <option value="monday" {{ in_array('monday', $location->holiday_days ?? []) ? 'selected' : '' }}>{{ __('admin.monday') }}</option>
                                                                                            <option value="tuesday" {{ in_array('tuesday', $location->holiday_days ?? []) ? 'selected' : '' }}>{{ __('admin.tuesday') }}</option>
                                                                                            <option value="wednesday" {{ in_array('wednesday', $location->holiday_days ?? []) ? 'selected' : '' }}>{{ __('admin.wednesday') }}</option>
                                                                                            <option value="thursday" {{ in_array('thursday', $location->holiday_days ?? []) ? 'selected' : '' }}>{{ __('admin.thursday') }}</option>
                                                                                            <option value="friday" {{ in_array('friday', $location->holiday_days ?? []) ? 'selected' : '' }}>{{ __('admin.friday') }}</option>
                                                                                            <option value="saturday" {{ in_array('saturday', $location->holiday_days ?? []) ? 'selected' : '' }}>{{ __('admin.saturday') }}</option>
                                                                                            <option value="sunday" {{ in_array('sunday', $location->holiday_days ?? []) ? 'selected' : '' }}>{{ __('admin.sunday') }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.sort_order') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="number" name="sort_order" class="form-control" value="{{ $location->sort_order }}" placeholder="{{ __('admin.sort_order') }}" min="0">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.status') }}</label>
                                                                                    <div class="controls">
                                                                                        <select name="is_active" class="select2 form-control" required data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                            <option value="1" {{ $location->is_active == 1 ? 'selected' : '' }}>{{ __('admin.activate') }}</option>
                                                                                            <option value="0" {{ $location->is_active == 0 ? 'selected' : '' }}>{{ __('admin.dis_activate') }}</option>
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

    {{-- submit edit form script --}}
    @include('admin.shared.submitEditForm')
    {{-- submit edit form script --}}
@endsection