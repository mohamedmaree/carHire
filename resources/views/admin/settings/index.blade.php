@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css') }}">
    <style>
        #contact_address_search {
            background-color: #fff;
            font-size: 15px;
            font-weight: 300;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 100%;
            height: 40px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        #contact_address_search:focus {
            border-color: #4d90fe;
            outline: none;
        }
        .pac-container {
            z-index: 9999999;
        }
        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }
        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }
    </style>
@endsection
{{-- extra css files --}}
@section('content')

    <div class="content-body">
        <!-- account setting page start -->
        <section id="page-account-settings">
            <div class="row">
                <!-- left menu section -->
                <div class="col-md-3 mb-2 mb-md-0 ">
                    <ul class="nav nav-pills flex-column mt-md-0 mt-1 card card-body">

                        <li class="nav-item">
                            <a class="nav-link d-flex py-75 active" id="account-pill-main" data-toggle="pill"
                               href="#account-vertical-main" aria-expanded="true">
                                <i class="feather icon-settings mr-50 font-medium-3"></i>
                                {{__('admin.app_setting')}}
                            </a>
                        </li>
                        <li class="nav-item" style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-language" data-toggle="pill"
                               href="#account-vertical-language" aria-expanded="true">
                                <i class="feather icon-settings mr-50 font-medium-3"></i>
                                {{__('admin.language_setting')}}
                            </a>
                        </li>
                        <li class="nav-item" style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-countries" data-toggle="pill"
                               href="#account-vertical-countries" aria-expanded="true">
                                <i class="feather icon-settings mr-50 font-medium-3"></i>
                                {{__('admin.countries_currencies')}}
                            </a>
                        </li>
                        <li class="nav-item" style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-terms" data-toggle="pill"
                               href="#account-vertical-terms" aria-expanded="false">
                                <i class="feather icon-edit-1 mr-50 font-medium-3"></i>
                                {{__('admin.terms_and_conditions')}}
                            </a>
                        </li>
                        <li class="nav-item" style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-social" data-toggle="pill"
                               href="#account-vertical-social" aria-expanded="false">
                                <i class="feather icon-edit-1 mr-50 font-medium-3"></i>
                                {{__('admin.social_media')}}
                            </a>
                        </li>
                        <li class="nav-item " style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-about" data-toggle="pill"
                               href="#account-vertical-about" aria-expanded="false">
                                <i class="feather icon-edit-1 mr-50 font-medium-3"></i>
                                {{__('admin.about_app')}}
                            </a>
                        </li>
                        <li class="nav-item " style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-our-location" data-toggle="pill"
                               href="#account-vertical-our-location" aria-expanded="false">
                                <i class="feather icon-map-pin mr-50 font-medium-3"></i>
                                {{__('admin.our_location')}}
                            </a>
                        </li>
                        <li class="nav-item " style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-privacy" data-toggle="pill"
                               href="#account-vertical-privacy" aria-expanded="false">
                                <i class="feather icon-award mr-50 font-medium-3"></i>
                                {{__('admin.Privacy_policy')}}
                            </a>
                        </li>
                        <li class="nav-item " style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-contact" data-toggle="pill"
                               href="#account-vertical-contact" aria-expanded="false">
                                <i class="feather icon-map-pin mr-50 font-medium-3"></i>
                                {{__('admin.contact_information')}}
                            </a>
                        </li>
                        <li class="nav-item " style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-facts" data-toggle="pill"
                               href="#account-vertical-facts" aria-expanded="false">
                                <i class="feather icon-bar-chart-2 mr-50 font-medium-3"></i>
                                {{__('admin.facts_by_numbers')}}
                            </a>
                        </li>
                        <li class="nav-item " style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-app-download" data-toggle="pill"
                               href="#account-vertical-app-download" aria-expanded="false">
                                <i class="feather icon-smartphone mr-50 font-medium-3"></i>
                                {{__('admin.app_download')}}
                            </a>
                        </li>
                        <li class="nav-item " style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-home-sections" data-toggle="pill"
                               href="#account-vertical-home-sections" aria-expanded="false">
                                <i class="feather icon-layout mr-50 font-medium-3"></i>
                                {{__('admin.home_sections')}}
                            </a>
                        </li>
                        <li class="nav-item " style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-smtp" data-toggle="pill"
                               href="#account-vertical-smtp" aria-expanded="false">
                                <i class="feather icon-mail mr-50 font-medium-3"></i>
                                {{__('admin.email_data')}}
                            </a>
                        </li>
                        {{-- <li class="nav-item " style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                                <i class="feather icon-bell mr-50 font-medium-3"></i>
                                {{__('admin.notification_data')}}
                            </a>
                        </li> --}}
                        <li class="nav-item " style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-api" data-toggle="pill"
                               href="#account-vertical-api" aria-expanded="false">
                                <i class="feather icon-droplet mr-50 font-medium-3"></i>
                                {{__('admin.api_data')}}
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

                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-main"
                                         aria-labelledby="account-pill-main" aria-expanded="true">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data" class="form-horizontal" novalidate>
                                            @method('put')
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.the_name_of_the_application_in_arabic')}}</label>
                                                            <input type="text" class="form-control" name="name_ar"
                                                                   id="account-name"
                                                                   placeholder="{{__('admin.the_name_of_the_application_in_arabic')}}"
                                                                   value="{{$data['name_ar']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.the_name_of_the_application_in_english')}}</label>
                                                            <input type="text" class="form-control" name="name_en"
                                                                   id="account-name"
                                                                   placeholder="{{__('admin.the_name_of_the_application_in_english')}}"
                                                                   value="{{$data['name_en']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="tagline-ar">{{__('admin.tagline')}} ({{__('admin.ar')}})</label>
                                                            <input type="text" class="form-control" name="tagline_ar"
                                                                   id="tagline-ar"
                                                                   placeholder="{{__('admin.tagline')}} ({{__('admin.ar')}})"
                                                                   value="{{$data['tagline_ar'] ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="tagline-en">{{__('admin.tagline')}} ({{__('admin.en')}})</label>
                                                            <input type="text" class="form-control" name="tagline_en"
                                                                   id="tagline-en"
                                                                   placeholder="{{__('admin.tagline')}} ({{__('admin.en')}})"
                                                                   value="{{$data['tagline_en'] ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.email')}}</label>
                                                            <input type="email" class="form-control" name="email"
                                                                   id="account-name" placeholder="{{__('admin.email')}}"
                                                                   value="{{$data['email']}}"
                                                                   data-validation-email-message="{{__('admin.verify_the_email_format')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{__('admin.phone_number')}}</label>
                                                        <div class="row">
                                                            <div class="col-md-9 col-12">
                                                                <div class="controls">
                                                                    <input type="number" name="phone"
                                                                           value="{{$data['phone']}}"
                                                                           class="form-control"
                                                                           placeholder="{{__('admin.enter_phone_number')}}"
                                                                           required
                                                                           data-validation-required-message="{{__('admin.this_field_is_required')}}"
                                                                           data-validation-number-message="{{__('admin.the_phone_number_ must_not_have_charachters_or_symbol')}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-12">
                                                                <select name="country_code"
                                                                        class="form-control select2">
                                                                    @foreach($countries as $country)
                                                                        <option value="{{ $country->key }}"
                                                                                @if ($data['country_code'] == $country->key)
                                                                                    selected
                                                                                @endif >
                                                                            {{ $country->key.'+' }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">{{__('admin.whatts_app_number')}}</label>
                                                        <div class="row">
                                                            <div class="col-md-9 col-12">
                                                                <div class="controls">
                                                                    <input type="number" name="whatsapp"
                                                                           value="{{$data['whatsapp']}}"
                                                                           class="form-control"
                                                                           placeholder="{{__('admin.whatts_app_number')}}"
                                                                           required
                                                                           data-validation-required-message="{{__('admin.this_field_is_required')}}"
                                                                           data-validation-number-message="{{__('admin.the_phone_number_ must_not_have_charachters_or_symbol')}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-12">
                                                                <select name="whatsapp_country_code"
                                                                        class="form-control select2">
                                                                    @foreach($countries as $country)
                                                                        <option value="{{ $country->key }}"
                                                                                @if ($data['whatsapp_country_code'] == $country->key)
                                                                                    selected
                                                                                @endif >
                                                                            {{ $country->key.'+' }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="account-name">is production </label>
                                                        <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                            <input name="is_production"
                                                                   {{$data['is_production']  == '1' ? 'checked' : ''}}   type="checkbox"
                                                                   class="custom-control-input" id="customSwitch11">
                                                            <label class="custom-control-label" for="customSwitch11">
                                                                <span class="switch-icon-left"><i
                                                                            class="feather icon-check"></i></span>
                                                                <span class="switch-icon-right"><i
                                                                            class="feather icon-check"></i></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">

                                                        <div class="imgMontg col-12 col-lg-4 col-md-12 text-center">
                                                            <div class="dropBox">
                                                                <div class="textCenter d-flex flex-column">
                                                                    <div class="imagesUploadBlock">
                                                                        <label class="uploadImg">
                                                                            <span><i class="feather icon-image"></i></span>
                                                                            <input type="file" accept="image/*"
                                                                                   name="logo" class="imageUploader">
                                                                        </label>
                                                                        <div class="uploadedBlock">
                                                                            <img src="{{$data['logo']}}">
                                                                            <button class="close"><i
                                                                                        class="feather icon-trash-2"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <span>{{__('admin.logo_image')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="imgMontg col-12 col-lg-4 col-md-12 text-center">
                                                            <div class="dropBox">
                                                                <div class="textCenter d-flex flex-column">
                                                                    <div class="imagesUploadBlock">
                                                                        <label class="uploadImg">
                                                                            <span><i class="feather icon-image"></i></span>
                                                                            <input type="file" accept="image/*"
                                                                                   name="side_logo"
                                                                                   class="imageUploader">
                                                                        </label>
                                                                        <div class="uploadedBlock">
                                                                            <img src="{{$data['side_logo']}}">
                                                                            <button class="close"><i
                                                                                        class="feather icon-trash-2"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <span>{{__('admin.side_logo_image')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="imgMontg col-12 col-lg-4 col-md-12 text-center">
                                                            <div class="dropBox">
                                                                <div class="textCenter d-flex flex-column">
                                                                    <div class="imagesUploadBlock">
                                                                        <label class="uploadImg">
                                                                            <span><i class="feather icon-image"></i></span>
                                                                            <input type="file" accept="image/*"
                                                                                   name="fav_icon"
                                                                                   class="imageUploader">
                                                                        </label>
                                                                        <div class="uploadedBlock">
                                                                            <img src="{{$data['fav_icon']}}">
                                                                            <button class="close"><i
                                                                                        class="feather icon-trash-2"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <span>{{__('admin.fav_icon_image')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="imgMontg col-12 col-lg-4 col-md-12 text-center">
                                                            <div class="dropBox">
                                                                <div class="textCenter d-flex flex-column">
                                                                    <div class="imagesUploadBlock">
                                                                        <label class="uploadImg">
                                                                            <span><i class="feather icon-image"></i></span>
                                                                            <input type="file" accept="image/*" name="login_background" class="imageUploader">
                                                                        </label>
                                                                        <div class="uploadedBlock">
                                                                            <img src="{{$data['login_background']}}">
                                                                            <button class="close"><i class="feather icon-trash-2"></i></button>
                                                                        </div>
                                                                      </div>
                                                                      <span>{{__('admin.background_image')}}</span>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="imgMontg col-12 col-lg-4 col-md-12 text-center">
                                                            <div class="dropBox">
                                                                <div class="textCenter d-flex flex-column">
                                                                    <div class="imagesUploadBlock">
                                                                        <label class="uploadImg">
                                                                            <span><i class="feather icon-image"></i></span>
                                                                            <input type="file" accept="image/*"
                                                                                   name="default_user"
                                                                                   class="imageUploader">
                                                                        </label>
                                                                        <div class="uploadedBlock">
                                                                            <img src="{{$data['default_user']}}">
                                                                            <button class="close"><i
                                                                                        class="feather icon-trash-2"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <span>{{__('admin.virtual_user_image')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="imgMontg col-12 col-lg-4 col-md-12 text-center">
                                                            <div class="dropBox">
                                                                <div class="textCenter d-flex flex-column">
                                                                    <div class="imagesUploadBlock">
                                                                        <label class="uploadImg">
                                                                            <span><i class="feather icon-image"></i></span>
                                                                            <input type="file" accept="image/*"
                                                                                   name="profile_cover"
                                                                                   class="imageUploader">
                                                                        </label>
                                                                        <div class="uploadedBlock">
                                                                            <img src="{{$data['profile_cover']}}">
                                                                            <button class="close"><i
                                                                                        class="feather icon-trash-2"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <span>{{__('admin.profile_cover')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 mt-4">
                                                    <h5 class="mb-3">{{__('admin.home_banner_images')}}</h5>
                                                    <div class="row">
                                                        <div class="imgMontg col-12 col-lg-4 col-md-12 text-center">
                                                            <div class="dropBox">
                                                                <div class="textCenter d-flex flex-column">
                                                                    <div class="imagesUploadBlock">
                                                                        <label class="uploadImg">
                                                                            <span><i class="feather icon-image"></i></span>
                                                                            <input type="file" accept="image/*"
                                                                                   name="home_banner_1"
                                                                                   class="imageUploader">
                                                                        </label>
                                                                        <div class="uploadedBlock">
                                                                            <img src="{{$data['home_banner_1'] ?? ''}}">
                                                                            <button class="close"><i
                                                                                        class="feather icon-trash-2"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <span>{{__('admin.home_banner')}} 1</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="imgMontg col-12 col-lg-4 col-md-12 text-center">
                                                            <div class="dropBox">
                                                                <div class="textCenter d-flex flex-column">
                                                                    <div class="imagesUploadBlock">
                                                                        <label class="uploadImg">
                                                                            <span><i class="feather icon-image"></i></span>
                                                                            <input type="file" accept="image/*"
                                                                                   name="home_banner_2"
                                                                                   class="imageUploader">
                                                                        </label>
                                                                        <div class="uploadedBlock">
                                                                            <img src="{{$data['home_banner_2'] ?? ''}}">
                                                                            <button class="close"><i
                                                                                        class="feather icon-trash-2"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <span>{{__('admin.home_banner')}} 2</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit"
                                                            class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset"
                                                       class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                    <div role="tabpanel" class="tab-pane" id="account-vertical-language"
                                         aria-labelledby="account-pill-language" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="row">

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.supported_languages')}}</label>
                                                            <select name="locales[]" class="form-control select2"
                                                                    multiple="">
                                                                @foreach (config('available-locales') as $key => $language)
                                                                    <option value="{{ $key }}"
                                                                            @if (in_array($key,json_decode($data['locales'])))
                                                                                selected
                                                                            @endif >
                                                                        {{ $language['native'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.rtl_languages')}}</label>
                                                            <select name="rtl_locales[]" class="form-control select2"
                                                                    multiple="">
                                                                @foreach (config('available-locales') as $key => $language)
                                                                    <option value="{{ $key }}"
                                                                            @if (in_array($key,json_decode($data['rtl_locales'])))
                                                                                selected
                                                                            @endif>
                                                                        {{ $language['native'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.default_language')}}</label>
                                                            <select name="default_locale" class="form-control select2">
                                                                @foreach (config('available-locales') as $key => $language)
                                                                    <option value="{{ $key }}"
                                                                            @if ($data['default_locale'] == $key)
                                                                                selected
                                                                            @endif>
                                                                        {{ $language['native'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit"
                                                            class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset"
                                                       class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-countries"
                                         aria-labelledby="account-pill-countries" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="row">

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.supported_countries')}}</label>
                                                            <select name="countries[]" class="form-control select2"
                                                                    multiple="">
                                                                @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}"
                                                                            @if (in_array($country->id,json_decode($data['countries'])))
                                                                                selected
                                                                            @endif >
                                                                        {{ $country->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.default_country')}}</label>
                                                            <select name="default_country" class="form-control select2">
                                                                @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}"
                                                                            @if ($data['default_country'] == $country->id)
                                                                                selected
                                                                            @endif>
                                                                        {{ $country->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.supported_currencies')}}</label>
                                                            <select name="currencies[]" class="form-control select2"
                                                                    multiple="">
                                                                @foreach ($countries as $country)
                                                                    <option value="{{ $country->currency }}"
                                                                            @if (in_array($country->currency,json_decode($data['currencies'])))
                                                                                selected
                                                                            @endif >
                                                                        {{ $country->currency }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.default_currency')}}</label>
                                                            <select name="default_currency"
                                                                    class="form-control select2">
                                                                @foreach ($countries as $country)
                                                                    <option value="{{ $country->currency }}"
                                                                            @if ($data['default_currency'] == $country->currency)
                                                                                selected
                                                                            @endif>
                                                                        {{ $country->currency }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit"
                                                            class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset"
                                                       class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-terms"
                                         aria-labelledby="account-pill-terms" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="row">

                                                <div class="col-12">
                                                    <ul class="nav nav-tabs  mb-3">
                                                        @foreach (languages() as $lang)
                                                            <li class="nav-item">
                                                                <a class="nav-link @if($loop->first) active @endif"
                                                                   data-toggle="pill" href="#first_{{$lang}}"
                                                                   aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                <div class="tab-content">
                                                    @foreach (languages() as $lang)
                                                        <div role="tabpanel"
                                                             class="tab-pane fade @if($loop->first) show active @endif "
                                                             id="first_{{$lang}}" aria-labelledby="first_{{$lang}}"
                                                             aria-expanded="true">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label for="account-name">{{__('admin.conditions_and_conditions')}} {{ $lang  }}</label>
                                                                        <textarea class="form-control"
                                                                                  name="terms_{{ $lang }}"
                                                                                  id="terms_{{ $lang }}_editor"
                                                                                  cols="30" rows="10"
                                                                                  placeholder="{{__('admin.conditions_and_conditions')}} {{ $lang }}">{{$data['terms_'.$lang]??''}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit"
                                                            class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset"
                                                       class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-social"
                                         aria-labelledby="account-pill-social" aria-expanded="false">
                                        <form action="{{route('admin.settings.update-socials')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div id="social_info" class="checkout-form-list">
                                                        <div id="socials_container">
                                                            @if( $data['socials'] ??   false)
                                                                @foreach( $data['socials'] as $key => $social)
                                                                    <div class="social_info_add cta-form social-group">
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-md-12">
                                                                                <div class="imgMontg  text-center">
                                                                                    <div class="dropBox">
                                                                                        <div class="textCenter d-flex flex-column">
                                                                                            <div class="imagesUploadBlock">
                                                                                                <label class="uploadImg">
                                                                                                    <span><i class="feather icon-image"></i></span>
                                                                                                    <input type="file" accept="image/*" name="socials[{{$key}}][image]" class="imageUploader">
                                                                                                </label>
                                                                                                <div class="uploadedBlock">
                                                                                                    <input type="hidden" name="socials[{{$key}}][image]" value="{{@$social->image}}">
                                                                                                    <img src="{{@( url('/') .'/'. $social->image) ?? ''}}">
                                                                                                    <button class="close"> <i class="feather icon-trash-2"></i></button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <span>{{__('admin.side_logo_image')}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-12">

                                                                                <div class="form-group mt-10">
                                                                                    <label for="first-name-column">{{__('admin.name')}}</label>
                                                                                    <input type="text" value="{{$social->name}}" name="socials[{{$key}}][name]" placeholder="@lang('admin.social_name')" class="form-control social-name">
                                                                                </div>


                                                                                <div class="form-group mt-10">
                                                                                    <label for="first-name-column">{{__('admin.Link')}}</label>
                                                                                    <input type="url"  name="socials[{{$key}}][url]" value="{{$social->url}}" placeholder="@lang('admin.social_url')" class="form-control social-url">
                                                                                </div>

                                                                            </div>


                                                                        </div>
                                                                        <div class="col-12 d-flex justify-content-center mt-3">
                                                                            <button type="button" class="btn btn-danger removeSocialButton" onclick="removeSocial(this)"> @lang('site.delete') <i class="feather icon-trash-2"></i></button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <button type="button" id="addSocialButton" class="btn btn-success " onclick="addSocial()"> @lang('admin.add_social_media') <i class="feather icon-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-center mt-3">
                                                <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-about"
                                         aria-labelledby="account-pill-about" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            
                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="nav nav-tabs mb-3">
                                                        @foreach (languages() as $lang)
                                                            <li class="nav-item">
                                                                <a class="nav-link @if($loop->first) active @endif"
                                                                   data-toggle="pill" href="#about_lang_{{$lang}}"
                                                                   aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                
                                                <div class="tab-content w-100">
                                                    @foreach (languages() as $lang)
                                                        <div role="tabpanel"
                                                             class="tab-pane fade @if($loop->first) show active @endif "
                                                             id="about_lang_{{$lang}}" aria-labelledby="about_lang_{{$lang}}"
                                                             aria-expanded="true">
                                                            
                                                            <!-- Section 1 Title -->
                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>{{__('admin.about_section_1')}} - {{__('admin.title')}} ({{ $lang }})</label>
                                                                        <input type="text" name="about_section_1_title_{{$lang}}" class="form-control" 
                                                                               value="{{$data['about_section_1']['title_'.$lang] ?? ''}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Section 2 Title -->
                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>{{__('admin.about_section_2')}} - {{__('admin.title')}} ({{ $lang }})</label>
                                                                        <input type="text" name="about_section_2_title_{{$lang}}" class="form-control" 
                                                                               value="{{$data['about_section_2']['title_'.$lang] ?? ''}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- About (for Section 1) -->
                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>{{__('admin.about_the_application')}} ({{ $lang }}) - {{__('admin.description')}} {{__('admin.about_section_1')}}</label>
                                                                            <textarea class="form-control"
                                                                                      name="about_{{ $lang }}"
                                                                                      id="about_{{ $lang }}_editor"
                                                                                      cols="30" rows="10"
                                                                                      placeholder="{{__('admin.about_the_application')}} {{ $lang }}">{{$data['about_'.$lang]??''}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- About 2 (for Section 2) -->
                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>{{__('admin.about_2')}} ({{ $lang }}) - {{__('admin.description')}} {{__('admin.about_section_2')}}</label>
                                                                            <textarea class="form-control"
                                                                                      name="about_2_{{ $lang }}"
                                                                                      id="about_2_{{ $lang }}_editor"
                                                                                      cols="30" rows="10"
                                                                                      placeholder="{{__('admin.about_2')}} {{ $lang }}">{{$data['about_2_'.$lang]??''}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    @endforeach
                                                </div>
                                                
                                                <!-- Images Section (outside language tabs) -->
                                                <div class="col-12 mt-4">
                                                    <hr>
                                                    <h4 class="mb-3">{{__('admin.about_images')}}</h4>
                                                    
                                                    <!-- Section 1 Image -->
                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            <h5 class="mb-2">{{__('admin.about_section_1')}} - {{__('admin.image')}}</h5>
                                                            <div class="imgMontg col-12 text-center">
                                                                <div class="dropBox">
                                                                    <div class="textCenter d-flex flex-column">
                                                                        <div class="imagesUploadBlock">
                                                                            <label class="uploadImg">
                                                                                <span><i class="feather icon-image"></i></span>
                                                                                <input type="file" accept="image/*" name="about_section_1_image" class="imageUploader">
                                                                            </label>
                                                                            <div class="uploadedBlock">
                                                                                @if(!empty($data['about_section_1']['image']))
                                                                                    <img src="{{$data['about_section_1']['image']}}">
                                                                                @endif
                                                                                <button class="close"><i class="feather icon-trash-2"></i></button>
                                                                            </div>
                                                                        </div>
                                                                        <span>{{__('admin.image')}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Section 2 Image -->
                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            <h5 class="mb-2">{{__('admin.about_section_2')}} - {{__('admin.image')}}</h5>
                                                            <div class="imgMontg col-12 text-center">
                                                                <div class="dropBox">
                                                                    <div class="textCenter d-flex flex-column">
                                                                        <div class="imagesUploadBlock">
                                                                            <label class="uploadImg">
                                                                                <span><i class="feather icon-image"></i></span>
                                                                                <input type="file" accept="image/*" name="about_section_2_image" class="imageUploader">
                                                                            </label>
                                                                            <div class="uploadedBlock">
                                                                                @if(!empty($data['about_section_2']['image']))
                                                                                    <img src="{{$data['about_section_2']['image']}}">
                                                                                @endif
                                                                                <button class="close"><i class="feather icon-trash-2"></i></button>
                                                                            </div>
                                                                        </div>
                                                                        <span>{{__('admin.image')}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-center mt-3">
                                                <button type="submit"
                                                        class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                <a href="{{ url()->previous() }}" type="reset"
                                                   class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-our-location"
                                         aria-labelledby="account-pill-our-location" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            
                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="nav nav-tabs mb-3">
                                                        @foreach (languages() as $lang)
                                                            <li class="nav-item">
                                                                <a class="nav-link @if($loop->first) active @endif"
                                                                   data-toggle="pill" href="#our_location_lang_{{$lang}}"
                                                                   aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                
                                                <div class="tab-content w-100">
                                                    @foreach (languages() as $lang)
                                                        <div role="tabpanel"
                                                             class="tab-pane fade @if($loop->first) show active @endif "
                                                             id="our_location_lang_{{$lang}}" aria-labelledby="our_location_lang_{{$lang}}"
                                                             aria-expanded="true">
                                                            
                                                            <!-- Our Location Title -->
                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>{{__('admin.title')}} ({{ $lang }})</label>
                                                                        <input type="text" name="our_location_title_{{$lang}}" class="form-control" 
                                                                               value="{{$data['our_location']['title_'.$lang] ?? ''}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Our Location Description -->
                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>{{__('admin.description')}} ({{ $lang }})</label>
                                                                            <textarea class="form-control"
                                                                                      name="our_location_description_{{$lang}}"
                                                                                      id="our_location_description_{{$lang}}_editor"
                                                                                      cols="30" rows="10"
                                                                                      placeholder="{{__('admin.our_location')}} {{ $lang }}">{{$data['our_location']['description_'.$lang]??''}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-center mt-3">
                                                <button type="submit"
                                                        class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                <a href="{{ url()->previous() }}" type="reset"
                                                   class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-privacy"
                                         aria-labelledby="account-pill-privacy" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="row">

                                                <div class="col-12">
                                                    <ul class="nav nav-tabs  mb-3">
                                                        @foreach (languages() as $lang)
                                                            <li class="nav-item">
                                                                <a class="nav-link @if($loop->first) active @endif"
                                                                   data-toggle="pill" href="#privacy_{{$lang}}"
                                                                   aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                <div class="tab-content">
                                                    @foreach (languages() as $lang)
                                                        <div role="tabpanel"
                                                             class="tab-pane fade @if($loop->first) show active @endif "
                                                             id="privacy_{{$lang}}" aria-labelledby="first_{{$lang}}"
                                                             aria-expanded="true">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label for="account-name">{{__('admin.privacy_policy')}} {{ $lang  }}</label>
                                                                        <textarea class="form-control"
                                                                                  name="privacy_{{ $lang }}"
                                                                                  id="privacy_{{ $lang }}_editor"
                                                                                  cols="30" rows="10"
                                                                                  placeholder="{{__('admin.privacy_policy')}} {{ $lang }}">{{$data['privacy_'.$lang]??''}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit"
                                                            class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset"
                                                       class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-contact"
                                         aria-labelledby="account-pill-contact" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="row">

                                                <div class="col-12">
                                                    <ul class="nav nav-tabs mb-3">
                                                        @foreach (languages() as $lang)
                                                            <li class="nav-item">
                                                                <a class="nav-link @if($loop->first) active @endif"
                                                                   data-toggle="pill" href="#contact_address_{{$lang}}"
                                                                   aria-expanded="true">{{  __('admin.address') }} {{ $lang }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                <div class="tab-content">
                                                    @foreach (languages() as $lang)
                                                        <div role="tabpanel"
                                                             class="tab-pane fade @if($loop->first) show active @endif "
                                                             id="contact_address_{{$lang}}" aria-labelledby="contact_address_{{$lang}}"
                                                             aria-expanded="true">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label for="contact_address_{{ $lang }}">{{__('admin.contact_address')}} {{ $lang }}</label>
                                                                        <textarea class="form-control"
                                                                                  name="contact_address_{{ $lang }}"
                                                                                  id="contact_address_{{ $lang }}"
                                                                                  cols="30" rows="4"
                                                                                  placeholder="{{__('admin.contact_address')}} {{ $lang }}">{{$data['contact_address_'.$lang]??''}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="contact_address_map">{{__('admin.contact_address_location')}}</label>
                                                        <div class="controls">
                                                            <input type="text" id="contact_address_search" style="width: 50%;" class="controls" type="text" placeholder="{{__('admin.search_location')}}" style="width: 100%; margin-bottom: 10px;">
                                                            <div id="contact_address_map" style="height: 300px;"></div>
                                                            <input type="hidden" id="contact_address_lat" name="contact_address_lat" value="{{$data['contact_address_lat'] ?? '24.7135517'}}">
                                                            <input type="hidden" id="contact_address_lng" name="contact_address_lng" value="{{$data['contact_address_lng'] ?? '46.6752957'}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.brochure_file')}}</label>
                                                        <div class="imgMontg col-12 text-center">
                                                            <div class="dropBox">
                                                                <div class="textCenter">
                                                                    <div class="imagesUploadBlock">
                                                                        <label class="uploadImg">
                                                                            <span><i class="feather icon-file-text"></i></span>
                                                                            <input type="file"
                                                                                   name="brochure_file"
                                                                                   class="imageUploader">
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if(isset($data['brochure_file']) && $data['brochure_file'])
                                                                <div class="mt-2">
                                                                    <a href="{{$data['brochure_file']}}" target="_blank" class="btn btn-info btn-sm">
                                                                        <i class="feather icon-download"></i> {{__('admin.view_current_file')}}
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit"
                                                            class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset"
                                                       class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-facts"
                                         aria-labelledby="account-pill-facts" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="row">

                                                <div class="col-12">
                                                    <h4 class="mb-3">{{__('admin.facts_by_numbers')}}</h4>
                                                </div>
                                                
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="happy_customers">{{__('admin.happy_customers')}}</label>
                                                        <div class="controls">
                                                            <input type="text" name="happy_customers" id="happy_customers" class="form-control" 
                                                                   value="{{$data['happy_customers'] ?? '3K+'}}" 
                                                                   placeholder="{{__('admin.happy_customers')}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="vip_members">{{__('admin.vip_members')}}</label>
                                                        <div class="controls">
                                                            <input type="text" name="vip_members" id="vip_members" class="form-control" 
                                                                   value="{{$data['vip_members'] ?? '2K+'}}" 
                                                                   placeholder="{{__('admin.vip_members')}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="reviews">{{__('admin.reviews')}}</label>
                                                        <div class="controls">
                                                            <input type="text" name="reviews" id="reviews" class="form-control" 
                                                                   value="{{$data['reviews'] ?? '400+'}}" 
                                                                   placeholder="{{__('admin.reviews')}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="years_experience">{{__('admin.years_experience')}}</label>
                                                        <div class="controls">
                                                            <input type="text" name="years_experience" id="years_experience" class="form-control" 
                                                                   value="{{$data['years_experience'] ?? '5+'}}" 
                                                                   placeholder="{{__('admin.years_experience')}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit"
                                                            class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset"
                                                       class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- App Download Section -->
                                    <div role="tabpanel" class="tab-pane" id="account-vertical-app-download"
                                         aria-labelledby="account-pill-app-download" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="row">

                                                <div class="col-12">
                                                    <h4 class="mb-3">{{__('admin.app_download')}}</h4>
                                                </div>

                                                <!-- App Download Links -->
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="app_google_play_link">{{__('admin.google_play_link')}}</label>
                                                        <div class="controls">
                                                            <input type="url" name="app_google_play_link" id="app_google_play_link" class="form-control" 
                                                                   value="{{$data['app_google_play_link'] ?? 'https://play.google.com/store/apps/details?id=com.distinqt.carhire'}}" 
                                                                   placeholder="{{__('admin.google_play_link')}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="app_apple_store_link">{{__('admin.apple_store_link')}}</label>
                                                        <div class="controls">
                                                            <input type="url" name="app_apple_store_link" id="app_apple_store_link" class="form-control" 
                                                                   value="{{$data['app_apple_store_link'] ?? 'https://apps.apple.com/app/distinqt-car-hire/id123456789'}}" 
                                                                   placeholder="{{__('admin.apple_store_link')}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- App Download Title (Multilingual) -->
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="app_download_title_ar">{{__('admin.app_download_title')}} ({{__('admin.arabic')}})</label>
                                                        <div class="controls">
                                                            <input type="text" name="app_download_title_ar" id="app_download_title_ar" class="form-control" 
                                                                   value="{{$data['app_download_title_ar'] ?? 'حمل تطبيقنا'}}" 
                                                                   placeholder="{{__('admin.app_download_title')}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="app_download_title_en">{{__('admin.app_download_title')}} ({{__('admin.english')}})</label>
                                                        <div class="controls">
                                                            <input type="text" name="app_download_title_en" id="app_download_title_en" class="form-control" 
                                                                   value="{{$data['app_download_title_en'] ?? 'DOWNLOAD OUR APP'}}" 
                                                                   placeholder="{{__('admin.app_download_title')}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- App Download Description (Multilingual) -->
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="app_download_description_ar">{{__('admin.app_download_description')}} ({{__('admin.arabic')}})</label>
                                                        <div class="controls">
                                                            <textarea name="app_download_description_ar" id="app_download_description_ar" class="form-control" rows="4" 
                                                                      placeholder="{{__('admin.app_download_description')}}">{{$data['app_download_description_ar'] ?? 'تبحث عن تأجير سيارة أثناء التنقل؟ تطبيق DistinQt Car Hire يجعل الحجز سريع وسهل، احجز وأدر تأجير السيارة المثالية من هاتفك الذكي. حجز سلس بضغطة قليلة، ابق مسيطراً من خلال تتبع حجوزاتك وتفاصيل الاستلام.'}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="app_download_description_en">{{__('admin.app_download_description')}} ({{__('admin.english')}})</label>
                                                        <div class="controls">
                                                            <textarea name="app_download_description_en" id="app_download_description_en" class="form-control" rows="4" 
                                                                      placeholder="{{__('admin.app_download_description')}}">{{$data['app_download_description_en'] ?? 'Looking for a car rental on the go? The DistinQt Car Hire App makes it quick, easy, book, and manage your perfect vehicle rental all from your smart phone seamless booking with just a few taps, stay in control by tracking your reservations and pick-up details.'}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit"
                                                            class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset"
                                                       class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-home-sections"
                                         aria-labelledby="account-pill-home-sections" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            
                                            <!-- Section 1: Transparency Section -->
                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <h4 class="mb-3">{{__('admin.section_transparency')}}</h4>
                                                </div>
                                                
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.title')}} ({{__('admin.ar')}})</label>
                                                        <input type="text" name="section_transparency_title_ar" class="form-control" 
                                                               value="{{$data['section_transparency']['title_ar'] ?? ''}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.title')}} ({{__('admin.en')}})</label>
                                                        <input type="text" name="section_transparency_title_en" class="form-control" 
                                                               value="{{$data['section_transparency']['title_en'] ?? ''}}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.subtitle')}} ({{__('admin.ar')}})</label>
                                                        <input type="text" name="section_transparency_subtitle_ar" class="form-control" 
                                                               value="{{$data['section_transparency']['subtitle_ar'] ?? ''}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.subtitle')}} ({{__('admin.en')}})</label>
                                                        <input type="text" name="section_transparency_subtitle_en" class="form-control" 
                                                               value="{{$data['section_transparency']['subtitle_en'] ?? ''}}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.description')}} ({{__('admin.ar')}})</label>
                                                        <textarea name="section_transparency_description_ar" class="form-control" rows="4">{{$data['section_transparency']['description_ar'] ?? ''}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.description')}} ({{__('admin.en')}})</label>
                                                        <textarea name="section_transparency_description_en" class="form-control" rows="4">{{$data['section_transparency']['description_en'] ?? ''}}</textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <div class="imgMontg col-12 text-center">
                                                        <div class="dropBox">
                                                            <div class="textCenter d-flex flex-column">
                                                                <div class="imagesUploadBlock">
                                                                    <label class="uploadImg">
                                                                        <span><i class="feather icon-image"></i></span>
                                                                        <input type="file" accept="image/*,video/*" name="section_transparency_file" class="imageUploader">
                                                                    </label>
                                                                    <div class="uploadedBlock">
                                                                        @if(!empty($data['section_transparency']['file']))
                                                                            @if(strpos($data['section_transparency']['file'], '.mp4') !== false || strpos($data['section_transparency']['file'], '.mov') !== false)
                                                                                <video src="{{$data['section_transparency']['file']}}" style="max-width: 200px; max-height: 200px;"></video>
                                                                            @else
                                                                                <img src="{{$data['section_transparency']['file']}}">
                                                                            @endif
                                                                        @endif
                                                                        <button class="close"><i class="feather icon-trash-2"></i></button>
                                                                    </div>
                                                                </div>
                                                                <span>{{__('admin.file')}} ({{__('admin.image_or_video')}})</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <hr class="my-4">
                                            
                                            <!-- Section 2: Damage Liability Section -->
                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <h4 class="mb-3">{{__('admin.section_damage_liability')}}</h4>
                                                </div>
                                                
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.title')}} ({{__('admin.ar')}})</label>
                                                        <input type="text" name="section_damage_liability_title_ar" class="form-control" 
                                                               value="{{$data['section_damage_liability']['title_ar'] ?? ''}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.title')}} ({{__('admin.en')}})</label>
                                                        <input type="text" name="section_damage_liability_title_en" class="form-control" 
                                                               value="{{$data['section_damage_liability']['title_en'] ?? ''}}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.subtitle')}} ({{__('admin.ar')}})</label>
                                                        <input type="text" name="section_damage_liability_subtitle_ar" class="form-control" 
                                                               value="{{$data['section_damage_liability']['subtitle_ar'] ?? ''}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.subtitle')}} ({{__('admin.en')}})</label>
                                                        <input type="text" name="section_damage_liability_subtitle_en" class="form-control" 
                                                               value="{{$data['section_damage_liability']['subtitle_en'] ?? ''}}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.description')}} ({{__('admin.ar')}})</label>
                                                        <textarea name="section_damage_liability_description_ar" class="form-control" rows="4">{{$data['section_damage_liability']['description_ar'] ?? ''}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.description')}} ({{__('admin.en')}})</label>
                                                        <textarea name="section_damage_liability_description_en" class="form-control" rows="4">{{$data['section_damage_liability']['description_en'] ?? ''}}</textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <div class="imgMontg col-12 text-center">
                                                        <div class="dropBox">
                                                            <div class="textCenter d-flex flex-column">
                                                                <div class="imagesUploadBlock">
                                                                    <label class="uploadImg">
                                                                        <span><i class="feather icon-image"></i></span>
                                                                        <input type="file" accept="image/*,video/*" name="section_damage_liability_file" class="imageUploader">
                                                                    </label>
                                                                    <div class="uploadedBlock">
                                                                        @if(!empty($data['section_damage_liability']['file']))
                                                                            @if(strpos($data['section_damage_liability']['file'], '.mp4') !== false || strpos($data['section_damage_liability']['file'], '.mov') !== false)
                                                                                <video src="{{$data['section_damage_liability']['file']}}" style="max-width: 200px; max-height: 200px;"></video>
                                                                            @else
                                                                                <img src="{{$data['section_damage_liability']['file']}}">
                                                                            @endif
                                                                        @endif
                                                                        <button class="close"><i class="feather icon-trash-2"></i></button>
                                                                    </div>
                                                                </div>
                                                                <span>{{__('admin.file')}} ({{__('admin.image_or_video')}})</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <hr class="my-4">
                                            
                                            <!-- Section 3: Our Story Section -->
                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <h4 class="mb-3">{{__('admin.section_our_story')}}</h4>
                                                </div>
                                                
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.title')}} ({{__('admin.ar')}})</label>
                                                        <input type="text" name="section_our_story_title_ar" class="form-control" 
                                                               value="{{$data['section_our_story']['title_ar'] ?? ''}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.title')}} ({{__('admin.en')}})</label>
                                                        <input type="text" name="section_our_story_title_en" class="form-control" 
                                                               value="{{$data['section_our_story']['title_en'] ?? ''}}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.subtitle')}} ({{__('admin.ar')}})</label>
                                                        <input type="text" name="section_our_story_subtitle_ar" class="form-control" 
                                                               value="{{$data['section_our_story']['subtitle_ar'] ?? ''}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.subtitle')}} ({{__('admin.en')}})</label>
                                                        <input type="text" name="section_our_story_subtitle_en" class="form-control" 
                                                               value="{{$data['section_our_story']['subtitle_en'] ?? ''}}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.description')}} ({{__('admin.ar')}})</label>
                                                        <textarea name="section_our_story_description_ar" class="form-control" rows="4">{{$data['section_our_story']['description_ar'] ?? ''}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>{{__('admin.description')}} ({{__('admin.en')}})</label>
                                                        <textarea name="section_our_story_description_en" class="form-control" rows="4">{{$data['section_our_story']['description_en'] ?? ''}}</textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <div class="imgMontg col-12 text-center">
                                                        <div class="dropBox">
                                                            <div class="textCenter d-flex flex-column">
                                                                <div class="imagesUploadBlock">
                                                                    <label class="uploadImg">
                                                                        <span><i class="feather icon-image"></i></span>
                                                                        <input type="file" accept="image/*,video/*" name="section_our_story_file" class="imageUploader">
                                                                    </label>
                                                                    <div class="uploadedBlock">
                                                                        @if(!empty($data['section_our_story']['file']))
                                                                            @if(strpos($data['section_our_story']['file'], '.mp4') !== false || strpos($data['section_our_story']['file'], '.mov') !== false)
                                                                                <video src="{{$data['section_our_story']['file']}}" style="max-width: 200px; max-height: 200px;"></video>
                                                                            @else
                                                                                <img src="{{$data['section_our_story']['file']}}">
                                                                            @endif
                                                                        @endif
                                                                        <button class="close"><i class="feather icon-trash-2"></i></button>
                                                                    </div>
                                                                </div>
                                                                <span>{{__('admin.file')}} ({{__('admin.image_or_video')}})</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-center mt-3">
                                                <button type="submit"
                                                        class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                <a href="{{ url()->previous() }}" type="reset"
                                                   class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-smtp"
                                         aria-labelledby="account-pill-smtp" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="row">

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.user_name')}}</label>
                                                            <input type="text" class="form-control"
                                                                   name="smtp_user_name" id="account-name"
                                                                   placeholder="{{__('admin.user_name')}}"
                                                                   value="{{$data['smtp_user_name']}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.password')}}</label>
                                                            <input type="password" class="form-control"
                                                                   name="smtp_password" id="account-name"
                                                                   placeholder="{{__('admin.password')}}"
                                                                   value="{{$data['smtp_password']}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.email_Sender')}}</label>
                                                            <input type="text" class="form-control"
                                                                   name="smtp_mail_from" id="account-name"
                                                                   placeholder="{{__('admin.email_Sender')}}"
                                                                   value="{{$data['smtp_mail_from']}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.the_sender_name')}}</label>
                                                            <input type="text" class="form-control"
                                                                   name="smtp_sender_name" id="account-name"
                                                                   placeholder="{{__('admin.the_sender_name')}}"
                                                                   value="{{$data['smtp_sender_name']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.the_nouns_al')}}</label>
                                                            <input type="text" class="form-control" name="smtp_host"
                                                                   id="account-name"
                                                                   placeholder="{{__('admin.the_nouns_al')}}"
                                                                   value="{{$data['smtp_host']}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.encryption_type')}}</label>
                                                            <input type="text" class="form-control"
                                                                   name="smtp_encryption" id="account-name"
                                                                   placeholder="{{__('admin.encryption_type')}}"
                                                                   value="{{$data['smtp_encryption']}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.Port_number')}}</label>
                                                            <input type="number" class="form-control" name="smtp_port"
                                                                   id="account-name"
                                                                   placeholder="{{__('admin.Port_number')}}"
                                                                   value="{{$data['smtp_port']}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit"
                                                            class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset"
                                                       class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-notifications"
                                         aria-labelledby="account-pill-notifications" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="row">

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.server_key')}}</label>
                                                            <input type="text" class="form-control" name="firebase_key"
                                                                   id="account-name"
                                                                   placeholder="{{__('admin.server_key')}}"
                                                                   value="{{$data['firebase_key']}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.sender_identification')}}</label>
                                                            <input type="text" class="form-control"
                                                                   name="firebase_sender_id" id="account-name"
                                                                   placeholder="{{__('admin.sender_identification')}}"
                                                                   value="{{$data['firebase_sender_id']}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit"
                                                            class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset"
                                                       class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-api"
                                         aria-labelledby="account-pill-api" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="row">

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.live_chat')}}</label>
                                                            <input type="text" class="form-control" name="live_chat"
                                                                   id="account-name"
                                                                   placeholder="{{__('admin.live_chat')}}"
                                                                   value="{{$data['live_chat']}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.google_analytics')}}</label>
                                                            <input type="text" class="form-control"
                                                                   name="google_analytics" id="account-name"
                                                                   placeholder="{{__('admin.google_analytics')}}"
                                                                   value="{{$data['google_analytics']}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{__('admin.google_places')}}</label>
                                                            <input type="text" class="form-control" name="google_places"
                                                                   id="account-name"
                                                                   placeholder="{{__('admin.google_places')}}"
                                                                   value="{{$data['google_places']}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit"
                                                            class="btn btn-primary mr-1 mb-1 submit_button">{{__('admin.saving_changes')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset"
                                                       class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                </div>
                                            </div>
                                        </form>
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

@endsection
@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/full-all/ckeditor.js"></script>
    <script>
        @foreach(languages() as $lang)
        CKEDITOR.replace('about_{{ $lang }}_editor');
        CKEDITOR.replace('about_2_{{ $lang }}_editor');
        CKEDITOR.replace('our_location_description_{{$lang}}_editor');
        CKEDITOR.replace('terms_{{ $lang }}_editor');
        CKEDITOR.replace('privacy_{{ $lang }}_editor');
        @endforeach


    </script>
    <script>
        let socialIndex = 0; // To keep track of the current index of socials
        function addSocial() {
            socialIndex++;
            const sonContainer = document.getElementById('socials_container');
            const sonTemplate = `
            <div class="social_info_add cta-form social-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="imgMontg text-center">
                            <div class="dropBox">
                                <div class="textCenter d-flex flex-column">
                                    <div class="imagesUploadBlock">
                                        <label class="uploadImg">
                                            <span><i class="feather icon-image"></i></span>
                                            <input type="file"accept="image/*" name="socials[${socialIndex}][image]" class="imageUploader">
                                        </label>

                                    </div>
                                    <span>{{__('admin.logo_image')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mt-10">
                            <label for="first-name-column">{{__('admin.name')}}</label>
                            <input type="text" name="socials[${socialIndex}][name]" placeholder="@lang('admin.social_name')" class="form-control social-name">
                        </div>
                        <div class="form-group mt-10">
                            <label for="first-name-column">{{__('admin.Link')}}</label>
                            <input type="url" name="socials[${socialIndex}][url]" placeholder="@lang('admin.social_url')" class="form-control social-url">
                        </div>
                    </div>

                </div>
                <div class="col-12 d-flex justify-content-center mt-3">
                    <button type="button" class="btn btn-danger removeSocialButton" onclick="removeSocial(this)"> @lang('site.delete') <i class="feather icon-trash-2"></i></button>
                </div>
          </div>
      `;
            sonContainer.insertAdjacentHTML('beforeend', sonTemplate);
        }


    $("#addSocialButton").click(function (b){
        b.preventDefault();

        $('.imageUploader').change(function (event){
            $(this).parents('.imagesUploadBlock').append('<div class="uploadedBlock"><img src="'+ URL.createObjectURL(event.target.files[0]) +'"><button class="close"><i class="feather icon-x"></i></button></div>');
        });
        $('.dropBox').on('click', '.close',function (){
            // $(this).parents('.textCenter').remove();
            $(this).closest('.uploadedBlock').find('img').remove();
            $(this).closest('.dropBox').html(`<div class="textCenter d-flex flex-column">
                                    <div class="imagesUploadBlock">
                                        <label class="uploadImg">
                                            <span><i class="feather icon-image"></i></span>
                                            <input type="file"accept="image/*" name="socials[${socialIndex}][image]" class="imageUploader">
                                        </label>

                                    </div>
                                    <span>{{__('admin.logo_image')}}</span>
                                </div>`);
            $('.imageUploader').change(function (event){
                $(this).parents('.imagesUploadBlock').append('<div class="uploadedBlock"><img src="'+ URL.createObjectURL(event.target.files[0]) +'"><button class="close"><i class="feather icon-x"></i></button></div>');
            });
            return false;
        });

    });

        function removeSocial(button) {
            const sonGroup = button.closest('.social-group');
            if (sonGroup) {
                sonGroup.remove();
            }
        }
    </script>
    {{-- show selected image script --}}
    @include('admin.shared.addImage')
    {{-- show selected image script --}}

    <?php $google_places_key = $data['google_places'] ?? ''; ?>
    @if($google_places_key)
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key={{$google_places_key}}&libraries=places&language=ar"></script>
    <script type="text/javascript">
        // Contact Address Map
        var contactMap, contactMarker;
        var contactLatlng = new google.maps.LatLng({{ $data['contact_address_lat'] ?? '24.7135517' }}, {{ $data['contact_address_lng'] ?? '46.6752957' }});
        var contactGeocoder = new google.maps.Geocoder();
        var contactMapOptions = {
            zoom: 14,
            center: contactLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        contactMap = new google.maps.Map(document.getElementById("contact_address_map"), contactMapOptions);
        contactMarker = new google.maps.Marker({
            map: contactMap,
            position: contactLatlng,
            draggable: true
        });

        // Contact Address Search Box
        var contactInput = document.getElementById('contact_address_search');
        var contactSearchBox = new google.maps.places.SearchBox(contactInput);
        contactMap.controls[google.maps.ControlPosition.TOP_LEFT].push(contactInput);
        
        contactMap.addListener('bounds_changed', function() {
            contactSearchBox.setBounds(contactMap.getBounds());
        });
        
        contactSearchBox.addListener('places_changed', function() {
            var places = contactSearchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                contactMarker.setPosition(place.geometry.location);
                $('#contact_address_lat').val(place.geometry.location.lat());
                $('#contact_address_lng').val(place.geometry.location.lng());
                if(place.geometry.viewport) {
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            contactMap.fitBounds(bounds);
        });

        // Contact Address Marker Drag Event
        google.maps.event.addListener(contactMarker, 'dragend', function () {
            var position = contactMarker.getPosition();
            contactGeocoder.geocode({ location: position }, function (results, status) {
                if (status === 'OK' && results[0]) {
                    $('#contact_address_search').val(results[0].formatted_address);
                    $('#contact_address_lat').val(position.lat());
                    $('#contact_address_lng').val(position.lng());
                }
            });
        });
    </script>
    @endif
@endsection

