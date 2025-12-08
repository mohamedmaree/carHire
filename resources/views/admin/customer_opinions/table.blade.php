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
            <th>{{__('admin.opinion_text')}}</th>
            <th>{{__('admin.num_stars')}}</th>
            <th>{{__('admin.status')}}</th>
            <th>{{__('admin.control')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customerOpinions as $customerOpinion)
            <tr class="delete_customer_opinion">
                <td class="text-center">
                    <label class="container-checkbox">
                        <input type="checkbox" class="checkSingle" id="{{$customerOpinion->id}}">
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td><img src="{{$customerOpinion->image}}" width="50px" height="50px" style="border-radius: 50%; object-fit: cover;" alt=""></td>
                <td>{{$customerOpinion->name}}</td>
                <td>{{ Str::limit($customerOpinion->opinion_text, 50) }}</td>
                <td>
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $customerOpinion->num_stars)
                            <i class="feather icon-star text-warning"></i>
                        @else
                            <i class="feather icon-star"></i>
                        @endif
                    @endfor
                </td>
                <td>
                    @if ($customerOpinion->is_active)
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
                    @can('read-customer-opinion')
                        <span class="text-primary"><a href="{{ route('admin.customer-opinions.show', ['customer_opinion' => $customerOpinion->id]) }}"
                                                      class="btn btn-warning btn-sm"><i class="feather icon-eye"></i> {{ __('admin.show') }}</a></span>
                    @endcan
                    @can('update-customer-opinion')
                        <span class="action-edit text-primary"><a
                                    href="{{ route('admin.customer-opinions.edit', ['customer_opinion' => $customerOpinion->id]) }}"
                                    class="btn btn-primary btn-sm"><i class="feather icon-edit"></i>{{ __('admin.edit') }}</a></span>
                    @endcan
                    @can('delete-customer-opinion')
                        <span class="delete-row btn btn-danger btn-sm"
                              data-url="{{ url('admin/customer-opinions/' . $customerOpinion->id) }}"><i class="feather icon-trash"></i>{{ __('admin.delete') }}</span>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- table content --}}
    {{-- no data found div --}}
    @if ($customerOpinions->count() == 0)
        <div class="d-flex flex-column w-100 align-center mt-4">
            <img src="{{asset('admin/app-assets/images/pages/404.png')}}" alt="">
            <span class="mt-2" style="font-family: cairo">{{__('admin.there_are_no_matches_matching')}}</span>
        </div>
    @endif
    {{-- no data found div --}}

</div>
{{-- pagination  links div --}}
@if ($customerOpinions->count() > 0 && $customerOpinions instanceof \Illuminate\Pagination\AbstractPaginator )
    <div class="d-flex justify-content-center mt-3">
        {{$customerOpinions->links()}}
    </div>
@endif
{{-- pagination  links div --}}

