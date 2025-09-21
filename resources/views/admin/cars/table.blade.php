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
            <th>{{ __('admin.image_')}}</th>
            <th>{{__('admin.name')}}</th>
            <th>{{__('admin.brand')}}</th>
            <th>{{__('admin.seats')}}</th>
            <th>{{__('admin.bags')}}</th>
            <th>{{__('admin.transmission')}}</th>
            <th>{{__('admin.price')}}</th>
            <th>{{__('admin.status')}}</th>
            <th>{{__('admin.control')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cars as $car)
            <tr class="delete_row">
                <td class="text-center">
                    <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $car->id }}">
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td><img src="{{$car->image}}" width="30px" alt=""></td>
                <td>{{ $car->name }}</td>
                <td>{{ $car->brand }}</td>
                <td>{{ $car->seats }}</td>
                <td>{{ $car->bags }}</td>
                <td>{{ $car->transmission_text }}</td>
                <td>{{ $car->formatted_price }}</td>
                <td>
                    @if ($car->is_active)
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
                    @can('read-car')
                        <span class="text-primary"><a href="{{ route('admin.cars.show', ['car' => $car->id]) }}"
                                                      class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                    @endcan
                    @can('update-car')
                        <span class="action-edit text-primary"><a
                                    href="{{ route('admin.cars.edit', ['car' => $car->id]) }}"
                                    class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                    @endcan
                    @can('delete-car')
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ route('admin.cars.destroy', ['car' => $car->id]) }}"><i
                                    class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($cars->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($cars->count() > 0 && $cars instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$cars->links()}}
    </div>
@endif
{{-- pagination  links div --}}
