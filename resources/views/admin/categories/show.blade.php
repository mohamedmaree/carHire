@extends('admin.layout.master')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endsection
@section('content')
<form class="store form-horizontal">
        <div class="content-body">
            <section id="dashboard-ecommerce">
                <div class="content-body">
                    <!-- account setting page start -->
                    <section id="page-account-settings">
                        <div class="row">
                            <!-- left menu section -->
                            <div class="col-md-3 mb-2 mb-md-0">
                                <ul class="nav nav-pills flex-column mt-md-0 mt-1 card card-body">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex py-75 active" id="tab-pill-1" data-toggle="pill"
                                           href="#tab-1" aria-expanded="true">
                                            <i class="feather icon-globe mr-50 font-medium-3"></i>
                                            @lang('site.general_details')
                                        </a>
                                    </li>
                                    <li class="nav-item" style="margin-top: 3px">
                                        <a class="nav-link d-flex py-75" id="tab-pill-2" data-toggle="pill"
                                           href="#tab-2" aria-expanded="false">
                                            <i class="feather icon-list mr-50 font-medium-3"></i>
                                            {{__('admin.main_section')}}
                                        </a>
                                    </li>
        
                                </ul>
                            </div>
                            <!-- right content section -->
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="tab-content">
        
                                                <div role="tabpanel" class="tab-pane active" id="tab-1"
                                                     aria-labelledby="tab-pill-1" aria-expanded="true">
                                                    <div class="row">
                                                        <div class="col-3 ">
                                                            @lang('site.general_details')
                                                        </div>
                                                        <div class="col-9 ">
                                                            <div class="card">
                                                                {{-- <div class="card-header">
                                                                    <h4 class="card-title">{{__('admin.add') . ' ' . __('admin.copy')}}</h4>
                                                                </div> --}}
                                                                <div class="card-content">
                                                                    <div class="card-body">
    
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                        
                                                                            <div class="col-12">
                                                                                <div class="col-12">
                                                                                    <ul class="nav nav-tabs mb-3">
                                                                                        @foreach (languages() as $lang)
                                                                                            <li class="nav-item">
                                                                                                <a class="nav-link @if($loop->first) active @endif"  data-toggle="pill" href="#first_{{$lang}}" aria-expanded="true">{{  __('admin.data') }} {{ $lang }}</a>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div> 
    
                                                                                <div class="col-12 card card-body">
                                                                                    <div class="imgMontg col-12 text-center">
                                                                                        <div class="dropBox">
                                                                                            <div class="textCenter">
                                                                                                <div class="imagesUploadBlock">
                                                                                                    <label class="uploadImg">
                                                                                                        <span><i class="feather icon-image"></i></span>
                                                                                                        <input type="file" accept="image/*" name="image" class="imageUploader">
                                                                                                    </label>
                                                                                                    <div class="uploadedBlock">
                                                                                                        <img src="{{$category->image}}">
                                                                                                        <button class="close"><i class="la la-times"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
    
                                                                                <div class="tab-content">
                                                                                    @foreach (languages() as $lang)
                                                                                        <div role="tabpanel" class="tab-pane fade @if($loop->first) show active @endif " id="first_{{$lang}}" aria-labelledby="first_{{$lang}}" aria-expanded="true">
                                                                                            <div class="col-md-12 col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="first-name-column">{{__('admin.name')}} {{ $lang }}</label>
                                                                                                    <div class="controls">
                                                                                                        <input type="text" value="{{$category->getTranslations('name')[$lang]??''}}" name="name[{{$lang}}]" class="form-control" placeholder="{{__('admin.write') . __('admin.name')}} {{ $lang }}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
    
                                                                                
                                                                        
                                                                            </div>
    
                                                                            
    
    
    
                                                                            <div class="col-12 d-flex justify-content-center mt-3">
                                                                                <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div role="tabpanel" class="tab-pane" id="tab-2" aria-labelledby="tab-pill-2" aria-expanded="false">
                                                    <div class="row">
                                                        <div class="col-3 ">
                                                            @lang('admin.main_section')
                                                        </div>
                                                        <div class="col-9 ">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">{{__('admin.select_main_section')}}</label>
                                                                    <input type="hidden" name="parent_id" id="root_category" value="{{ $category->parent_id }}">
                                                                        <div class="col-md-12 col-12" id="category_level">
                                                                            <div id="jstree">
                                                                                @include('admin.categories.edit_tree',['mainCategories' => $categories])
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="col-12 d-flex justify-content-center mt-3">
                                                            <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                                        </div>
                                                    </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- account setting page end -->
        </div>
    </section>
    </div>
    </form>
    
@endsection

@section('js')
    <script>
        $('.store input').attr('disabled', true)
        $('.store textarea').attr('disabled', true)
        $('.store select').attr('disabled', true)

    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script type="text/javascript">
    $(function () {

        $('#jstree').jstree({
            checkbox : {
                // keep_selected_style : true,
                // two_state : false,
                three_state: false,
                // whole_node :false,
                // "cascade":"down",
            },
            plugins : [ "checkbox" ],
            core: {
                multiple: false,
            }
        });

        $('#jstree').on("changed.jstree", function (e, data) {
            $('#root_category').val(data.selected);
        });

    });
</script>
@endsection