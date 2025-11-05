@extends('admin.layout.master')

@section('content')
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
                                                <div class="col-3">
                                                    @lang('admin.general_details')
                                                </div>
                                                <div class="col-9">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.image') }}</label>
                                                                            <div class="controls">
                                                                                @if($offer->image)
                                                                                    <img src="{{ $offer->image }}" alt="{{ $offer->title }}" class="img-fluid" style="max-width: 100px;">
                                                                                @else
                                                                                    <i class="feather icon-image" style="font-size: 100px;"></i>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.title') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $offer->title }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.discount_amount') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $offer->formatted_discount }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.coupon') }}</label>
                                                                            <div class="controls">
                                                                                @if($offer->coupon)
                                                                                    <p class="form-control-static">{{ $offer->coupon->coupon_num }}</p>
                                                                                @else
                                                                                    <p class="form-control-static">@lang('admin.no_coupon')</p>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.status') }}</label>
                                                                            <div class="controls">
                                                                                @if ($offer->is_active)
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
                                                                            <label>{{ __('admin.show_in_popup') }}</label>
                                                                            <div class="controls">
                                                                                @if ($offer->show_in_popup)
                                                                                    <span class="btn btn-sm round btn-outline-success">
                                                                                        {{ __('admin.yes') }} <i class="la la-check font-medium-2"></i>
                                                                                    </span>
                                                                                @else
                                                                                    <span class="btn btn-sm round btn-outline-secondary">
                                                                                        {{ __('admin.no') }} <i class="la la-close font-medium-2"></i>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.sort_order') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $offer->sort_order }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.start_date') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $offer->start_date ? $offer->start_date->format('M d, Y') : 'N/A' }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.end_date') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $offer->end_date ? $offer->end_date->format('M d, Y') : 'N/A' }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.description') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $offer->description }}</p>
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

<div class="col-12 d-flex justify-content-center mt-3">
    <a href="{{ route('admin.offers.edit', $offer->id) }}" class="btn btn-primary mr-1 mb-1">
        <i class="feather icon-edit"></i> {{ __('admin.edit') }}
    </a>
    <a href="{{ route('admin.offers.index') }}" class="btn btn-outline-warning mr-1 mb-1">
        <i class="feather icon-arrow-left"></i> {{ __('admin.back') }}
    </a>
</div>

@endsection