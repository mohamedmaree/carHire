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
                                                                            <label>{{ __('admin.icon') }}</label>
                                                                            <div class="controls">
                                                                                @if($option->icon)
                                                                                    <img src="{{ $option->icon }}" alt="{{ $option->name }}" class="img-fluid" style="max-width: 100px;">
                                                                                @else
                                                                                    <i class="feather icon-circle" style="font-size: 100px;"></i>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.name') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $option->name }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.price') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $option->formatted_price }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.price_type') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $option->price_type_text }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.parent_option') }}</label>
                                                                            <div class="controls">
                                                                                @if($option->parent)
                                                                                    <p class="form-control-static">
                                                                                        <span class="badge badge-secondary">{{ $option->parent->name }}</span>
                                                                                    </p>
                                                                                @else
                                                                                    <p class="form-control-static text-muted">-</p>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.option_type') }}</label>
                                                                            <div class="controls">
                                                                                @if($option->is_parent)
                                                                                    <span class="badge badge-info">{{ __('admin.parent_option') }}</span>
                                                                                @elseif($option->is_child)
                                                                                    <span class="badge badge-secondary">{{ __('admin.child_option') }}</span>
                                                                                @else
                                                                                    <span class="badge badge-light">{{ __('admin.standalone_option') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.status') }}</label>
                                                                            <div class="controls">
                                                                                @if ($option->is_active)
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
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.short_description') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $option->short_description }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.description') }}</label>
                                                                            <div class="controls">
                                                                                <p class="form-control-static">{{ $option->description }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($option->is_parent && $option->children->count() > 0)
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>{{ __('admin.child_options') }}</label>
                                                                            <div class="controls">
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-striped">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>{{ __('admin.name') }}</th>
                                                                                                <th>{{ __('admin.price') }}</th>
                                                                                                <th>{{ __('admin.status') }}</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach($option->children as $child)
                                                                                            <tr>
                                                                                                <td>{{ $child->name }}</td>
                                                                                                <td>{{ $child->formatted_price }}</td>
                                                                                                <td>
                                                                                                    @if ($child->is_active)
                                                                                                        <span class="badge badge-success">{{ __('admin.activate') }}</span>
                                                                                                    @else
                                                                                                        <span class="badge badge-danger">{{ __('admin.dis_activate') }}</span>
                                                                                                    @endif
                                                                                                </td>
                                                                                            </tr>
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
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
    <a href="{{ route('admin.options.edit', $option->id) }}" class="btn btn-primary mr-1 mb-1">
        <i class="feather icon-edit"></i> {{ __('admin.edit') }}
    </a>
    <a href="{{ route('admin.options.index') }}" class="btn btn-outline-warning mr-1 mb-1">
        <i class="feather icon-arrow-left"></i> {{ __('admin.back') }}
    </a>
</div>

@endsection
