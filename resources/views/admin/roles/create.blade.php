@extends('admin.layout.master')
@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/core.css')}}">
@endsection
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h4 class="card-title">{{__('admin.add')}}</h4>
                    </div> --}}
                    <div class="card-content">
                        <div class="card-body">
                            <form class="card-body form validated-form" method="POST"
                                  action="{{route('admin.roles.store')}}" novalidate>
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.name_ar')}} </label>
                                            <div class="controls">
                                                <input type="text" value=""
                                                       name="name[ar]" class="form-control"
                                                       placeholder="{{__('admin.write') . __('admin.name_ar')}}"
                                                       required
                                                       data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.name_en')}} </label>
                                            <div class="controls">
                                                <input type="text" value=""
                                                       name="name[en]" class="form-control"
                                                       placeholder="{{__('admin.write') . __('admin.name_en')}}"
                                                       required
                                                       data-validation-required-message="{{__('admin.this_field_is_required')}}">
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($permissions as $title => $permission)
                                        <div class="col-xl-4 col-lg-6 mb-4 order-2 order-xl-0">
                                            <div class="card h-100">
                                                <div class="card-header d-flex justify-content-between">
                                                    <div class="card-title mb-4">
                                                        <h5 class="mb-0">@lang('admin.' . strtolower($title).'.index')
                                                            (@lang('admin.select_all'))</h5>
                                                    </div>
                                                    <label class="switch switch-success">
                                                        <input id="{{ strtolower($title) }}" type="checkbox"
                                                               class="switch-input ">
                                                        <div class="help-block"></div>
                                                        <span class="switch-toggle-slider">
                        <span class="switch-on"><i class="ti ti-check"></i></span>
                        <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                                                    </label>
                                                </div>
                                                <div class="card-body">
                                                    @foreach($permission as $key => $value)
                                                        <ul class="list-unstyled mb-0">
                                                            <li class="mb-1 d-flex justify-content-between w-100">
                                                                <p class="">@lang('admin.' . strtolower($title).'.'.$value['action'])</p>
                                                                <label class="switch switch-success">
                                                                    <input type="checkbox" name="permissions[]"
                                                                           class="switch-input {{ strtolower($title) }}"
                                                                           id="{{ $value['id'] }}"
                                                                           value="{{ $value['id'] }}"
                                                                           data-action="{{ $value['action'] }}">
                                                                    <div class="help-block"></div>
                                                                    <span class="switch-toggle-slider">
                                    <span class="switch-on"><i class="ti ti-check"></i></span>
                                    <span class="switch-off"><i class="ti ti-x"></i></span>
                                </span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="col-12 d-flex justify-content-center mt-3">
                                    <button type="submit"
                                            class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.update')}}</button>
                                    <a href="{{ url()->previous() }}" type="reset"
                                       class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script>
        $(document).ready(function() {
            // When "select all" switch is selected, select all permissions in the corresponding card
            $('.card-header .switch-input').on('change', function() {
                let isChecked = $(this).is(':checked');
                let card = $(this).closest('.card');
                card.find('.card-body .switch-input').prop('checked', isChecked).trigger('change');
            });

            // When any permission is selected, check if all permissions are selected to activate the "select all" switch
            $('.card-body .switch-input').on('change', function() {
                let card = $(this).closest('.card');
                let allChecked = true;
                card.find('.card-body .switch-input').each(function() {
                    if (!$(this).is(':checked')) {
                        allChecked = false;
                    }
                });
                card.find('.card-header .switch-input').prop('checked', allChecked);

                // When any permission in a card where data-action != "read-all" is selected, select the permission with data-action = "read-all"
                if ($(this).data('action') != 'read-all' && $(this).is(':checked')) {
                    card.find('.card-body .switch-input[data-action="read-all"]').prop('checked', true);
                }
            });
        });

    </script>
@endsection