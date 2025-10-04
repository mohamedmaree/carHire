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
            <th>{{ __('admin.icon')}}</th>
            <th>{{__('admin.name')}}</th>
            <th>{{__('admin.short_description')}}</th>
            <th>{{__('admin.description')}}</th>
            <th>{{__('admin.price')}}</th>
            <th>{{__('admin.price_type')}}</th>
            <th>{{__('admin.status')}}</th>
            <th>{{__('admin.control')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($options as $option)
            <tr class="delete_row">
                <td class="text-center">
                    <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $option->id }}">
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td>
                    @if($option->icon)
                        <img src="{{$option->icon}}" width="30px" alt="">
                    @else
                        <i class="feather icon-circle" style="font-size: 30px;"></i>
                    @endif
                </td>
                <td>{{ $option->name }}</td>
                <td>{{ Str::limit($option->short_description, 30) }}</td>
                <td>{{ Str::limit($option->description, 50) }}</td>
                <td>{{ $option->formatted_price }}</td>
                <td>{{ $option->price_type_text }}</td>
                <td>
                    @if ($option->is_active)
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
                    @can('read-option')
                        <span class="text-primary"><a href="{{ route('admin.options.show', ['option' => $option->id]) }}"
                                                      class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                    @endcan
                    @can('update-option')
                        <span class="action-edit text-primary"><a
                                    href="{{ route('admin.options.edit', ['option' => $option->id]) }}"
                                    class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                    @endcan
                    @can('delete-option')
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ route('admin.options.destroy', ['option' => $option->id]) }}"><i
                                    class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($options->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($options->count() > 0 && $options instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$options->links()}}
    </div>
@endif
{{-- pagination  links div --}}
