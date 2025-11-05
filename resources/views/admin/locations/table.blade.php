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
            <th>{{__('admin.name')}}</th>
            <th>{{__('admin.address')}}</th>
            <th>{{ __('admin.toll_delivery_fees') }}</th>
            <th>{{__('admin.type')}}</th>
            <th>{{__('admin.coordinates')}}</th>
            <th>{{__('admin.working_hours')}}</th>
            <th>{{__('admin.status')}}</th>
            <th>{{__('admin.control')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($locations as $location)
            <tr class="delete_row">
                <td class="text-center">
                    <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $location->id }}">
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td>{{ $location->name }}</td>
                <td>{{ Str::limit($location->address, 50) }}</td>
                <td>{{ $location->toll_delivery_fees }}</td>
                <td>
                    @if($location->type == 'airport')
                        <span class="badge badge-primary">{{ __('admin.airport') }}</span>
                    @else
                        <span class="badge badge-info">{{ __('admin.location_type') }}</span>
                    @endif
                </td>
                <td>
                    <small>
                        {{ __('admin.lat') }}: {{ $location->lat }}<br>
                        {{ __('admin.lng') }}: {{ $location->lng }}
                    </small>
                </td>
                <td>{{ $location->working_hours }}</td>
                <td>
                    @if ($location->is_active)
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
                    @can('read-location')
                        <span class="text-primary"><a href="{{ route('admin.locations.show', ['location' => $location->id]) }}"
                                                      class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                    @endcan
                    @can('update-location')
                        <span class="action-edit text-primary"><a
                                    href="{{ route('admin.locations.edit', ['location' => $location->id]) }}"
                                    class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                    @endcan
                    @can('delete-location')
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ route('admin.locations.destroy', ['location' => $location->id]) }}"><i
                                    class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($locations->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($locations->count() > 0 && $locations instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$locations->links()}}
    </div>
@endif
{{-- pagination  links div --}}