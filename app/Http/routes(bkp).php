<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', function () {
    return view('welcome');
});


/*
|-------------------------------------------------------------------------
|API Routes
|------------------------------------------------------------------------
*/
Route::group(['prefix'=>'api'],function(){
	
    Route::post('/registration-step1','Api\UsersController@registration_step1');
    Route::post('/registration','Api\UsersController@registration');
    Route::any('/emailverification/{id}','Api\UsersController@emailverification');
    Route::any('/country-phone-code','Api\UsersController@country_phone_code');
    Route::post('/registration-step2','Api\UsersController@registration_step2');
    Route::post('/login','Api\UsersController@login');
    Route::post('/logout','Api\UsersController@logout');
    Route::post('/update-contact-info','Api\UsersController@update_contact_info');
    Route::post('/update-logo-social','Api\UsersController@update_logo_social');

    //Route::post('/add_staff','Api\UsersController@add_staff');
    Route::post('/service_list','Api\UsersController@service_list');
    Route::post('/chnage-service-status', 'Api\UsersController@chnage_service_status');

    Route::post('/add_staff','Api\StaffsController@add_staff');
    Route::post('/staff_list','Api\StaffsController@staff_list');

    Route::post('/add_client','Api\ClientsController@add_client');

});



/*
|-------------------------------------------------------------------------
|Website Routes
|------------------------------------------------------------------------
*/
Route::group(['prefix'=>''],function(){
	
    Route::get('/login','Website\UsersController@login');
    Route::any('/','Website\UsersController@registration');
    Route::get('/registration-step1','Website\UsersController@registration_step1');
    Route::get('/registration-step2','Website\UsersController@registration_step2');
    Route::get('/dashboard','Website\UsersController@dashboard');
    Route::get('/logout', 'Website\UsersController@logout');
    Route::any('/thank-you','Website\UsersController@thank_you');

    Route::get('/business-contact-info','Website\UsersController@business_contact_info');
    Route::get('/business-logo-social-network','Website\UsersController@business_logo_social_network');


    //Only for link purpose

    Route::get('/calendar','Website\UsersController@calendar');
    Route::get('/gift-certificates','Website\UsersController@gift_certificates');
    Route::get('/marketing-discount-coupons','Website\UsersController@marketing_discount_coupons');
    Route::get('/offers','Website\UsersController@offers');
    Route::get('/reports','Website\UsersController@reports');
    Route::get('/client-database','Website\UsersController@client_database');
    Route::get('/staff-details','Website\UsersController@staff_details');
    Route::get('/booking-options','Website\UsersController@booking_options');
    Route::get('/booking-rules','Website\UsersController@booking_rules');
    Route::get('/booking-policies','Website\UsersController@booking_policies');
    Route::get('/notification-settings','Website\UsersController@notification_settings');
    Route::get('/email-confirmation','Website\UsersController@email_confirmation');
    Route::get('/settings-membership','Website\UsersController@settings_membership');
    Route::get('/integration','Website\UsersController@integration');
    Route::get('/settings-business-hours','Website\UsersController@settings_business_hours');
    
    Route::get('/business-details2','Website\UsersController@business_details2');
    Route::get('/invitees','Website\UsersController@invitees');
    Route::get('/services','Website\UsersController@services');
	Route::get('/payment-options','Website\UsersController@payment_options');
    Route::get('/invoice','Website\UsersController@invoice');
    Route::get('/create-invoice','Website\UsersController@create_invoice');
    Route::get('/invoice-details','Website\UsersController@invoice_details');
    Route::get('/invite-contacts','Website\UsersController@invite_contacts');
    Route::get('/add-location','Website\UsersController@add_location');
    Route::get('/privacy-settings','Website\UsersController@privacy_settings');
    Route::get('/profile-settings','Website\UsersController@profile_settings');
    Route::get('/profile-picture','Website\UsersController@profile_picture');
    Route::get('/profile-link','Website\UsersController@profile_link');
    Route::get('/profile-payment','Website\UsersController@profile_payment');
    Route::get('/profile-login','Website\UsersController@profile_login');

    //Route::get('/profile-settings','Website\UsersController@profile_settings');
    //Route::get('/profile-settings','Website\UsersController@profile_settings');
    //Route::get('/profile-settings','Website\UsersController@profile_settings');
    //Route::get('/profile-settings','Website\UsersController@profile_settings');
    //Route::get('/profile-settings','Website\UsersController@profile_settings');
    //Route::get('/profile-settings','Website\UsersController@profile_settings');
    //Route::get('/profile-settings','Website\UsersController@profile_settings');
    //Route::get('/profile-settings','Website\UsersController@profile_settings');


});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware'=>'auth', 'prefix'=>'admin'],function(){ 
	//For backend
	Route::get('/dashboard', 'Admin\AdminController@index');
	Route::get('/change-password', 'Admin\AdminController@change_password');
	Route::post('/update-password', 'Admin\AdminController@update_password');
	
	
	Route::get('/profile-block-unblock', 'Admin\AdminController@profile_block_unblock');
	Route::get('/verify-multiple-profile', 'Admin\AdminController@verify_multiple_profile');
	Route::get('/block-multiple-profile', 'Admin\AdminController@block_multiple_profile');
	
	Route::get('/category', 'Admin\AdminController@category');
	Route::get('/add-category/{any?}', 'Admin\AdminController@add_category');
	Route::post('/modify-category', 'Admin\AdminController@modify_category');

	Route::get('/country/{any?}', 'Admin\AdminController@country');
	Route::get('/add-country/{any?}', 'Admin\AdminController@add_country');
	Route::post('/modify-country', 'Admin\AdminController@modify_country');
    
	Route::get('/profession/{any?}', 'Admin\AdminController@profession');
	Route::get('/add-profession/{any?}', 'Admin\AdminController@add_profession');
	Route::post('/modify-profession', 'Admin\AdminController@modify_profession');
	
    Route::post('/update-password', 'Admin\AdminController@update_password');
    Route::post('/update-password', 'Admin\AdminController@update_password');

    Route::any('/update-status', 'Admin\AdminController@update_status');
    Route::get('/delete-single-entity', 'Admin\AdminController@delete_single_entity');
	Route::get('/delete-multiple-entity', 'Admin\AdminController@delete_multiple_entity');

	Route::get('/currency/{any?}', 'Admin\AdminController@currency');
    Route::get('/add-currency/{any?}', 'Admin\AdminController@add_currency');
    Route::post('/modify-currency', 'Admin\AdminController@modify_currency');

    //Route::post('/change-status', 'Admin\AdminController@change_status');

}); 


Route::get('admin/login', 'Admin\AdminController@login');
Route::get('admin/logout', 'Admin\AdminController@logout');
Route::post('admin/check-login', 'Admin\AdminController@check_login');



