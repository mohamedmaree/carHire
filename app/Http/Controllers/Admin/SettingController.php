<?php

namespace App\Http\Controllers\Admin;

use App\Traits\UploadTrait;
use Image;
use App\Traits\Report;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use App\Models\Country;

class SettingController extends Controller
{
    use UploadTrait;

    public function index()
    {
        $data = Cache::rememberForever('settings', function () {
            return SettingService::appInformations(SiteSetting::pluck('value', 'key'));
        });
        $countries = Country::orderBy('id', 'ASC')->get();
        return view('admin.settings.index', compact('data', 'countries'));
    }


    public function update(Request $request)
    {
        $request_array = $request->all();
        Cache::forget('settings');
        foreach ($request_array as $key => $val) {
            if (in_array($key, [ 'logo', 'side_logo', 'fav_icon', 'default_user', 'intro_loader', 'intro_logo', 'about_image_2', 'about_image_1', 'login_background', 'profile_cover', 'brochure_file', 'home_banner_1', 'home_banner_2', 'section_transparency_file', 'section_damage_liability_file', 'section_our_story_file', 'about_section_1_image', 'about_section_2_image' ])) {
                // Check if it's a video file
                $isVideo = in_array($val->getClientMimeType(), ['video/mp4', 'video/mpeg', 'video/quicktime', 'video/x-msvideo', 'video/webm']);
                
                if ($key == 'brochure_file') {
                    // Handle brochure file upload to images/settings folder
                    $thumbsPath = 'storage/images/settings/';
                    $name = time() . rand(1000000, 9999999) . '.' . $val->getClientOriginalExtension();
                    SiteSetting::updateOrCreate([ 'key' => $key ], [ 'value' => $name ]);
                    $val->storeAs($thumbsPath, $name);
                } elseif ($isVideo || $val->getClientOriginalExtension() == 'svg' || !in_array($val->getClientmimeType(), [ 'image/jpeg', 'image/jpg', 'image/png' ])) {
                    // Handle video files and non-image files (SVG, etc.)
                    if ($key == 'default_user') {
                        $thumbsPath = 'images/users/';
                        $name = time() . rand(1000000, 9999999) . '.' . $val->getClientOriginalExtension();
                        SiteSetting::updateOrCreate([ 'key' => $key ], [ 'value' => $name ]);
                    } else if ($key == 'no_data') {
                        $thumbsPath = 'images/';
                        $name = 'no_data.png';
                    } else {
                        $name = time() . rand(1000000, 9999999) . '.' . $val->getClientOriginalExtension();
                        $thumbsPath = 'storage/images/settings/';
                        SiteSetting::updateOrCreate([ 'key' => $key ], [ 'value' => $name ]);
                    }
                    $val->storeAs($thumbsPath, $name);
                } else {
                    // Handle image files with image processing
                    $img = Image::make($val);
                    if ($key == 'default_user') {
                        $thumbsPath = 'storage/images/users/';
                        $name = time() . rand(1000000, 9999999) . '.' . $val->getClientOriginalExtension();
                        SiteSetting::updateOrCreate([ 'key' => $key ], [ 'value' => $name ]);
                    } else if ($key == 'no_data') {
                        $thumbsPath = 'storage/images/';
                        $name = 'no_data.png';
                    } else {
                        $name = time() . rand(1000000, 9999999) . '.' . $val->getClientOriginalExtension();
                        $thumbsPath = 'storage/images/settings/';
                        SiteSetting::updateOrCreate([ 'key' => $key ], [ 'value' => $name ]);
                    }
                    $img->save($thumbsPath . $name);
                }

            } else {
                // if($val){
                SiteSetting::updateOrCreate([ 'key' => $key ], [ 'value' => $val ]);
                // }
            }
        }

        if ($request->is_production) {
            SiteSetting::where('key', 'is_production')->update([ 'value' => 1 ]);
        } else {
            SiteSetting::where('key', 'is_production')->update([ 'value' => 0 ]);
        }

        Cache::rememberForever('settings', function () {
            return SettingService::appInformations(SiteSetting::pluck('value', 'key'));
        });

        Report::addToLog('تعديل الاعدادت');

        return back()->with('success', 'تم الحفظ');
    }

    public function updateSocials(Request $request)
    {
        $request_array = $request->all();
        Cache::forget('settings');
        if ($request->socials) {
            $arr = [];
            foreach ($request->socials as $social) {
                $item = [
                    'name' => $social['name'],
                    'url'  => $social['url']
                ];
                if ((@$social['image'] &&  !is_string(@$social['image'] )) ?? false) {
                    $item['image'] = 'storage/images/settings/' . $this->uploadAllTyps($social['image'], 'settings');
                }else{
                    $item['image'] = null;
                }
                $arr[] = $item;
            }
            $arr = json_encode($arr);
            SiteSetting::updateOrCreate([ 'key' => 'socials' ], [ 'value' => $arr ]);
        }else{
            SiteSetting::updateOrCreate([ 'key' => 'socials' ], [ 'value' => null]);
        }

        Cache::rememberForever('settings', function () {
            return SettingService::appInformations(SiteSetting::pluck('value', 'key'));
        });

        Report::addToLog('تعديل الاعدادت');

        return back()->with('success', 'تم الحفظ');
    }


    public function messageAll(Request $request, $type)
    {

        $this->userRepo->messageAll($request->all(), $type);
        return back()->with('success', 'تم الارسال');
    }

    public function messageOne(Request $request, $type)
    {

        $this->userRepo->messageOne($request->all(), $type);
        return back()->with('success', 'تم الارسال');
    }

    public function sendEmail(Request $request)
    {

        $this->settingRepo->sendEmail($request->all());
        return back()->with('success', 'تم الارسال');
    }
}
