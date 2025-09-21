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
<form method="POST" action="{{route('admin.modelKebabPluralName.store')}}" class="store form-horizontal" novalidate>

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
                                        @lang('site.general_details')
                                    </a>
                                </li>
                                <li class="nav-item" style="margin-top: 3px">
                                    <a class="nav-link d-flex py-75" id="tab-pill-2" data-toggle="pill"
                                       href="#tab-2" aria-expanded="false">
                                        <i class="feather icon-edit mr-50 font-medium-3"></i>
                                      sample 2
                                    </a>
                                </li>
                                <li class="nav-item" style="margin-top: 3px">
                                    <a class="nav-link d-flex py-75" id="tab-pill-3" data-toggle="pill"
                                       href="#tab-3" aria-expanded="false">
                                        <i class="feather icon-file mr-50 font-medium-3"></i>
                                        sample 3
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
                                                            {{-- <div class="card-header">
                                                                <h4 class="card-title">{{__('admin.add') . ' ' . __('admin.copy')}}</h4>
                                                            </div> --}}
                                                            <div class="card-content">
                                                                <div class="card-body">

                                                                        @csrf
                                                                        <div class="form-body">
                                                                            <div class="row">

                                                                                {{-- to create languages tabs uncomment that --}}
                                                                                {{-- <div class="col-12">
                                                                                    <div class="col-12">
                                                                                        <ul class="nav nav-tabs  mb-3">
                                                                                                @foreach (languages() as $lang)
                                                                                                    <li class="nav-item">
                                                                                                        <a class="nav-link @if($loop->first) active @endif"  data-toggle="pill" href="#first_{{$lang}}" aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                                                                    </li>
                                                                                                @endforeach
                                                                                        </ul>
                                                                                    </div>  --}}

                                                                                <div class="col-12">
                                                                                    <div class="imgMontg col-12 text-center">
                                                                                        <div class="dropBox">
                                                                                            <div class="textCenter">
                                                                                                <div class="imagesUploadBlock">
                                                                                                    <label class="uploadImg">
                                                                                                        <span><i class="feather icon-image"></i></span>
                                                                                                        <input type="file"
                                                                                                               accept="image/*"
                                                                                                               name="image"
                                                                                                               class="imageUploader">
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                {{-- to create languages tabs uncomment that --}}
                                                                                {{--    <div class="tab-content">
                                                                                            @foreach (languages() as $lang)
                                                                                                <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                                                                    <div class="col-md-12 col-12">
                                                                                                        <div class="form-group">
                                                                                                            <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                                                                            <div class="controls">
                                                                                                                <input type="text" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div> --}}

                                                                                <div class="col-md-12 col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-column">{{ __('admin.name') }}</label>
                                                                                        <div class="controls">
                                                                                            <input type="text" name="name"
                                                                                                   class="form-control"
                                                                                                   placeholder="{{ __('admin.name') }}"
                                                                                                   required
                                                                                                   data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12 col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-column">{{ __('admin.phone') }}</label>
                                                                                        <div class="controls">
                                                                                            <input type="number" name="phone"
                                                                                                   class="form-control"
                                                                                                   placeholder="{{ __('admin.phone') }}"
                                                                                                   required
                                                                                                   data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12 col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-column">{{ __('admin.email') }}</label>
                                                                                        <div class="controls">
                                                                                            <input type="email" name="email"
                                                                                                   class="form-control"
                                                                                                   placeholder="{{ __('admin.email') }}"
                                                                                                   required
                                                                                                   data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12 col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-column">{{ __('admin.password') }}</label>
                                                                                        <div class="controls">
                                                                                            <input type="password"
                                                                                                   name="password"
                                                                                                   class="form-control"
                                                                                                   required
                                                                                                   data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <div class="controls">
                                                                                            <label for="account-name">{{ __('admin.about_app') }}</label>
                                                                                            <textarea class="form-control"
                                                                                                      name="intro_about" id=""
                                                                                                      cols="30" rows="10"
                                                                                                      placeholder="{{ __('admin.about_app') }}"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12 col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-column">{{ __('admin.ban_status') }}</label>
                                                                                        <div class="controls">
                                                                                            <select name="block"
                                                                                                    class="select2 form-control"
                                                                                                    required
                                                                                                    data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                                <option value="1">{{ __('admin.Prohibited') }}</option>
                                                                                                <option value="0">{{ __('admin.Unspoken') }}</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                {{-- <div class="col-md-12 col-12">
                                                                                <div class="form-group">
                                                                                    <label for="first-name-column">{{__('admin.Validity')}}</label>
                                                                                    <div class="controls">
                                                                                        <select name="role_id" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                                            @foreach ($roles as $role)
                                                                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div> --}}

                                                                                {{--  to create languages tabs uncomment that --}}
                                                                                {{-- </div> --}}


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

                                            <div role="tabpanel" class="tab-pane" id="tab-2" aria-labelledby="tab-pill-2" aria-expanded="false">
                                                <div class="row">
                                                    <div class="col-3   ">
                                                        sample 2
                                                    </div>
                                                    <div class="col-9 ">
                                                       2
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-center mt-3">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.add')}}</button>
                                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="tab-3" aria-labelledby="tab-pill-3" aria-expanded="false">
                                                <div class="row">
                                                    <div class="col-3   ">
                                                        sample 3
                                                    </div>
                                                    <div class="col-9 ">
                                                        3
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-center mt-3">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.add')}}</button>
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

    {{-- submit add form script --}}
    @include('admin.shared.submitAddForm')
    {{-- submit add form script --}}
@endsection
