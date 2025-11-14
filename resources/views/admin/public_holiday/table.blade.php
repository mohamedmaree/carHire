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
            <th>{{__('admin.public_holiday_name')}}</th>
            <th>{{__('admin.date')}}</th>
            <th>{{__('admin.year')}}</th>
            <th>{{__('admin.status')}}</th>
            <th>{{__('admin.control')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($publicHolidays as $publicHoliday)
            <tr class="delete_row">
                <td class="text-center">
                    <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $publicHoliday->id }}">
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td>{{ $publicHoliday->name }}</td>
                <td>{{ $publicHoliday->date ? $publicHoliday->date->format('Y-m-d') : '-' }}</td>
                <td>{{ $publicHoliday->year }}</td>
                <td>
                    @if ($publicHoliday->is_active)
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
                    @can('read-public-holiday')
                        <span class="text-primary"><a href="{{ route('admin.public-holidays.show', ['public_holiday' => $publicHoliday->id]) }}"
                                                      class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                    @endcan
                    @can('update-public-holiday')
                        <span class="action-edit text-primary"><a
                                    href="{{ route('admin.public-holidays.edit', ['public_holiday' => $publicHoliday->id]) }}"
                                    class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                    @endcan
                    @can('delete-public-holiday')
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ route('admin.public-holidays.destroy', ['public_holiday' => $publicHoliday->id]) }}"><i
                                    class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($publicHolidays->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($publicHolidays->count() > 0 && $publicHolidays instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$publicHolidays->links()}}
    </div>
@endif
{{-- pagination  links div --}}

