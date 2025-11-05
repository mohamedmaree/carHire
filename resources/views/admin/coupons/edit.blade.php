@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">

@endsection
{{-- extra css files --}}

@section('content')
<form  method="POST" action="{{route('admin.coupons.update' , ['coupon' => $coupon->id])}}" class="store form-horizontal" novalidate>
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
                                {{-- <li class="nav-item" style="margin-top: 3px">
                                    <a class="nav-link d-flex py-75" id="tab-pill-2" data-toggle="pill"
                                       href="#tab-2" aria-expanded="false">
                                        <i class="feather icon-edit mr-50 font-medium-3"></i>
                                      sample 2
                                    </a>
                                </li> --}}
    
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
                                                    <div class="col-9 ">
                                                        <div class="card">
                                                            {{-- <div class="card-header">
                                                                <h4 class="card-title">{{__('admin.add') . ' ' . __('admin.copy')}}</h4>
                                                            </div> --}}
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-12">
                                                                            <div class="form-group">
                                                                                <label for="first-name-column">{{__('admin.coupon_number')}}</label>
                                                                                <div class="controls">
                                                                                    <input type="text" name="coupon_num" value="{{$coupon->coupon_num}}" class="form-control" placeholder="{{__('admin.enter_coupon_number')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 col-12">
                                                                            <div class="form-group">
                                                                                <label for="first-name-column">{{__('admin.number_of_use')}}</label>
                                                                                <div class="controls">
                                                                                    <input type="number" name="max_use" value="{{$coupon->max_use}}" class="form-control" placeholder="{{__('admin.enter_number_of_use')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 col-12">
                                                                            <div class="form-group">
                                                                                <label for="first-name-column">{{__('admin.discount_type')}}</label>
                                                                                <div class="controls">
                                                                                    <select name="type" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                                        <option {{$coupon->type == 'ratio' ? 'selected' : ''}} value="ratio">{{__('admin.Percentage')}}</option>
                                                                                        <option {{$coupon->type == 'number' ? 'selected' : ''}} value="number">{{__('admin.fixed_number')}}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 col-12">
                                                                            <div class="form-group">
                                                                                <label for="first-name-column">{{__('admin.discount_value')}}</label>
                                                                                <div class="controls">
                                                                                    <input type="number" value="{{$coupon->discount}}" name="discount" class="discount form-control" placeholder="{{__('admin.type_the_value_of_the_discount')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 col-12">
                                                                            <div class="form-group">
                                                                                <label for="first-name-column">{{__('admin.larger_value_for_discount')}}</label>
                                                                                <div class="controls">
                                                                                    <input type="number" name="max_discount" value="{{$coupon->max_discount}}" class="max_discount form-control" placeholder="{{__('admin.write_the_greatest_value_for_the_discount')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 col-12">
                                                                            <div class="form-group">
                                                                                <label for="first-name-column">{{ __('admin.start_date') }}</label>
                                                                                <div class="controls">
                                                                                    <input type="date" value="{{date('Y-m-d', strtotime($coupon->start_date))}}" name="start_date" class="form-control" required
                                                                                        data-validation-required-message="{{ __('admin.this_field_is_required') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 col-12">
                                                                            <div class="form-group">
                                                                                <label for="first-name-column">{{__('admin.expiry_date')}}</label>
                                                                                <div class="controls">
                                                                                    <input  type="date" value="{{date('Y-m-d', strtotime($coupon->expire_date))}}" name="expire_date" class=" form-control"  required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
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

                                    {{-- <div role="tabpanel" class="tab-pane" id="tab-2"
                                        aria-labelledby="tab-pill-2" aria-expanded="false">
                                        2
                                    </div> --}}
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
    <script src="{{asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>

    <script>
        $(document).on('change','.select2', function () {
            if ($(this).val() == 'ratio') {
                $('.max_discount').prop('readonly', false);
            }else{
                $('.max_discount').prop('readonly', true);
            }
        });
    </script>
    <script>
        $(document).on('keyup','.discount', function () {
            if ($('.select2').val() == 'number') {
                $('.max_discount').val($(this).val());
            }else{
                $('.max_discount').val(null);
            }
        });
    </script>
    
    {{-- show selected image script --}}
        @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit edit form script --}}
        @include('admin.shared.submitEditForm')
    {{-- submit edit form script --}}
    
@endsection