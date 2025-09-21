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
<form method="POST" action="{{route('admin.price-packages.store')}}" class="store form-horizontal" novalidate>

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
                                                                                                        <input type="text" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-12 col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="first-name-column">{{__('admin.description')}} {{ $lang }}</label>
                                                                                                    <div class="controls">
                                                                                                        <textarea class="form-control" name="description[{{$lang}}]" cols="30" rows="3" placeholder="{{__('admin.write') . __('admin.description')}} {{ $lang }}"></textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.car') }}</label>
                                                                                    <div class="controls">
                                                                                        <select name="car_id"
                                                                                                class="select2 form-control"
                                                                                                required
                                                                                                data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                            <option value="">{{ __('admin.select') }}</option>
                                                                                            @foreach($cars as $car)
                                                                                                <option value="{{ $car->id }}">{{ $car->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.price') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="number" name="price"
                                                                                               class="form-control"
                                                                                               placeholder="{{ __('admin.price') }}"
                                                                                               step="0.01" min="0"
                                                                                               required
                                                                                               data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.kilometer_type') }}</label>
                                                                                    <div class="controls">
                                                                                        <select name="is_unlimited"
                                                                                                class="select2 form-control"
                                                                                                required
                                                                                                data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                            <option value="">{{ __('admin.select') }}</option>
                                                                                            <option value="0">{{ __('admin.limited') }}</option>
                                                                                            <option value="1">{{ __('admin.unlimited') }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group" id="kilometer_limit_group">
                                                                                    <label for="first-name-column">{{ __('admin.kilometer_limit') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="number" name="kilometer_limit"
                                                                                               class="form-control"
                                                                                               placeholder="{{ __('admin.kilometer_limit') }}"
                                                                                               min="1">
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
                                                                                            <option value="1">{{ __('admin.activate') }}</option>
                                                                                            <option value="0">{{ __('admin.dis_activate') }}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{ __('admin.sort_order') }}</label>
                                                                                    <div class="controls">
                                                                                        <input type="number" name="sort_order"
                                                                                               class="form-control"
                                                                                               placeholder="{{ __('admin.sort_order') }}"
                                                                                               value="0" min="0">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12 d-flex justify-content-center mt-3">
                                                                                <button type="submit"
                                                                                        class="btn btn-primary mr-1 mb-1 submit_button">{{ __('admin.add') }}</button>
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

    <script>
        $(document).ready(function() {
            // Show/hide kilometer limit based on unlimited selection
            $('select[name="is_unlimited"]').change(function() {
                if ($(this).val() == '1') {
                    $('#kilometer_limit_group').hide();
                    $('input[name="kilometer_limit"]').val('');
                } else {
                    $('#kilometer_limit_group').show();
                }
            });
            
            // Initialize on page load
            $('select[name="is_unlimited"]').trigger('change');
        });
    </script>

    {{-- submit add form script --}}
    @include('admin.shared.submitAddForm')
    {{-- submit add form script --}}
@endsection
