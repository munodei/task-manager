<?php


Route::get('/', 'HomeController@index')->name('homepage');
Route::get('/about-us', 'HomeController@aboutUs')->name('about-us');
Route::get('/contact', 'HomeController@contactUs')->name('contact-us');

Auth::routes();

Route::get('clear', 'HomeController@clearCache')->name('clear_cache');

Route::get('installation', ['as' => 'installation', 'uses'=>'HomeController@installation']);
Route::post('installation', [ 'uses'=>'HomeController@installationPost']);

//Route::get('/', ['as' => 'home', 'uses'=>'HomeController@index']);
Route::get('LanguageSwitch/{lang}', ['as' => 'switch_language', 'uses'=>'HomeController@switchLang']);

//Account activating
Route::get('account/activating/{activation_code}', ['as' => 'email_activation_link', 'uses'=>'UserController@activatingAccount']);

//Listing page
Route::get('contact-us', ['as' => 'contact_us_page', 'uses'=>'HomeController@contactUs']);
Route::post('contact-us', ['uses'=>'HomeController@contactUsPost']);
Route::get('page/{slug}', ['as' => 'single_page', 'uses'=>'PostController@showPage']);
Route::get('category/{cat_id?}', ['uses'=>'CategoriesController@show'])->name('category');
// Password reset routes...
Route::post('send-password-reset-link', ['as' => 'send_reset_link', 'uses'=>'Auth\PasswordController@postEmail']);




Route::get('/home', 'HomeController@home')->name('home');



Route::group(['prefix'=>'login'], function(){
    //Social login route

    Route::get('facebook', ['as' => 'facebook_redirect', 'uses'=>'SocialLogin@redirectFacebook']);
    Route::get('facebook-callback', ['as' => 'facebook_callback', 'uses'=>'SocialLogin@callbackFacebook']);

    Route::get('google', ['as' => 'google_redirect', 'uses'=>'SocialLogin@redirectGoogle']);
    Route::get('google-callback', ['as' => 'google_callback', 'uses'=>'SocialLogin@callbackGoogle']);

    Route::get('twitter', ['as' => 'twitter_redirect', 'uses'=>'SocialLogin@redirectTwitter']);
    Route::get('twitter-callback', ['as' => 'twitter_callback', 'uses'=>'SocialLogin@callbackTwitter']);
});

Route::resource('user', 'UserController');

