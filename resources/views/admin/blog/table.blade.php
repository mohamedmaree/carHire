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
            <th>{{__('admin.image')}}</th>
            <th>{{__('admin.title')}}</th>
            <th>{{__('admin.author')}}</th>
            <th>{{__('admin.description')}}</th>
            <th>{{__('admin.status')}}</th>
            <th>{{__('admin.control')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($blogs as $blog)
            <tr class="delete_row">
                <td class="text-center">
                    <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{ $blog->id }}">
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td>
                    @if($blog->image)
                        <img src="{{$blog->image}}" width="50px" height="50px" alt="{{$blog->title}}" style="object-fit: cover; border-radius: 5px;">
                    @else
                        <i class="feather icon-image" style="font-size: 50px;"></i>
                    @endif
                </td>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->author }}</td>
                <td>{{ Str::limit(strip_tags($blog->description), 50) }}</td>
                <td>
                    @if ($blog->is_active)
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
                    @can('read-blog')
                        <span class="text-primary"><a href="{{ route('admin.blogs.show', ['blog' => $blog->id]) }}"
                                                      class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                    @endcan
                    @can('update-blog')
                        <span class="action-edit text-primary"><a
                                    href="{{ route('admin.blogs.edit', ['blog' => $blog->id]) }}"
                                    class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                    @endcan
                    @can('delete-blog')
                        <span class="delete-row btn btn-danger btn-sm" data-url="{{ route('admin.blogs.destroy', ['blog' => $blog->id]) }}"><i
                                    class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($blogs->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($blogs->count() > 0 && $blogs instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$blogs->links()}}
    </div>
@endif
{{-- pagination  links div --}}
