@extends('admin.layout.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@endsection
@section('content')
<form  method="POST"  class="show form-horizontal" novalidate enctype="multipart/form-data">
    @csrf
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
                                                        @lang('site.general_details')
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="card">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="col-12">
                                                                                    <ul class="nav nav-tabs  mb-3">
                                                                                        @foreach (languages() as $lang)
                                                                                            <li class="nav-item">
                                                                                                <a class="nav-link @if($loop->first) active @endif"  data-toggle="pill" href="#first_{{$lang}}" aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div> 
                                                                                
                                                                                <div class="col-12">
                                                                                    <div class="imgMontg col-12 text-center">
                                                                                            <div class="dropBox">
                                                                                                <div class="textCenter">
                                                                                                    <div class="imagesUploadBlock">
                                                                                                        <label class="uploadImg">
                                                                                                            <span><i class="feather icon-image"></i></span>
                                                                                                            <input type="file" accept="image/*" name="logo" class="imageUploader">
                                                                                                        </label>
                                                                                                        <div class="uploadedBlock">
                                                                                                            <img src="{{$carBrand->logo}}">
                                                                                                            <button class="close"><i class="la la-times"></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>
                                                                                </div>
    
                                                                                <div class="tab-content">
                                                                                    @foreach (languages() as $lang)
                                                                                        <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                                                            <div class="col-md-12 col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                                                                    <div class="controls">
                                                                                                        <input type="text" value="{{$carBrand->getTranslations('name')[$lang]??''}}" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
    
                                                                                <div class="col-md-12 col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-column">{{ __('admin.sort_order') }}</label>
                                                                                        <div class="controls">
                                                                                            <input type="number" name="sort_order"
                                                                                                   class="form-control"
                                                                                                   placeholder="{{ __('admin.sort_order') }}"
                                                                                                   value="{{ $carBrand->sort_order }}"
                                                                                                   min="0">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
    
                                                                                <div class="col-md-12 col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-column">{{ __('admin.status') }}</label>
                                                                                        <div class="controls">
                                                                                            <select name="is_active"
                                                                                                    class="select2 form-control"
                                                                                                    required
                                                                                                    data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                                <option value="1" {{ $carBrand->is_active ? 'selected' : '' }}>{{ __('admin.active') }}</option>
                                                                                                <option value="0" {{ !$carBrand->is_active ? 'selected' : '' }}>{{ __('admin.inactive') }}</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
    
                                                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                                                    <a href="{{ url()->previous() }}" type="reset"
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
                    </div>
                </section>
                <!-- account setting page end -->
            </div>
        </section>
    </div>
    </form>
@endsection

@section('js')
    <script src="{{ asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js') }}"></script>
    <script>
        $('.show input').attr('disabled' , true)
        $('.show textarea').attr('disabled' , true)
        $('.show select').attr('disabled' , true)
    </script>
@endsection
