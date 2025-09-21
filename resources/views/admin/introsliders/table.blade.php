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
            <th>{{__('admin.address')}}</th>
            <th>{{__('admin.control')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sliders as $slider)
            <tr class="delete_slider">
                <td class="text-center">
                    <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{$slider->id}}">
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td><img src="{{$slider->image}}" width="30px" alt=""></td>
                <td>{{$slider->title}}</td>
                <td class="product-action">

                    @can('read-intro-slider')
                        <span class="text-primary">
                            <a href="{{ route('admin.introsliders.show', ['introslider' => $slider->id]) }}"
                               class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}
                            </a>
                        </span>
                    @endcan

                    @can('update-intro-slider')
                        <span class="action-edit text-primary"><a
                                    href="{{ route('admin.introsliders.edit', ['introslider' => $slider->id]) }}"
                                    class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                    @endcan

                    @can('delete-intro-slider')
                        <span class="delete-row btn btn-danger btn-sm"
                              data-url="{{ url('admin/introsliders/' . $slider->id) }}"><i
                                    class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    @endcan

                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($sliders->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($sliders->count() > 0 && $sliders instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$sliders->links()}}
    </div>
@endif
{{-- pagination  links div --}}