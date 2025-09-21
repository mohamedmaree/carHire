@extends('admin.layout.master')

@section('content')
<form  class="store form-horizontal" >
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
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="col-12">
                                                                                    <ul class="nav nav-tabs mb-3">
                                                                                        @foreach (languages() as $lang)
                                                                                            <li class="nav-item">
                                                                                                <a class="nav-link @if($loop->first) active @endif"  data-toggle="pill" href="#first_{{$lang}}" aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div> 


                                                                                <div class="tab-content">
                                                                                    @foreach (languages() as $lang)
                                                                                        <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                                                            <div class="col-md-12 col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                                                                    <div class="controls">
                                                                                                        <input type="text" value="{{$city->getTranslations('name')[$lang]??''}}" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>

                                                                                <div class="col-md-12 col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-column">{{ __('admin.country.index') }}</label>
                                                                                        <div class="controls">
                                                                                            <select name="country_id" class="select2 form-control" required
                                                                                                data-validation-required-message="{{ __('admin.this_field_is_required') }}">

                                                                                                @foreach ($countries as $country)
                                                                                                    <option
                                                                                                        {{ $country->id == $city->country_id ? 'selected' : '' }}
                                                                                                        value="{{ $country->id }}">{{ $country->name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-md-12 col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="first-name-column">{{ __('admin.region.index') }}</label>
                                                                                        <div class="controls">
                                                                                            <select name="region_id" class="select2 form-control" required
                                                                                                data-validation-required-message="{{ __('admin.this_field_is_required') }}">

                                                                                                @foreach ($regions as $region)
                                                                                                    <option
                                                                                                        {{ $region->id == $city->region_id ? 'selected' : '' }}
                                                                                                        value="{{ $region->id }}">{{ $region->name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-12 d-flex justify-content-center mt-3">
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
    <script>
        $('.store input').attr('disabled' , true)
        $('.store textarea').attr('disabled' , true)
        $('.store select').attr('disabled' , true)

    </script>
@endsection