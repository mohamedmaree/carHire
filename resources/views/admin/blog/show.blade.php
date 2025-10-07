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
                                                                                @if($blog->image)
                                                                                    <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="img-fluid" style="max-width: 300px;">
                                                                                @else
                                                                                    <i class="feather icon-image" style="font-size: 100px;"></i>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.title') }} ({{ __('admin.ar') }})</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $blog->getTranslation('title', 'ar') }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.title') }} ({{ __('admin.en') }})</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $blog->getTranslation('title', 'en') }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.author') }} ({{ __('admin.ar') }})</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $blog->getTranslation('author', 'ar') }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.author') }} ({{ __('admin.en') }})</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $blog->getTranslation('author', 'en') }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.description') }} ({{ __('admin.ar') }})</label>
                                                                            <div class="controls">
                                                                                <div class="form-control-static" style="max-height: 200px; overflow-y: auto;">
                                                                                    {!! $blog->getTranslation('description', 'ar') !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.description') }} ({{ __('admin.en') }})</label>
                                                                            <div class="controls">
                                                                                <div class="form-control-static" style="max-height: 200px; overflow-y: auto;">
                                                                                    {!! $blog->getTranslation('description', 'en') !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.status') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">
                                                                                    @if($blog->is_active)
                                                                                        <span class="badge badge-success">{{ __('admin.activate') }}</span>
                                                                                    @else
                                                                                        <span class="badge badge-danger">{{ __('admin.dis_activate') }}</span>
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.tags') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $blog->tags ? implode(', ', $blog->tags) : '' }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.sort_order') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $blog->sort_order }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.created_at') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $blog->created_at->format('Y-m-d H:i:s') }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.updated_at') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $blog->updated_at->format('Y-m-d H:i:s') }}</p>
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
