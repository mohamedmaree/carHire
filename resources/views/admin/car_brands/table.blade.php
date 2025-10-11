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
            <th>{{ __('admin.logo')}}</th>
            <th>{{__('admin.name')}}</th>
            <th>{{__('admin.sort_order')}}</th>
            <th>{{__('admin.status')}}</th>
            <th>{{__('admin.control')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($carBrands as $carBrand)
            <tr class="delete_row">
                <td class="text-center">
                    <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{$carBrand->id}}">
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td>
                    @if($carBrand->logo)
                        <img src="{{$carBrand->logo}}" width="30px" alt="{{$carBrand->name}}">
                    @else
                        <span class="text-muted">{{__('admin.no_image')}}</span>
                    @endif
                </td>
                <td>{{$carBrand->name}}</td>
                <td>{{$carBrand->sort_order}}</td>
                <td>
                    {!! toggleBooleanView($carBrand , route('admin.model.active' , ['model' =>'CarBrand' , 'id' => $carBrand->id , 'action' => 'is_active'])) !!}
                </td>
                <td class="product-action">
                    @can('read-car-brand')
                        <span class="text-primary"><a
                                    href="{{ route('admin.car_brands.show', ['car_brand' => $carBrand->id]) }}"
                                    class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                    @endcan
                    @can('update-car-brand')
                        <span class="text-primary"><a
                                    href="{{ route('admin.car_brands.edit', ['car_brand' => $carBrand->id]) }}"
                                    class="btn btn-primary btn-sm"><i class="feather icon-edit"></i> {{ __('admin.edit') }}</a></span>
                    @endcan
                    @can('delete-car-brand')
                        <span class="delete-row btn btn-danger btn-sm"
                              data-url="{{ url('admin/car_brands/' . $carBrand->id) }}"><i
                                    class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($carBrands->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($carBrands->count() > 0 && $carBrands instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$carBrands->links()}}
    </div>
@endif
{{-- pagination  links div --}}
