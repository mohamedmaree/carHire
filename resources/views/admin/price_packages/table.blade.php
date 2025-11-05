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
            <th>{{__('admin.car')}}</th>
            <th>{{__('admin.name')}}</th>
            <th>{{__('admin.price')}}</th>
            <th>{{__('admin.kilometer_limit')}}</th>
            <th>{{__('admin.kilometer_type')}}</th>
            <th>{{__('admin.status')}}</th>
            <th>{{__('admin.control')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pricePackages as $pricePackage)
            <tr class="delete_row">
                <td class="text-center">
                    <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $pricePackage->id }}">
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td>{{ $pricePackage->car->name??'' }}</td>
                <td>{{ $pricePackage->name }}</td>
                <td>{{ $pricePackage->formatted_price }}</td>
                <td>{{ $pricePackage->kilometer_limit_text }}</td>
                <td>
                    @if ($pricePackage->is_unlimited)
                        <span class="btn btn-sm round btn-outline-info">
                            {{ __('admin.unlimited') }} <i class="la la-infinity font-medium-2"></i>
                        </span>
                    @else
                        <span class="btn btn-sm round btn-outline-warning">
                            {{ __('admin.limited') }} <i class="la la-stop font-medium-2"></i>
                        </span>
                    @endif
                </td>
                <td>
                    @if ($pricePackage->is_active)
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
                    @can('read-price-package')
                        <span class="text-primary"><a href="{{ route('admin.price-packages.show', ['price_package' => $pricePackage->id]) }}"
                                                      class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                    @endcan
                    @can('update-price-package')
                        <span class="action-edit text-primary"><a
                                    href="{{ route('admin.price-packages.edit', ['price_package' => $pricePackage->id]) }}"
                                    class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                    @endcan
                    @can('delete-price-package')
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ route('admin.price-packages.destroy', ['price_package' => $pricePackage->id]) }}"><i
                                    class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($pricePackages->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($pricePackages->count() > 0 && $pricePackages instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$pricePackages->links()}}
    </div>
@endif
{{-- pagination  links div --}}
