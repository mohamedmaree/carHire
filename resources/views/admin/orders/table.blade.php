<div class="position-relative">
    {{-- table loader  --}}
    {{-- <div class="table_loader" >
        {{__('admin.loading')}}
    </div> --}}
    {{-- table loader  --}}

    {{-- table content --}}
    <table class="table " id="tab">
        <thead>
        <tr>
            <th>
                <label class="container-checkbox">
                    <input type="checkbox" value="value1" name="name1" id="checkedAll">
                    <span class="checkmark"></span>
                </label>
            </th>
            <th>#</th>
            <th>{{ __('admin.full_name')}}</th>
            <th>{{ __('admin.car')}}</th>
            <th>{{ __('admin.pickup_location')}}</th>
            <th>{{ __('admin.return_location')}}</th>
            <th>{{ __('admin.pickup_date')}}</th>
            <th>{{ __('admin.return_date')}}</th>
            <th>{{ __('admin.rental_days')}}</th>
            <th>{{ __('admin.total_amount')}}</th>
            <th>{{ __('admin.order_status')}}</th>
            <th>{{ __('admin.payment_status')}}</th>
            <th>{{ __('admin.client_signature')}}</th>
            <th>{{ __('admin.status')}}</th>
            <th>{{ __('admin.control')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr class="delete_row">
                <td class="text-center">
                    <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $order->id }}">
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td>{{$order->id}}</td>
                <td>{{$order->full_name}}</td>
                <td>
                    @if($order->car)
                        <div class="d-flex align-items-center">
                            @if($order->car->image)
                                <img src="{{$order->car->image}}" alt="{{$order->car->name}}" class="img-thumbnail" style="width: 40px; height: 40px; margin-right: 10px;">
                            @endif
                            <span>{{$order->car->name}}</span>
                        </div>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    @if($order->pickupLocation)
                        <span class="badge badge-info">{{$order->pickupLocation->name}}</span>
                    @elseif($order->pickup_address)
                        <span class="text-muted">{{Str::limit($order->pickup_address, 30)}}</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    @if($order->same_return_location)
                        <span class="badge badge-success">@lang('admin.same_return_location')</span>
                    @elseif($order->returnLocation)
                        <span class="badge badge-info">{{$order->returnLocation->name}}</span>
                    @elseif($order->return_address)
                        <span class="text-muted">{{Str::limit($order->return_address, 30)}}</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>{{$order->pickup_date ? $order->pickup_date->format('Y-m-d') : '-'}}</td>
                <td>{{$order->return_date ? $order->return_date->format('Y-m-d') : '-'}}</td>
                <td>
                    <span class="badge badge-primary">{{$order->rental_days}} @lang('admin.days')</span>
                </td>
                <td>
                    <strong class="text-success">{{$order->formatted_total_amount}}</strong>
                </td>
                <td>
                    <span class="badge {{$order->order_status?->getBadgeClass()}}">{{$order->order_status?->getLabel()}}</span>
                </td>
                <td>
                    <span class="badge {{$order->payment_status?->getBadgeClass()}}">{{$order->payment_status?->getLabel()}}</span>
                </td>
                <td>
                    @if($order->client_signature)
                        <span class="badge badge-success">
                            <i class="feather icon-check"></i> @lang('admin.has_signature')
                        </span>
                    @else
                        <span class="badge badge-secondary">
                            <i class="feather icon-x"></i> @lang('admin.no_signature')
                        </span>
                    @endif
                </td>
                <td>
                    @if ($order->is_active)
                        <span class="btn btn-sm round btn-outline-success">
                            {{ __('admin.activate') }} <i class="la la-check font-medium-2"></i>
                        </span>
                    @else
                        <span class="btn btn-sm round btn-outline-danger">
                            {{ __('admin.dis_activate') }} <i class="la la-close font-medium-2"></i>
                        </span>
                    @endif
                </td>

                <td class="product-action">
                    @can('read-order')
                        <span class="text-primary"><a href="{{ route('admin.orders.show', ['order' => $order->id]) }}"
                                                      class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                    @endcan
                    @can('update-order')
                        <span class="action-edit text-primary"><a
                                    href="{{ route('admin.orders.edit', ['order' => $order->id]) }}"
                                    class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                    @endcan
                    @can('delete-order')
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ route('admin.orders.destroy', ['order' => $order->id]) }}"><i
                                    class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($orders->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($orders->count() > 0 && $orders instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$orders->links()}}
    </div>
@endif
{{-- pagination  links div --}}
