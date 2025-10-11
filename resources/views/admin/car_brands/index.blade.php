@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/index_page.css')}}">
@endsection

@section('content')

<x-admin.table 
    datefilter="true" 
    order="true" 
    extrabuttons="true"
    addbutton="{{ route('admin.car_brands.create') }}" 
    deletebutton="{{ route('admin.car_brands.deleteAll') }}" 
    :searchArray="[
        'name' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.name') , 
        ] ,
        'is_active' => [
            'input_type' => 'select'          , 
            'input_name' => __('admin.status') , 
            'rows'       => [
                ['id' => 1, 'name' => __('admin.active')],
                ['id' => 0, 'name' => __('admin.inactive')]
            ] , 
        ] ,
    ]" 
>

    <x-slot name="extrabuttonsdiv">
        <!-- Additional buttons can be added here -->
    </x-slot>

    <x-slot name="tableContent">
        <div class="table_content_append card">

        </div>
    </x-slot>

</x-admin.table>

@endsection

@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => route('admin.car_brands.index')])
@endsection
