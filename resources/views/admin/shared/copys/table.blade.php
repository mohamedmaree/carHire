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
            <th>{{__('admin.email')}}</th>
            <th>{{__('admin.phone')}}</th>
            <th>{{__('admin.ban_status')}}</th>
            <th>{{__('admin.control')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($modelPluralSnakeCase as $modelSnakeCase)
            <tr class="delete_row">
                <td class="text-center">
                    <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $modelSnakeCase->id }}">
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td><img src="{{$modelSnakeCase->image}}" width="30px" alt=""></td>
                <td>{{ $modelSnakeCase->name }}</td>
                <td>{{ $modelSnakeCase->email }}</td>
                <td>{{ $modelSnakeCase->phone }}</td>
                <td>
                    @if ($modelSnakeCase->is_blocked)
                        <span class="btn btn-sm round btn-outline-danger">
                            {{ __('admin.Prohibited') }} <i class="la la-close font-medium-2"></i>
                        </span>
                    @else
                        <span class="btn btn-sm round btn-outline-success">
                            {{ __('admin.Unspoken') }} <i class="la la-check font-medium-2"></i>
                        </span>
                    @endif
                </td>

                <td class="product-action">
                    @can('read-modelKebabCase')
                        <span class="text-primary"><a href="{{ route('admin.modelKebabPluralName.show', ['modelSnakeCase' => $modelSnakeCase->id]) }}"
                                                      class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                    @endcan
                    @can('update-modelKebabCase')
                        <span class="action-edit text-primary"><a
                                    href="{{ route('admin.modelKebabPluralName.edit', ['modelSnakeCase' => $modelSnakeCase->id]) }}"
                                    class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                    @endcan
                    @can('delete-modelKebabCase')
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ route('admin.modelKebabPluralName.destroy', ['modelSnakeCase' => $modelSnakeCase->id]) }}"><i
                                    class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($modelPluralSnakeCase->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($modelPluralSnakeCase->count() > 0 && $modelPluralSnakeCase instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$modelPluralSnakeCase->links()}}
    </div>
@endif
{{-- pagination  links div --}}

