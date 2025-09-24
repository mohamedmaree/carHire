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
    addbutton="{{ route('admin.orders.create') }}"
    deletebutton="{{ route('admin.orders.deleteAll') }}"
    :searchArray="[
        'first_name' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.first_name') , 
        ] ,
        'last_name' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.last_name') , 
        ] ,
        'email' => [
            'input_type' => 'text' , 
            'input_name' => __('admin.email') , 
        ] ,
        'car_id' => [
            'input_type' => 'select' , 
            'rows'       => $cars->map(function($car) {
                return [
                    'name' => $car->name,
                    'id' => $car->id,
                ];
            })->toArray(),
            'input_name' => __('admin.car')  , 
        ] ,
        'order_status' => [
            'input_type' => 'select' , 
            'rows'       => collect(\App\Enums\OrderStatus::getOptions())->map(function($label, $value) {
                return [
                    'name' => $label,
                    'id' => $value,
                ];
            })->values()->toArray(),
            'input_name' => __('admin.order_status')  , 
        ] ,
        'payment_status' => [
            'input_type' => 'select' , 
            'rows'       => collect(\App\Enums\PaymentStatus::getOptions())->map(function($label, $value) {
                return [
                    'name' => $label,
                    'id' => $value,
                ];
            })->values()->toArray(),
            'input_name' => __('admin.payment_status')  , 
        ] ,
        'is_active' => [
            'input_type' => 'select' , 
            'rows'       => [
              '1' => [
                'name' => __('admin.activate') , 
                'id' => 1 , 
              ],
              '2' => [
                'name' => __('admin.dis_activate') , 
                'id' => 0 , 
              ],
            ] , 
            'input_name' => __('admin.status')  , 
        ] ,
    ]" 
>

    <x-slot name="extrabuttonsdiv">
        {{-- <a type="button" data-toggle="modal" data-target="#notify" class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light notify" data-id="all"><i class="feather icon-bell"></i> {{ __('admin.Send_notification') }}</a> --}}
    </x-slot>

    <x-slot name="tableContent">
        <div class="table_content_append card">
            {{-- table content will appends here  --}}
        </div>
    </x-slot>

</x-admin.table>

@endsection

@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    @include('admin.shared.deleteAll')
    @include('admin.shared.deleteOne')
    @include('admin.shared.filter_js' , [ 'index_route' => route('admin.orders.index') ])
@endsection
