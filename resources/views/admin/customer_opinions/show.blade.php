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
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <div class="form-body">
                                                                            <div class="row">
                                                                                
                                                                                <div class="col-12">
                                                                                    <div class="col-12 text-center mb-3">
                                                                                        <div class="imgMontg">
                                                                                            <div class="dropBox">
                                                                                                <div class="textCenter">
                                                                                                    <div class="imagesUploadBlock">
                                                                                                        <div class="uploadedBlock">
                                                                                                            <img src="{{$customerOpinion->image}}" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>{{ __('admin.name') }}</label>
                                                                                            <div class="controls">
                                                                                                <p class="form-control-static">{{ $customerOpinion->name }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>{{ __('admin.num_stars') }}</label>
                                                                                            <div class="controls">
                                                                                                <p class="form-control-static">
                                                                                                    @for($i = 1; $i <= 5; $i++)
                                                                                                        @if($i <= $customerOpinion->num_stars)
                                                                                                            <i class="feather icon-star text-warning"></i>
                                                                                                        @else
                                                                                                            <i class="feather icon-star"></i>
                                                                                                        @endif
                                                                                                    @endfor
                                                                                                    ({{ $customerOpinion->num_stars }} {{__('admin.stars')}})
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>{{ __('admin.status') }}</label>
                                                                                            <div class="controls">
                                                                                                @if ($customerOpinion->is_active)
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

                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label>{{ __('admin.sort_order') }}</label>
                                                                                            <div class="controls">
                                                                                                <p class="form-control-static">{{ $customerOpinion->sort_order }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-12">
                                                                                        <div class="form-group">
                                                                                            <label>{{ __('admin.opinion_text') }}</label>
                                                                                            <div class="controls">
                                                                                                <p class="form-control-static">{{ $customerOpinion->opinion_text }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>

                                                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                                                    <a href="{{ route('admin.customer-opinions.edit', $customerOpinion->id) }}" class="btn btn-primary mr-1 mb-1">
                                                                                        <i class="feather icon-edit"></i> {{ __('admin.edit') }}
                                                                                    </a>
                                                                                    <a href="{{ route('admin.customer-opinions.index') }}" class="btn btn-outline-warning mr-1 mb-1">
                                                                                        <i class="feather icon-arrow-left"></i> {{ __('admin.back') }}
                                                                                    </a>
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

