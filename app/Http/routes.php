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
    Route::post('/timezone_list','Api\UsersController@timezone_list');
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
    Route::post('/clone-service', 'Api\UsersController@clone_service');
    Route::post('/delete-service', 'Api\UsersController@delete_service');
    Route::post('/add-new-service', 'Api\UsersController@add_new_service');
    Route::post('/payment_terms', 'Api\UsersController@payment_terms');
    Route::post('/service-details', 'Api\UsersController@service_details');
    Route::post('/add_staff','Api\StaffsController@add_staff');
    Route::post('/edit_staff','Api\StaffsController@edit_staff');
    Route::post('/change-status-staff','Api\StaffsController@change_status_staff');
    Route::post('/staff_list','Api\StaffsController@staff_list');
    Route::post('/staff_import','Api\StaffsController@staff_import');
    Route::post('/staff-details','Api\StaffsController@staff_details');
    Route::post('/delete-staff','Api\StaffsController@staff_delete');
    Route::post('/block-times','Api\StaffsController@block_times');
    Route::post('/staff_service_availability','Api\StaffsController@staff_service_availability');
    Route::post('/add_staff_service_availability','Api\StaffsController@add_staff_service_availability');
    Route::post('/delete_staff_availability','Api\StaffsController@delete_staff_availability');
    Route::post('/delete_staff_block_time','Api\StaffsController@delete_staff_block_time');
    Route::post('/services_lists','Api\StaffsController@services_lists');

    Route::post('/add_client','Api\ClientsController@add_client');
    Route::post('/client_list','Api\ClientsController@client_list');
    Route::post('/client_details','Api\ClientsController@client_details');
    Route::post('/edit_client','Api\ClientsController@edit_client');
    Route::post('/client_import','Api\ClientsController@client_import');
    Route::post('/verify_client','Api\ClientsController@verify_client');
    Route::post('/send_reset_password_email','Api\ClientsController@send_reset_password_email');
    Route::post('/email_customisation_data','Api\BookingsController@email_customisation_data');
    Route::post('/email_customisation_update','Api\BookingsController@email_customisation_update');
    Route::post('/add_appoinment','Api\BookingsController@add_appoinment');
    Route::post('/appoinment_list','Api\BookingsController@appoinment_list');
    Route::post('/appointment_details','Api\BookingsController@appointment_details');
    Route::post('reschedule_appoitment','Api\BookingsController@reschedule_appoitment');
    Route::post('/appoinment-cancel','Api\BookingsController@appoinment_cancel');
    Route::post('/calendar_settings','Api\BookingsController@calendar_settings');
    Route::post('/staffs_list','Api\BookingsController@staffs_list');
    Route::post('/add_block_date','Api\BookingsController@add_block_date');
    Route::post('/update_appointment_note','Api\BookingsController@update_appointment_note');
    Route::post('/add_block_time','Api\BookingsController@add_block_time');
    Route::post('/save_booking_policy','Api\BookingsController@save_booking_policy');
    Route::post('/booking_policy_list','Api\BookingsController@booking_policy_list');
    Route::post('/update_payment_info','Api\BookingsController@update_payment_info');
    Route::post('/update_notification_settings','Api\BookingsController@update_notification_settings');
    Route::post('/notification_settings_data','Api\BookingsController@notification_settings_data');
    Route::post('/client_appointment_details','Api\ClientsController@client_appointment_details');
    Route::post('/reschedule_appointment_process','Api\ClientsController@reschedule_appointment_process');
    Route::post('/cancel_appointment_process','Api\ClientsController@cancel_appointment_process');
    Route::post('/business_provider_category_list','Api\ClientsController@business_provider_category_list');
    Route::post('/business_provider_service_list','Api\ClientsController@business_provider_service_list');
    Route::post('/business_provider_staff_list','Api\ClientsController@business_provider_staff_list');
    Route::post('/send_client_verification_code','Api\ClientsController@send_client_verification_code');
    Route::post('/appointment_verification','Api\ClientsController@appointment_verification');
    Route::post('/calendar_availability_list','Api\ClientsController@calendar_availability_list');
    Route::post('/payment_options', 'Api\UsersController@payment_options');
    Route::post('/pre_payment_charges', 'Api\UsersController@pre_payment_charges');
    Route::post('/payment_terms', 'Api\UsersController@payment_terms');
    Route::post('/payment_settings', 'Api\UsersController@payment_settings');

    Route::post('/add-new-location','Api\StaffsController@add_new_location');
    Route::post('/import-invite-contact','Api\UsersController@import_invite_contact');
    Route::post('/profile_settings','Api\ProfileController@profile_settings');
    Route::post('/update-profile-settings','Api\ProfileController@update_profile_settings');
    Route::post('/delete-account','Api\ProfileController@delete_account');
    Route::post('/profile-payment','Api\ProfileController@profile_payment');
    Route::post('/profile-url','Api\ProfileController@profile_url');
    Route::post('/profile-personal-image','Api\ProfileController@profile_personal_image');
    Route::post('/change-password','Api\ProfileController@change_password');

    Route::post('/client_login','Api\ClientsController@client_login');
    Route::post('/area_code','Api\StaffsController@area_code');
    Route::post('/get_post_code','Api\StaffsController@get_post_code');
    Route::post('/chnage_postal_code_status','Api\StaffsController@chnage_postal_code_status');
    Route::post('/postal_code_filter','Api\StaffsController@postal_code_filter');
    Route::post('/change_postal_code_customer_interface','Api\StaffsController@change_postal_code_customer_interface');

    Route::post('/client_forgot_password','Api\ClientsController@client_forgot_password');
    
    

    Route::post('/event_viewer_list','Api\UsersController@event_viewer_list');

    Route::post('/settings_membership','Api\PlanController@settings_membership');

    Route::post('/change_plan_duration','Api\PlanController@change_plan_duration');

    Route::post('/send-to-stripe','Api\PlanController@send_to_stripe');

    
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
    Route::any('/calendar','Website\UsersController@calendar');
    Route::get('/gift-certificates','Website\UsersController@gift_certificates');
    Route::get('/marketing-discount-coupons','Website\UsersController@marketing_discount_coupons');
    Route::get('/offers','Website\UsersController@offers');
    Route::get('/reports','Website\UsersController@reports');
    Route::get('/client-database/{search_param?}','Website\UsersController@client_database');
    Route::get('/client-export','Website\UsersController@client_export');
    Route::get('/staff-details/{search_param?}','Website\UsersController@staff_details');
    Route::get('/staff-export','Website\UsersController@staff_export');
    Route::get('/integration','Website\UsersController@integration');
    Route::get('/settings-business-hours/{search_param?}','Website\UsersController@settings_business_hours');
    Route::get('/booking-options','Website\BookingsController@booking_options');
    Route::get('/booking-rules','Website\BookingsController@booking_rules');
    Route::get('/booking-policies','Website\BookingsController@booking_policies');
    Route::get('/notification-settings','Website\BookingsController@notification_settings');
    Route::get('/email-customisation','Website\BookingsController@email_customisation');
    Route::get('/business-details2','Website\UsersController@business_details2');
    Route::get('/invitees','Website\UsersController@invitees');
    Route::get('/services/{type}/{category?}','Website\UsersController@services');
	Route::get('/payment-options','Website\UsersController@payment_options');
    Route::get('/invoice','Website\UsersController@invoice');
    Route::get('/create-invoice','Website\UsersController@create_invoice');
    Route::get('/invoice-details','Website\UsersController@invoice_details');
    Route::get('/invite-contacts','Website\UsersController@invite_contacts');
    Route::get('/add-location','Website\UsersController@add_location');
    Route::get('/privacy-settings','Website\UsersController@privacy_settings');
    Route::post('/email_customisation','Website\BookingsController@email_customisation');
    Route::get('/help','Website\UsersController@help');
    Route::get('/event-viewer','Website\UsersController@event_viewer');
    
    //Route::get('/profile-settings','Website\UsersController@profile_settings');
    //Route::get('/profile-settings','Website\UsersController@profile_settings');
    //Route::get('/profile-settings','Website\UsersController@profile_settings');
    //Route::get('/profile-settings','Website\UsersController@profile_settings');
    //Route::get('/profile-settings','Website\UsersController@profile_settings');
    //Route::get('/profile-settings','Website\UsersController@profile_settings');
    Route::get('/cancel_appointent_url','Website\UsersController@cancel_appointent_url');
    Route::get('/business-provider/{uesrname?}','Website\ClientsController@business_provider');
    Route::get('/client-service-details/{service?}','Website\ClientsController@client_service_details');


    Route::get('/profile-settings','Website\ProfileController@profile_settings');
    Route::get('/profile-picture','Website\ProfileController@profile_picture');
    Route::get('/profile-link','Website\ProfileController@profile_link');
    Route::get('/profile-payment','Website\ProfileController@profile_payment');
    Route::get('/profile-login','Website\ProfileController@profile_login');

    Route::get('/client-login','Website\ClientsController@client_login');

    Route::get('/settings-membership','Website\PlanController@settings_membership');

    Route::any('/make-payment/{parameter?}','Website\PlanController@make_payment');

    
    
});





/*
|-------------------------------------------------------------------------

|Client Routes

|------------------------------------------------------------------------

*/

Route::group(['prefix'=>'client'],function(){
    
    Route::get('/cancel_appointent/{parameter?}','Website\ClientsController@cancel_appointment');
    Route::get('/reschedule-appointment/{parameter?}','Website\ClientsController@reschedule_appointment');
    Route::get('/client-dashboard/{parameter?}','Website\ClientsController@client_dashboard');
    Route::get('/client-info/','Website\ClientsController@client_info');
    Route::get('/booking-verify/','Website\ClientsController@booking_verify');
    Route::get('/booking-details/','Website\ClientsController@booking_details');
    Route::get('/view-staffs/','Website\ClientsController@view_staff_list');
    Route::get('/forgot-password/{parameter?}','Website\ClientsController@forgot_password');

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







