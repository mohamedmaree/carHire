<?php

namespace App\Services;

class SettingService
{
    /**
     * Convert relative path to full URL
     */
    private static function getFullUrl($path)
    {
        if (empty($path)) {
            return $path;
        }
        // If already a full URL, return as is
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }
        // Convert relative path to full URL
        return url($path);
    }

    public static function appInformations($app_info)
    {
        $data = [
            'is_production'         => $app_info['is_production'],
            'name_ar'               => $app_info['name_ar'],
            'name_en'               => $app_info['name_en'],
            'tagline_ar'            => $app_info['tagline_ar'] ?? '',
            'tagline_en'            => $app_info['tagline_en'] ?? '',
            'tagline'               => $app_info['tagline_' . lang()] ?? '',
            'email'                 => $app_info['email'],
            'country_code'          => $app_info['country_code'],
            'phone'                 => $app_info['phone'],
            'whatsapp_country_code' => $app_info['whatsapp_country_code'],
            'whatsapp'              => $app_info['whatsapp'],

            'logo'             => self::getFullUrl('storage/images/settings/' . $app_info['logo']),
            'side_logo'        => self::getFullUrl('storage/images/settings/' . $app_info['side_logo']),
            'fav_icon'         => self::getFullUrl('storage/images/settings/' . $app_info['fav_icon']),
            'no_data_icon'     => self::getFullUrl($app_info['no_data_icon']),
            'default_user'     => self::getFullUrl('storage/images/users/' . $app_info['default_user']),
            'profile_cover'    => self::getFullUrl('storage/images/settings/' . $app_info['profile_cover']),
            'login_background' => self::getFullUrl('storage/images/settings/' . $app_info['login_background']),
            'intro_logo'       => self::getFullUrl('storage/images/settings/' . $app_info['intro_logo']),
            'intro_loader'     => self::getFullUrl('storage/images/settings/' . $app_info['intro_loader']),
            'intro_name'       => $app_info['intro_name_' . lang()],
            'intro_name_ar'    => $app_info['intro_name_ar'],
            'intro_name_en'    => $app_info['intro_name_en'],
            'intro_about'      => $app_info['intro_about_' . lang()],
            'intro_about_ar'   => $app_info['intro_about_ar'],
            'intro_about_en'   => $app_info['intro_about_en'],

            'about_image_2'          => self::getFullUrl('storage/images/settings/' . $app_info['about_image_2']),
            'about_image_1'          => self::getFullUrl('storage/images/settings/' . $app_info['about_image_1']),
            'home_banner_1'          => !empty($app_info['home_banner_1']) ? self::getFullUrl('storage/images/settings/' . $app_info['home_banner_1']) : '',
            'home_banner_2'          => !empty($app_info['home_banner_2']) ? self::getFullUrl('storage/images/settings/' . $app_info['home_banner_2']) : '',
            'services_text_ar'       => $app_info['services_text_ar'],
            'services_text_en'       => $app_info['services_text_en'],
            'services_text'          => $app_info['services_text_' . lang()],
            'how_work_text_ar'       => $app_info['how_work_text_ar'],
            'how_work_text_en'       => $app_info['how_work_text_en'],
            'how_work_text'          => $app_info['how_work_text_' . lang()],
            'fqs_text_ar'            => $app_info['fqs_text_ar'],
            'fqs_text_en'            => $app_info['fqs_text_en'],
            'fqs_text'               => $app_info['fqs_text_' . lang()],
            'parteners_text_ar'      => $app_info['parteners_text_ar'],
            'parteners_text_en'      => $app_info['parteners_text_en'],
            'parteners_text'         => $app_info['parteners_text_' . lang()],
            'contact_text_ar'        => $app_info['contact_text_ar'],
            'contact_text_en'        => $app_info['contact_text_en'],
            'contact_text'           => $app_info['contact_text_' . lang()],
            'intro_email'            => $app_info['intro_email'],
            'intro_phone'            => $app_info['intro_phone'],
            'intro_address'          => $app_info['intro_address'],
            'color'                  => $app_info['color'],
            'buttons_color'          => $app_info['buttons_color'],
            'hover_color'            => $app_info['hover_color'],
            'intro_meta_description' => $app_info['intro_meta_description'],
            'intro_meta_keywords'    => $app_info['intro_meta_keywords'],

            'smtp_user_name'   => $app_info['smtp_user_name'],
            'smtp_password'    => $app_info['smtp_password'],
            'smtp_mail_from'   => $app_info['smtp_mail_from'],
            'smtp_sender_name' => $app_info['smtp_sender_name'],
            'smtp_port'        => $app_info['smtp_port'],
            'smtp_host'        => $app_info['smtp_host'],
            'smtp_encryption'  => $app_info['smtp_encryption'],

            'firebase_key'       => $app_info['firebase_key'],
            'firebase_sender_id' => $app_info['firebase_sender_id'],

            'google_places'    => $app_info['google_places'],
            'google_analytics' => $app_info['google_analytics'],
            'live_chat'        => $app_info['live_chat'],
            'default_locale'   => $app_info['default_locale'],
            'locales'          => $app_info['locales'],
            'rtl_locales'      => $app_info['rtl_locales'],
            'default_country'  => $app_info['default_country'],
            'countries'        => $app_info['countries'],
            'default_currency' => $app_info['default_currency'],
            'currencies'       => $app_info['currencies'],
            'socials'          => json_decode($app_info['socials']),
            
            // Contact Information
            'contact_address_ar' => $app_info['contact_address_ar'] ?? '',
            'contact_address_en' => $app_info['contact_address_en'] ?? '',
            'contact_address'    => $app_info['contact_address_' . lang()] ?? '',
            'contact_address_lat' => $app_info['contact_address_lat'] ?? '24.7135517',
            'contact_address_lng' => $app_info['contact_address_lng'] ?? '46.6752957',
            'brochure_file'      => isset($app_info['brochure_file']) && !empty($app_info['brochure_file']) ? self::getFullUrl('storage/images/settings/' . $app_info['brochure_file']) : '',
            
            // Facts By The Numbers
            'facts' => [
                'happy_customers' => $app_info['happy_customers'] ?? '3K+',
                'vip_members' => $app_info['vip_members'] ?? '2K+',
                'reviews' => $app_info['reviews'] ?? '400+',
                'years_experience' => $app_info['years_experience'] ?? '5+',
            ],
            
            // App Download Section
            'app_download' => [
                'title' => $app_info['app_download_title_' . lang()] ?? 'DOWNLOAD OUR APP',
                'description' => $app_info['app_download_description_' . lang()] ?? 'Looking for a car rental on the go? The DistinQt Car Hire App makes it quick, easy, book, and manage your perfect vehicle rental all from your smart phone seamless booking with just a few taps, stay in control by tracking your reservations and pick-up details.',
                'google_play_link' => $app_info['app_google_play_link'] ?? 'https://play.google.com/store/apps/details?id=com.distinqt.carhire',
                'apple_store_link' => $app_info['app_apple_store_link'] ?? 'https://apps.apple.com/app/distinqt-car-hire/id123456789',
            ],
            
            // Home Banner Images
            'home_banners' => array_values(array_filter([
                !empty($app_info['home_banner_1']) ? self::getFullUrl('storage/images/settings/' . $app_info['home_banner_1']) : null,
                !empty($app_info['home_banner_2']) ? self::getFullUrl('storage/images/settings/' . $app_info['home_banner_2']) : null,
            ])),
            
            // Home Sections
            'section_transparency' => [
                'title' => $app_info['section_transparency_title_' . lang()] ?? '',
                'title_ar' => $app_info['section_transparency_title_ar'] ?? '',
                'title_en' => $app_info['section_transparency_title_en'] ?? '',
                'subtitle' => $app_info['section_transparency_subtitle_' . lang()] ?? '',
                'subtitle_ar' => $app_info['section_transparency_subtitle_ar'] ?? '',
                'subtitle_en' => $app_info['section_transparency_subtitle_en'] ?? '',
                'description' => $app_info['section_transparency_description_' . lang()] ?? '',
                'description_ar' => $app_info['section_transparency_description_ar'] ?? '',
                'description_en' => $app_info['section_transparency_description_en'] ?? '',
                'file' => !empty($app_info['section_transparency_file']) ? self::getFullUrl('storage/images/settings/' . $app_info['section_transparency_file']) : null,
            ],
            
            'section_damage_liability' => [
                'title' => $app_info['section_damage_liability_title_' . lang()] ?? '',
                'title_ar' => $app_info['section_damage_liability_title_ar'] ?? '',
                'title_en' => $app_info['section_damage_liability_title_en'] ?? '',
                'subtitle' => $app_info['section_damage_liability_subtitle_' . lang()] ?? '',
                'subtitle_ar' => $app_info['section_damage_liability_subtitle_ar'] ?? '',
                'subtitle_en' => $app_info['section_damage_liability_subtitle_en'] ?? '',
                'description' => $app_info['section_damage_liability_description_' . lang()] ?? '',
                'description_ar' => $app_info['section_damage_liability_description_ar'] ?? '',
                'description_en' => $app_info['section_damage_liability_description_en'] ?? '',
                'file' => !empty($app_info['section_damage_liability_file']) ? self::getFullUrl('storage/images/settings/' . $app_info['section_damage_liability_file']) : null,
            ],
            
            'section_our_story' => [
                'title' => $app_info['section_our_story_title_' . lang()] ?? '',
                'title_ar' => $app_info['section_our_story_title_ar'] ?? '',
                'title_en' => $app_info['section_our_story_title_en'] ?? '',
                'subtitle' => $app_info['section_our_story_subtitle_' . lang()] ?? '',
                'subtitle_ar' => $app_info['section_our_story_subtitle_ar'] ?? '',
                'subtitle_en' => $app_info['section_our_story_subtitle_en'] ?? '',
                'description' => $app_info['section_our_story_description_' . lang()] ?? '',
                'description_ar' => $app_info['section_our_story_description_ar'] ?? '',
                'description_en' => $app_info['section_our_story_description_en'] ?? '',
                'file' => !empty($app_info['section_our_story_file']) ? self::getFullUrl('storage/images/settings/' . $app_info['section_our_story_file']) : null,
            ],
            
            // About Sections
            'about_section_1' => [
                'title' => $app_info['about_section_1_title_' . lang()] ?? '',
                'title_ar' => $app_info['about_section_1_title_ar'] ?? '',
                'title_en' => $app_info['about_section_1_title_en'] ?? '',
                'description' => $app_info['about_' . lang()] ?? '',
                'description_ar' => $app_info['about_ar'] ?? '',
                'description_en' => $app_info['about_en'] ?? '',
                'image' => !empty($app_info['about_section_1_image']) ? self::getFullUrl('storage/images/settings/' . $app_info['about_section_1_image']) : null,
            ],
            
            'about_section_2' => [
                'title' => $app_info['about_section_2_title_' . lang()] ?? '',
                'title_ar' => $app_info['about_section_2_title_ar'] ?? '',
                'title_en' => $app_info['about_section_2_title_en'] ?? '',
                'description' => $app_info['about_2_' . lang()] ?? '',
                'description_ar' => $app_info['about_2_ar'] ?? '',
                'description_en' => $app_info['about_2_en'] ?? '',
                'image' => !empty($app_info['about_section_2_image']) ? self::getFullUrl('storage/images/settings/' . $app_info['about_section_2_image']) : null,
            ],
            
            // Our Location
            'our_location' => [
                'title' => $app_info['our_location_title_' . lang()] ?? '',
                'title_ar' => $app_info['our_location_title_ar'] ?? '',
                'title_en' => $app_info['our_location_title_en'] ?? '',
                'description' => $app_info['our_location_description_' . lang()] ?? '',
                'description_ar' => $app_info['our_location_description_ar'] ?? '',
                'description_en' => $app_info['our_location_description_en'] ?? '',
                'lat' => $app_info['our_location_lat'] ?? '24.7135517',
                'lng' => $app_info['our_location_lng'] ?? '46.6752957',
            ],
        ];
        foreach (languages() as $lang) {
            $data['about_' . $lang] = $app_info['about_' . $lang] ?? '';
            $data['about_2_' . $lang] = $app_info['about_2_' . $lang] ?? '';
            $data['terms_' . $lang] = $app_info['terms_' . $lang] ?? '';
            $data['privacy_' . $lang] = $app_info['privacy_' . $lang] ?? '';
        }
        
        // Terms and Privacy File URLs
        $data['terms_file'] = !empty($app_info['terms_file']) ? self::getFullUrl('storage/images/settings/' . $app_info['terms_file']) : null;
        $data['privacy_file'] = !empty($app_info['privacy_file']) ? self::getFullUrl('storage/images/settings/' . $app_info['privacy_file']) : null;
        
        // Order Pricing Settings
        $data['gst_percentage'] = $app_info['gst_percentage'] ?? '10';
        $data['refundable_deposit'] = $app_info['refundable_deposit'] ?? '500';
        $data['surcharges_fee_percentage'] = $app_info['surcharges_fee_percentage'] ?? '1.5';
        
        return $data;
    }


}
