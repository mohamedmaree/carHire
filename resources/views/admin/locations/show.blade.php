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
                                                                            <label>{{ __('admin.name') }} ({{ __('admin.ar') }})</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $location->getTranslation('name', 'ar') }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.name') }} ({{ __('admin.en') }})</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $location->getTranslation('name', 'en') }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.address') }} ({{ __('admin.ar') }})</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $location->getTranslation('address', 'ar') }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.address') }} ({{ __('admin.en') }})</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $location->getTranslation('address', 'en') }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.type') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">
                                                                                    @if($location->type == 'airport')
                                                                                        <span class="badge badge-primary">{{ __('admin.airport') }}</span>
                                                                                    @else
                                                                                        <span class="badge badge-info">{{ __('admin.location_type') }}</span>
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.lat') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $location->lat }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.lng') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $location->lng }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.working_hours') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $location->working_hours }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.holiday_hours') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $location->holiday_hours ?? __('admin.not_specified') }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.working_days') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">
                                                                                    @if($location->working_days)
                                                                                        @foreach($location->working_days as $day)
                                                                                            <span class="badge badge-success">{{ __('admin.' . $day) }}</span>
                                                                                        @endforeach
                                                                                    @else
                                                                                        {{ __('admin.not_specified') }}
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.holiday_days') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">
                                                                                    @if($location->holiday_days)
                                                                                        @foreach($location->holiday_days as $day)
                                                                                            <span class="badge badge-warning">{{ __('admin.' . $day) }}</span>
                                                                                        @endforeach
                                                                                    @else
                                                                                        {{ __('admin.not_specified') }}
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.sort_order') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $location->sort_order }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.status') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">
                                                                                    @if($location->is_active)
                                                                                        <span class="badge badge-success">{{ __('admin.active') }}</span>
                                                                                    @else
                                                                                        <span class="badge badge-danger">{{ __('admin.inactive') }}</span>
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.created_at') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $location->created_at->format('Y-m-d H:i:s') }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.updated_at') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $location->updated_at->format('Y-m-d H:i:s') }}</p>
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
@endsection