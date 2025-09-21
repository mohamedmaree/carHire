@extends('admin.layout.master')

@section('content')
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
                          {{-- <li class="nav-item" style="margin-top: 3px">
                              <a class="nav-link d-flex py-75" id="tab-pill-2" data-toggle="pill"
                                 href="#tab-2" aria-expanded="false">
                                  <i class="feather icon-edit mr-50 font-medium-3"></i>
                                sample 2
                              </a>
                          </li> --}}

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
                                                            <form  class="store form-horizontal" novalidate>
                                                          @csrf
                                                          @method('PUT')
                                                          <div class="form-body">
                                                            <div class="row">

                                                              <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                  <label for="first-name-column">{{ __('admin.name') }}</label>
                                                                  <div class="controls">
                                                                    <input type="text" name="name" value="{{ $admin->name }}"
                                                                          class="form-control"
                                                                          placeholder="{{ __('admin.enter_the_name') }}" required
                                                                          data-validation-required-message="{{ __('admin.this_field_is_required')  }}">
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">{{__('admin.phone_number')}}</label>
                                                                    <div class="row">
                                                                        <div class="col-md-9 col-12">
                                                                            <div class="controls">
                                                                                <input type="number" name="phone" value="{{$admin->phone}}"  class="form-control" placeholder="{{__('admin.enter_phone_number')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" data-validation-number-message="{{__('admin.the_phone_number_ must_not_have_charachters_or_symbol')}}"  >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3 col-12">
                                                                            <select name="country_code" class="form-control select2">
                                                                                @foreach($countries as $country)
                                                                                    <option value="{{ $country->key }}"
                                                                                        @if ($admin->country_code == $country->key)
                                                                                            selected
                                                                                        @endif >
                                                                                    {{ $country->key.'+' }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                              <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                  <label
                                                                        for="first-name-column">{{ __('admin.email') }}</label>
                                                                  <div class="controls">
                                                                    <input type="email" name="email" value="{{ $admin->email }}"
                                                                          class="form-control"
                                                                          placeholder="{{ __('admin.enter_the_email')  }}"
                                                                          required
                                                                          data-validation-required-message="{{ __('admin.this_field_is_required')  }}"
                                                                          data-validation-email-message="{{__('admin.email_formula_is_incorrect')}}">
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                  <label
                                                                        for="first-name-column">{{  __('admin.password') }}</label>
                                                                  <div class="controls">
                                                                    <input type="password" name="password" class="form-control">
                                                                  </div>
                                                                </div>
                                                              </div>

                                                              <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                  <label for="first-name-column">{{  __('admin.Validity') }}</label>
                                                                  <div class="controls">
                                                                    <select name="role_id" class="select2 form-control" required
                                                                            data-validation-required-message="{{ __('admin.this_field_is_required')  }}">
                                                                      @foreach ($roles as $role)
                                                                        <option {{ $role->id == $admin->role_id ? 'selected' : '' }}
                                                                                value="{{ $role->id }}">{{ $role->name }}
                                                                        </option>
                                                                      @endforeach
                                                                    </select>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">{{__('admin.ban_status')}} :</label>
                                                                    {{-- <div class="controls"> --}}
                                                                        <label class="switch">
                                                                            <input name="is_blocked" type="checkbox" value="1" {{$admin->is_blocked == 1 ? 'checked' : ''}}/>
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    {{-- </div> --}}
                                                                </div>
                                                            </div>
                                                            
                                                              <div class="col-12 d-flex justify-content-center mt-3">
                                                                <a href="{{ url()->previous() }}" type="reset"
                                                                  class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back') }}</a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                      </form>

                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              {{-- <div role="tabpanel" class="tab-pane" id="tab-2"
                                  aria-labelledby="tab-pill-2" aria-expanded="false">
                                  2
                              </div> --}}
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

@endsection

@section('js')
  <script>
    $('.store input').attr('disabled', true)
    $('.store textarea').attr('disabled', true)
    $('.store select').attr('disabled', true)
  </script>
@endsection
