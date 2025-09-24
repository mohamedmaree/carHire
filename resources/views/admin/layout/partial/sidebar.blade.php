<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{url('admin/dashboard')}}">
                    <img class="brand-logo img-logo" src="{{$settings['side_logo']}}" alt="">
                </a>
            </li>
            <li class="nav-item nav-toggle">
                {{-- <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a> --}}
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


            <li class="nav-item  @if(Route::currentRouteName() == 'admin.dashboard') active @endif ">
                <a href="{{route('admin.dashboard')}}">
                    <i class="feather icon-home"></i>
                    <span class="menu-title"
                          data-i18n="Dashboard">@lang('admin.main_page') </span>
                    <span class="link-text d-flex align-items-center"></span>
                </a>
            </li>

            <li class="nav-item has-sub sidebar-group-active open">
                <a href="javascript:void(0);">
                    <i class="feather icon-users"></i><span
                            class="menu-title" data-i18n="Dashboard">@lang('admin.users.index')</span></a>

                <ul class="menu-content" style="">

                    @can('read-all-user')
                        <li  class="nav-item  @if(Route::currentRouteName() == 'admin.clients.index') active @endif " >
                            <a href="{{route('admin.clients.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.clients.index')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-admin')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.admins.index') active @endif " >
                            <a href="{{route('admin.admins.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.admins.index')
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="nav-item has-sub sidebar-group-active open"><a href="javascript:void(0);">
                    <i class="feather icon-list"></i><span
                            class="menu-title" data-i18n="Dashboard">@lang('admin.project')</span></a>
                <ul class="menu-content" style="">


                    @can('read-all-transaction')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.transactions-reports.index') active @endif " >
                            <a href="{{route('admin.transactions-reports.index')}}">
                                <i class="feather icon-circle"></i>
                                @lang('admin.admin_financial_reports')
                            </a>
                        </li>
                    @endcan


                    @can('read-all-category')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.categories.index') active @endif " >
                            <a href="{{route('admin.categories.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.sections')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-settlement')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.settlements.index') active @endif " >
                            <a href="{{route('admin.settlements.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.Settlement_requests')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-car')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.cars.index') active @endif " >
                            <a href="{{route('admin.cars.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.cars.index')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-price-package')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.price-packages.index') active @endif " >
                            <a href="{{route('admin.price-packages.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.price-packages.index')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-option')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.options.index') active @endif " >
                            <a href="{{route('admin.options.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.options.index')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-location')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.locations.index') active @endif " >
                            <a href="{{route('admin.locations.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.locations.index')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-blog')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.blogs.index') active @endif " >
                            <a href="{{route('admin.blogs.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.blogs.index')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-order')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.orders.index') active @endif " >
                            <a href="{{route('admin.orders.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.orders.index')
                            </a>
                        </li>
                    @endcan

                    {{--#new_comand_side_bar_element_here--}}
                </ul>

            </li>
            <li class="nav-item has-sub sidebar-group-active open"><a href="javascript:void(0);">
                    <i class="feather icon-flag"></i><span
                            class="menu-title" data-i18n="Dashboard">@lang('admin.marketing')</span></a>
                <ul class="menu-content" style="">

                    @can('read-all-notification')
                        <li  class="nav-item  @if(Route::currentRouteName() == 'admin.notifications.index') active @endif " >
                            <a href="{{route('admin.notifications.index')}}">
                                <i class="feather icon-circle"></i>
                                @lang('admin.notifications.index')
                            </a>
                        </li>
                    @endcan


                    @can('read-all-coupon')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.coupons.index') active @endif " >
                            <a href="{{route('admin.coupons.index')}}">
                                <i class="feather icon-circle"></i>
                                @lang('admin.coupons.index')
                            </a>
                        </li>
                    @endcan


                    @can('read-all-image')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.images.index') active @endif " >
                            <a href="{{route('admin.images.index')}}">
                                <i class="feather icon-circle"></i>
                                {{trans('admin.advertising_banners')}}
                            </a>
                        </li>
                    @endcan

                    @can('read-all-intro')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.intros.index') active @endif " >
                            <a href="{{route('admin.intros.index')}}">
                                <i class="feather icon-circle"></i>
                                {{trans('admin.intros.index')}}
                            </a>
                        </li>
                    @endcan

                     <li  class="nav-item  @if(Route::currentRouteName() == 'admin.statistics.index') active @endif " >
                        <a href="{{route('admin.statistics.index')}}">
                            <i class="feather icon-circle"></i>@lang('admin.Statistics')
                        </a>
                    </li>

                    @can('read-app-home')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.apphomes.index') active @endif " >
                            <a href="{{route('admin.apphomes.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.apphomes.index')
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

            <li class="nav-item has-sub"><a href="javascript:void(0);">
                    <i class="fa fa-map-marker"></i><span
                            class="menu-title" data-i18n="Dashboard">@lang('admin.countries_cities')</span></a>
                <ul class="menu-content" style="">

                    @can('read-all-country')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.countries.index') active @endif " >
                            <a href="{{route('admin.countries.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.countries.index')
                            </a>
                        </li>
                    @endcan
                    @can('read-all-region')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.regions.index') active @endif " >
                            <a href="{{route('admin.regions.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.regions.index')

                            </a>
                        </li>
                    @endcan


                    @can('read-all-city')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.cities.index') active @endif " >
                            <a href="{{route('admin.cities.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.cities.index')

                            </a>
                        </li>
                    @endcan


                </ul>
            </li>

            <li class="nav-item has-sub"><a href="javascript:void(0);">

                    <i class="feather icon-settings"></i><span
                            class="menu-title" data-i18n="Dashboard">@lang('admin.setting')</span></a>
                <ul class="menu-content" style="">


                    @can('read-all-social')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.socials.index') active @endif " >
                            <a href="{{route('admin.socials.index')}}">
                                <i class="feather icon-circle"></i>
                                {{trans('admin.socials.index')}}
                            </a>
                        </li>
                    @endcan
                    @can('read-all-complaint')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.complaints.index') active @endif " >
                            <a href="{{route('admin.complaints.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.complaints_and_proposals')
                            </a>
                        </li>
                    @endcan
                    @can('read-all-role')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.roles.index') active @endif " >
                            <a href="{{route('admin.roles.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.Validities_list')
                            </a>
                        </li>
                    @endcan

                     <li  class="nav-item  @if(Route::currentRouteName() == 'admin.reports.index') active @endif " >
                        <a href="{{route('admin.reports.index')}}">
                            <i class="feather icon-circle"></i>@lang('admin.reports.index')
                        </a>
                    </li>

                    @can('read-all-dashboard-site-setting')
                         <li  class="nav-item  @if(Route::currentRouteName() == 'admin.settings.index') active @endif " >
                            <a href="{{route('admin.settings.index')}}">
                                <i class="feather icon-circle"></i>@lang('admin.setting')
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

            <li class="nav-item has-sub"><a href="javascript:void(0);">
                    <i class="feather icon-map"></i><span
                            class="menu-title" data-i18n="Dashboard">@lang('admin.introductory_site')</span></a>
                <ul class="menu-content" style="">

                    @can('read-all-intro-service')
                        <li class="is-shown @if(Route::currentRouteName() == 'admin.introservices.index') active @endif">
                            <a href="{{route('admin.introservices.index')}}">
                                <i class="feather icon-circle"> </i>@lang('admin.our_services')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-intro-slider')
                        <li class="is-shown @if(Route::currentRouteName() == 'admin.introsliders.index') active @endif">
                            <a href="{{route('admin.introsliders.index')}}">
                                <i class="feather icon-circle"></i> @lang('admin.insolder')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-intro-partener')
                        <li class="is-shown @if(Route::currentRouteName() == 'admin.introparteners.index') active @endif">
                            <a href="{{route('admin.introparteners.index')}}"><i
                                        class="feather icon-circle"></i>
                                @lang('admin.Success_Partners')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-intro-howworks')
                        <li class="is-shown @if(Route::currentRouteName() == 'admin.introhowworks.index') active @endif">
                            <a href="{{route('admin.introhowworks.index')}}"><i
                                        class="feather icon-circle"></i>
                                @lang('admin.introhowworks.index')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-seo')
                        <li class="is-shown @if(Route::currentRouteName() == 'admin.seos.index') active @endif">
                            <a href="{{route('admin.seos.index')}}"><i
                                        class="feather icon-circle"></i>
                                @lang('admin.seo.index')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-intro-messages')
                        <li class="is-shown @if(Route::currentRouteName() == 'admin.intromessages.index') active @endif">
                            <a href="{{route('admin.intromessages.index')}}"><i
                                        class="feather icon-circle"></i>
                                @lang('admin.Customer_messages')
                            </a>
                        </li>
                    @endcan

                    @can('read-all-intro-social')
                        <li class="is-shown @if(Route::currentRouteName() == 'admin.introsocials.index') active @endif">
                            <a href="{{route('admin.introsocials.index')}}"><i
                                        class="feather icon-circle"></i>
                                @lang('admin.socials.index')
                            </a>
                        </li>
                    @endcan
                    @can('read-all-intro-how-work')
                        <li class="is-shown @if(Route::currentRouteName() == 'admin.introhowworks.index') active @endif">
                            <a href="{{route('admin.introhowworks.index')}}"><i
                                        class="feather icon-circle"></i>
                                @lang('admin.how_the_site_works')
                            </a>
                        </li>
                    @endcan
                    @can('read-all-intro-fqs-category')
                        <li class="is-shown @if(Route::currentRouteName() == 'admin.introfqscategories.index') active @endif">
                            <a href="{{route('admin.introfqscategories.index')}}"><i
                                        class="feather icon-circle"></i>
                                @lang('admin.Common-questions_sections')
                            </a>
                        </li>
                    @endcan
                    @can('read-all-intro-fqs')
                        <li class="is-shown @if(Route::currentRouteName() == 'admin.introfqs.index') active @endif">
                            <a href="{{route('admin.introfqs.index')}}"><i
                                        class="feather icon-circle"></i>
                                @lang('admin.common_questions')
                            </a>
                        </li>
                    @endcan
                    @can('read-all-intro-site-setting')
                        <li class="is-shown @if(Route::currentRouteName() == 'admin.intro-settings.index') active @endif">
                            <a href="{{route('admin.intro-settings.index')}}">
                                <i class="feather icon-circle"> </i> @lang('admin.introductory_site_setting')
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </div>
</div>