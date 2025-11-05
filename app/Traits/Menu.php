<?php

namespace App\Traits;

trait Menu {
  public function home() {

    $menu = [
      [
        'name'  => __('admin.admins.index'),
        'count' => \App\Models\Admin::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/admins'),
      ], [
        'name'  => __('admin.users.index'),
        'count' => \App\Models\User::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients'),
      ], [
        'name'  => __('admin.active_users'),
        'count' => \App\Models\User::where('active', 1)->count(),
        'icon'  => 'icon-users',
        'url'   => route('admin.clients.index',['active' => 1]),
      ], [
        'name'  =>  __('admin.dis_active_users'),
        'count' => \App\Models\User::where('active', 0)->count(),
        'icon'  => 'icon-users',
        'url'   => route('admin.clients.index', ['active' => 0 ]),
      ], [
        'name'  => __('admin.Unspoken_users'),
        'count' => \App\Models\User::where('is_blocked', 0)->count(),
        'icon'  => 'icon-users',
        'url'   => route('admin.clients.index',['is_blocked' => 0]),
      ], [
        'name'  => __('admin.Prohibited_users'),
        'count' => \App\Models\User::where('is_blocked', 1)->count(),
        'icon'  => 'icon-users',
        'url'   => route('admin.clients.index',['is_blocked' => 1]),
      ], 
      [
        'name'  => __('admin.complaints_and_proposals'),
        'count' => \App\Models\Complaint::count(),
        'icon'  => 'icon-list',
        'url'   => route('admin.complaints.index'),
      ], [
        'name'  => __('admin.reports.index'),
        'count' => \App\Models\LogActivity::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/reports'),
      ], [
        'name'  => __('admin.countries.index'),
        'count' => \App\Models\Country::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/countries'),
      ],
      [
        'name'  => __('admin.regions.index'),
        'count' => \App\Models\Region::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/regions'),
      ],
      [
        'name'  => __('admin.cities.index'),
        'count' => \App\Models\City::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/cities'),
      ], [
        'name'  => __("admin.common_questions"),
        'count' => \App\Models\Fqs::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/fqs'),
      ], [
        'name'  => __('admin.definition_pages'),
        'count' => \App\Models\Intro::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/intros'),
      ], [
        'name'  => __('admin.advertising_banners'),
        'count' => \App\Models\Image::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/images'),
      ],
      [
        'name'  => __('admin.blogs.index'),
        'count' => \App\Models\Blog::count(),
        'icon'  => 'icon-book-open',
        'url'   => route('admin.blogs.index'),
      ],
      [
        'name'  => __('admin.cars.index'),
        'count' => \App\Models\Car::count(),
        'icon'  => 'icon-car',
        'url'   => route('admin.cars.index'),
      ],
      [
        'name'  => __('admin.locations.index'),
        'count' => \App\Models\Location::count(),
        'icon'  => 'icon-map-pin',
        'url'   => route('admin.locations.index'),
      ],
      [
        'name'  => __('admin.offers.index'),
        'count' => \App\Models\Offer::count(),
        'icon'  => 'icon-tag',
        'url'   => route('admin.offers.index'),
      ],
      [
        'name'  => __('admin.options.index'),
        'count' => \App\Models\Option::count(),
        'icon'  => 'icon-list',
        'url'   => route('admin.options.index'),
      ],
      [
        'name'  => __('admin.orders.index'),
        'count' => \App\Models\Order::count(),
        'icon'  => 'icon-shopping-cart',
        'url'   => route('admin.orders.index'),
      ],
      [
        'name'  => __('admin.price-packages.index'),
        'count' => \App\Models\PricePackage::count(),
        'icon'  => 'icon-dollar-sign',
        'url'   => route('admin.price-packages.index'),
      ],
      [
        'name'  => __('admin.Validities'),
        'count' => \App\Models\Role::count(),
        'icon'  => 'icon-eye',
        'url'   => url('admin/roles'),
      ],
    ];

    return $menu;
  }

  public function introSiteCards() {
    $menu = [
 /*     [
        'name'  => __('admin.insolder'),
        'count' => \App\Models\IntroSlider::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introsliders'),
      ],*/
      [
        'name'  => __('admin.Service_Suite'),
        'count' => \App\Models\IntroService::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introservices'),
      ],
      [
        'name'  => __('admin.questions_sections'),
        'count' => \App\Models\IntroFqsCategory::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introfqscategories'),
      ],
      [
        'name'  => __('admin.common_questions'),
        'count' => \App\Models\IntroFqs::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introfqs'),
      ],
      [
        'name'  => __('admin.Success_Partners'),
        'count' => \App\Models\IntroPartener::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introparteners'),
      ],
      [
        'name'  => __('admin.Customer_messages'),
        'count' => \App\Models\IntroMessages::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/intromessages'),
      ],
      [
        'name'  => __('admin.socials.index'),
        'count' => \App\Models\IntroSocial::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introsocials'),
      ],
  /*    [
        'name'  => __('admin.how_the_site_works_section'),
        'count' => \App\Models\IntroHowWork::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introhowworks'),
      ],*/
    ];
    return $menu;
  }

}