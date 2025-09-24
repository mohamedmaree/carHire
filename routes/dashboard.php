<?php

use App\Http\Controllers\Admin\{AdminReportsController,
    NotificationController,
    RegionController,
    ReportController,
    RoleController,
    SeoController,
    SettingController,
    SettlementController,
    StatisticsController,
    AdminController,
    AppHomeController,
    AuthController,
    CategoryController,
    CityController,
    ClientController,
    ComplaintController,
    CountryController,
    CouponController,
    ExcelController,
    FqsController,
    HomeController,
    ImageController,
    SocialController,
    IntroController,
    IntroFqsCategoryController,
    IntroFqsController,
    IntroHowWorkController,
    IntroMessagesController,
    IntroPartenerController,
    IntroServiceController,
    IntroSetting,
    IntroSliderController,
    IntroSocialController,
    CarController,
    PricePackageController,
    OptionController,
    LocationController,
    BlogController,
    OrderController,
    #new_namespace_here
};

use Illuminate\Support\Facades\Route;

Route::group([ 'prefix' => 'admin', 'as' => 'admin.', ], function () {

    Route::get('/lang/{lang}', [ AuthController::class, 'SetLanguage' ]);
    Route::get('login', [ AuthController::class, 'showLoginForm' ])->name('show.login')->middleware('guest:admin');
    Route::post('login', [ AuthController::class, 'login' ])->name('login');
    Route::get('logout', [ AuthController::class, 'logout' ])->name('logout');
    Route::get('forget-password', [ AuthController::class, 'showForgetPasswordForm' ])->name('show.forget-password');
    Route::post('forget-password', [ AuthController::class, 'forgetPassword' ])->name('forget-password');
    Route::get('reset-password/{admin}', [ AuthController::class, 'showResetPasswordForm' ])->name('show.reset-password');
    Route::post('reset-password', [ AuthController::class, 'resetPassword' ])->name('reset-password');

    Route::group([ 'middleware' => [ 'check-role', 'admin-lang', 'auth:admin' ] ], function () {
        /*------------ profile----------*/
        Route::get('profile', [ HomeController::class, 'profile' ])->name('profile');
        Route::put('profile-update', [ HomeController::class, 'updateProfile' ])->name('profile.update');
        Route::put('profile-update-password', [ HomeController::class, 'updatePassword' ])->name('profile.update_password');
        /*------------ Dashboard----------*/
        Route::get('dashboard', [ HomeController::class, 'dashboard' ])->name('dashboard');
        /*------------ intro-settings----------*/
        Route::get('intro-settings', [ IntroSetting::class, 'index' ])->name('intro-settings.index');
        Route::put('settings', [ SettingController::class, 'update' ])->name('settings.update');
        Route::put('update-socials', [ SettingController::class, 'updateSocials' ])->name('settings.update-socials');
        
        /*------------ notifications ----------*/
        Route::get('show-notifications', [ AdminController::class, 'notifications' ])->name('admins.notifications');
        /*------------ roles ----------*/
        Route::post('delete-all-roles', [ RoleController::class, 'destroyAll' ])->name('roles.deleteAll');
        Route::resource('roles', RoleController::class);
        /*------------ introsliders ----------*/
        Route::post('delete-all-introsliders', [ IntroSliderController::class, 'destroyAll' ])->name('introsliders.deleteAll');
        Route::resource('introsliders', IntroSliderController::class);
        /*------------ introservices ----------*/
        Route::post('delete-all-introservices', [ IntroServiceController::class, 'destroyAll' ])->name('introservices.deleteAll');
        Route::resource('introservices', IntroServiceController::class);
        /*------------ introservices ----------*/
        Route::post('delete-all-introfqscategories', [ IntroFqsCategoryController::class, 'destroyAll' ])->name('introfqscategories.deleteAll');
        Route::resource('introfqscategories', IntroFqsCategoryController::class);
        /*------------ introservices ----------*/
        Route::post('delete-all-introfqs', [ IntroFqsController::class, 'destroyAll' ])->name('introfqs.deleteAll');
        Route::resource('introfqs', IntroFqsController::class);
        /*------------ introparteners ----------*/
        Route::post('delete-all-introparteners', [ IntroPartenerController::class, 'destroyAll' ])->name('introparteners.deleteAll');
        Route::resource('introparteners', IntroPartenerController::class);
        /*------------ intromessages ----------*/
        Route::post('delete-all-intromessages', [ IntroMessagesController::class, 'destroyAll' ])->name('intromessages.deleteAll');
        Route::resource('intromessages', IntroMessagesController::class);
        /*------------ introsocials ----------*/
        Route::post('delete-all-introsocials', [ IntroSocialController::class, 'destroyAll' ])->name('introsocials.deleteAll');
        Route::resource('introsocials', IntroSocialController::class);
        /*------------ introhowworks ----------*/
        Route::post('delete-all-introhowworks', [ IntroHowWorkController::class, 'destroyAll' ])->name('introhowworks.deleteAll');
        Route::resource('introhowworks', IntroHowWorkController::class);
        /*------------ clients ----------*/
        Route::post('delete-all-clients', [ ClientController::class, 'destroyAll' ])->name('clients.deleteAll');
        Route::post('delete-all-notify', [ ClientController::class, 'notify' ])->name('clients.notify');
        Route::get('delete-all-importFile', [ ClientController::class, 'importFile' ])->name('clients.importFile');
        Route::post('clients/update-balance', [ ClientController::class, 'updateBalance' ])->name('clients.updateBalance');
        Route::resource('clients', ClientController::class);
        /*------------ admins ----------*/
        Route::post('delete-all-admins', [ AdminController::class, 'destroyAll' ])->name('admins.deleteAll');
        Route::resource('admins', AdminController::class);
        /*------------ categories ----------*/
        Route::post('delete-all-categories', [ CategoryController::class, 'destroyAll' ])->name('categories.deleteAll');
        Route::resource('categories', CategoryController::class);
        /*------------ coupons ----------*/
        Route::post('renew-coupons', [ CouponController::class, 'renew' ])->name('coupons.renew');
        Route::post('delete-all-coupons', [ CouponController::class, 'destroyAll' ])->name('coupons.deleteAll');
        Route::resource('coupons', CouponController::class);
        /*------------ cities ----------*/
        Route::post('delete-all-cities', [ CityController::class, 'destroyAll' ])->name('cities.deleteAll');
        Route::get('get-country-regions', [ CityController::class, 'getCountryRegions' ])->name('cities.get-country-regions');
        Route::resource('cities', CityController::class);
        /*------------ settlements ----------*/
        Route::post('settlements-change-status', [ SettlementController::class, 'settlementChangeStatus' ])->name('settlements.changeStatus');
        Route::resource('settlements', SettlementController::class);
        /*------------ notifications ----------*/
        Route::get('notifications', [ NotificationController::class, 'index' ])->name('notifications.index');
        Route::post('delete-notifications', [ AdminController::class, 'deleteNotifications' ])->name('admins.notifications.delete');
        Route::post('send-notifications', [ NotificationController::class, 'sendNotifications' ])->name('notifications.send');
        /*------------ images ----------*/
        Route::post('delete-all-images', [ ImageController::class, 'destroyAll' ])->name('images.deleteAll');
        Route::resource('images', ImageController::class);
        /*------------ socials ----------*/
        Route::post('delete-all-socials', [ SocialController::class, 'destroyAll' ])->name('socials.deleteAll');
        Route::resource('socials', SocialController::class);
        /*------------ intros ----------*/
        Route::post('delete-all-intros', [ IntroController::class, 'destroyAll' ])->name('intros.deleteAll');
        Route::resource('intros', IntroController::class);
        /*------------ statistics ----------*/
        Route::get('statistics', [ StatisticsController::class, 'index' ])->name('statistics.index');
        /*------------ countries ----------*/
        Route::post('delete-all-countries', [ CountryController::class, 'destroyAll' ])->name('countries.deleteAll');
        Route::resource('countries', CountryController::class);
        /*------------ regions ----------*/
        Route::post('delete-all-regions', [ RegionController::class, 'destroyAll' ])->name('regions.deleteAll');
        Route::resource('regions', RegionController::class);
        /*------------ fqs ----------*/
        Route::post('delete-all-fqs', [ FqsController::class, 'destroyAll' ])->name('fqs.deleteAll');
        Route::resource('fqs', FqsController::class);
        /*------------ complaints ----------*/
        Route::post('delete-all-complaints', [ ComplaintController::class, 'destroyAll' ])->name('complaints.deleteAll');
        Route::resource('complaints', ComplaintController::class);
        /*------------ apphomes ----------*/
        Route::post('delete-all-apphomes', [ AppHomeController::class, 'destroyAll' ])->name('apphomes.deleteAll');
        Route::get('get-records-by-type', [ AppHomeController::class, 'getRecordsByType' ])->name('apphomes.get-records-by-type');
        Route::resource('apphomes', AppHomeController::class);
        /*------------ reports ----------*/
        Route::get('reports-deleteAll', [ ReportController::class, 'destroyAll' ])->name('reports.deleteAll');
        Route::resource('reports', ReportController::class);
        /*------------ seos ----------*/
        Route::get('seos-deleteAll', [ SeoController::class, 'destroyAll' ])->name('seos.deleteAll');
        Route::resource('seos', SeoController::class);

        /*------------ transactions ----------*/
        Route::get('transactions-reports', [ AdminReportsController::class, 'AdminFinancial' ])->name('transactions-reports.index');



        /*------------ settings ----------*/
        Route::get('settings', [ SettingController::class, 'index' ])->name('settings.index');



        /*------------ cars ----------*/
        Route::post('delete-all-cars', [ CarController::class, 'destroyAll' ])->name('cars.deleteAll');
        Route::resource('cars', CarController::class);
        /*------------ price-packages ----------*/
        Route::post('delete-all-price-packages', [ PricePackageController::class, 'destroyAll' ])->name('price-packages.deleteAll');
        Route::resource('price-packages', PricePackageController::class);
        /*------------ options ----------*/
        Route::post('delete-all-options', [ OptionController::class, 'destroyAll' ])->name('options.deleteAll');
        Route::resource('options', OptionController::class);
        /*------------ locations ----------*/
        Route::post('delete-all-locations', [ LocationController::class, 'destroyAll' ])->name('locations.deleteAll');
        Route::resource('locations', LocationController::class);
        /*------------ blogs ----------*/
        Route::post('delete-all-blogs', [ BlogController::class, 'destroyAll' ])->name('blogs.deleteAll');
        Route::resource('blogs', BlogController::class);
        Route::post('delete-all-orders', [ OrderController::class, 'destroyAll' ])->name('orders.deleteAll');
        Route::resource('orders', OrderController::class);

        #new_routes_here

    });
    /// excel area
    Route::get('export/{export}', [ ExcelController::class, 'master' ])->name('master-export');
    Route::post('import-items', [ ExcelController::class, 'importItems' ])->name('import-items');
    Route::get('{model}/toggle-boolean/{id}/{action}', [ AdminController::class, 'toggleBoolean' ])->name('model.active');
});