//Dashboard Route
Route::group(['prefix'=>'dashboard', 'middleware' => 'dashboard'], function(){
    Route::get('/', ['as'=>'dashboard', 'uses' => 'DashboardController@dashboard']);

    Route::get('/settings', ['as'=>'settings', 'uses' => 'SettingsController@AccountSettings']);

    Route::group(['middleware'=>'only_admin_access'], function(){
        Route::group(['prefix'=>'settings'], function(){
            Route::get('theme-settings', ['as'=>'theme-settings', 'uses' => 'SettingsController@ThemeSettings']);
            Route::get('modern-theme-settings', ['as'=>'modern-theme-settings', 'uses' => 'SettingsController@modernThemeSettings']);
            Route::get('social-url-settings', ['as'=>'social-url-settings', 'uses' => 'SettingsController@SocialUrlSettings']);
            Route::get('general', ['as'=>'general-settings', 'uses' => 'SettingsController@GeneralSettings']);
            Route::get('payments', ['as'=>'payment-settings', 'uses' => 'SettingsController@PaymentSettings']);
            Route::get('languages', ['as'=>'language-settings', 'uses' => 'LanguageController@index']);
            Route::post('languages', ['uses' => 'LanguageController@store']);
            Route::post('languages-delete', ['as'=>'delete-language', 'uses' => 'LanguageController@destroy']);

            Route::get('storage', ['as'=>'file_storage_settings', 'uses' => 'SettingsController@StorageSettings']);
            Route::get('social', ['as'=>'social_settings', 'uses' => 'SettingsController@SocialSettings']);
            Route::get('blog', ['as'=>'blog-settings', 'uses' => 'SettingsController@BlogSettings']);
            Route::get('other', ['as'=>'other-settings', 'uses' => 'SettingsController@OtherSettings']);
            Route::post('other', ['as'=>'other-settings', 'uses' => 'SettingsController@OtherSettingsPost']);

            Route::get('recaptcha', ['as'=>'re_captcha_settings', 'uses' => 'SettingsController@reCaptchaSettings']);

            //Save settings / options
            Route::post('save-settings', ['as'=>'save_settings', 'uses' => 'SettingsController@update']);
            Route::get('monetization', ['as'=>'monetization', 'uses' => 'SettingsController@monetization']);
        });


        Route::group(['prefix'=>'categories'], function(){
            Route::get('/', ['as'=>'parent_categories', 'uses' => 'CategoriesController@index']);
            Route::post('/', ['uses' => 'CategoriesController@store']);

            Route::get('edit/{id}', ['as'=>'edit_categories', 'uses' => 'CategoriesController@edit']);
            Route::post('edit/{id}', ['uses' => 'CategoriesController@update']);

            Route::post('delete-categories', ['as'=>'delete_categories', 'uses' => 'CategoriesController@destroy']);
        });

        Route::group(['prefix'=>'posts'], function(){
            Route::get('/', ['as'=>'posts', 'uses' => 'PostController@posts']);

            Route::get('create', ['as'=>'create_new_post', 'uses' => 'PostController@createPost']);
            Route::post('create', ['uses' => 'PostController@storePost']);
            Route::post('delete', ['as'=>'delete_post','uses' => 'PostController@destroyPost']);

            Route::get('edit/{slug}', ['as'=>'edit_post', 'uses' => 'PostController@editPost']);
            Route::post('edit/{slug}', ['uses' => 'PostController@updatePost']);
        });

        Route::group(['prefix'=>'pages'], function(){
            Route::get('/', ['as'=>'pages', 'uses' => 'PostController@index']);

            Route::get('create', ['as'=>'create_new_page', 'uses' => 'PostController@create']);
            Route::post('create', ['uses' => 'PostController@store']);
            Route::post('delete', ['as'=>'delete_page','uses' => 'PostController@destroy']);

            Route::get('edit/{slug}', ['as'=>'edit_page', 'uses' => 'PostController@edit']);
            Route::post('edit/{slug}', ['uses' => 'PostController@updatePage']);
        });
        Route::group(['prefix'=>'admin_comments'], function(){
            Route::get('/', ['as'=>'admin_comments', 'uses' => 'CommentController@index']);
            Route::post('action', ['as'=>'comment_action', 'uses' => 'CommentController@commentAction']);
        });

        Route::get('approved', ['as'=>'approved_ads', 'uses' => 'AdsController@index']);
        Route::get('pending', ['as'=>'admin_pending_ads', 'uses' => 'AdsController@adminPendingAds']);
        Route::get('blocked', ['as'=>'admin_blocked_ads', 'uses' => 'AdsController@adminBlockedAds']);
        Route::post('status-change', ['as'=>'ads_status_change', 'uses' => 'AdsController@adStatusChange']);

        Route::get('ad-reports', ['as'=>'ad_reports', 'uses' => 'AdsController@reports']);
        Route::get('users', ['as'=>'users', 'uses' => 'UserController@index']);
        Route::get('users-info/{id}', ['as'=>'user_info', 'uses' => 'UserController@userInfo']);
        Route::post('change-user-status', ['as'=>'change_user_status', 'uses' => 'UserController@changeStatus']);
        Route::post('change-user-feature', ['as'=>'change_user_feature', 'uses' => 'UserController@changeFeature']);
        Route::post('delete-reports', ['as'=>'delete_report', 'uses' => 'AdsController@deleteReports']);

        Route::get('contact-messages', ['as'=>'contact_messages', 'uses' => 'HomeController@contactMessages']);

        Route::group(['prefix'=>'administrators'], function(){
            Route::get('/', ['as'=>'administrators', 'uses' => 'UserController@administrators']);
            Route::get('create', ['as'=>'add_administrator', 'uses' => 'UserController@addAdministrator']);
            Route::post('create', ['uses' => 'UserController@storeAdministrator']);
            Route::post('block-unblock', ['as'=>'administratorBlockUnblock','uses' => 'UserController@administratorBlockUnblock']);

        });


    });

});

//Single Slug Ad URL
Route::get('{slug}', ['as' => 'single_ad', 'uses'=>'AdsController@singleAd']);
