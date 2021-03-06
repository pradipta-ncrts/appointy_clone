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
    Route::post('/dashboard','Api\UsersController@dashboard');
    Route::post('/change_status_dashboard_report','Api\UsersController@change_status_dashboard_report');
    Route::post('/update-contact-info','Api\UsersController@update_contact_info');
    Route::post('/update-logo-social','Api\UsersController@update_logo_social');
    //Route::post('/add_staff','Api\UsersController@add_staff');
    Route::post('/service_list','Api\UsersController@service_list');
    Route::post('/chnage-service-status', 'Api\UsersController@chnage_service_status');
    Route::post('/clone-service', 'Api\UsersController@clone_service');
    Route::post('/delete-service', 'Api\UsersController@delete_service');
    Route::post('/add-new-service', 'Api\UsersController@add_new_service');
    Route::post('/update-service', 'Api\UsersController@update_service');
    Route::post('/update-service-duration', 'Api\UsersController@update_service_duration');
    Route::post('/update-service-payment', 'Api\UsersController@update_service_payment');
    Route::post('/update-service-confirmation', 'Api\UsersController@update_service_confirmation');
    Route::post('/update-service-invitee-notifications', 'Api\UsersController@update_service_invitee_notifications');
    Route::post('/add-invitee-question', 'Api\UsersController@add_invitee_question');
    Route::post('/payment_terms', 'Api\UsersController@payment_terms');
    Route::post('/service-details', 'Api\UsersController@service_details');
    Route::post('/service-invitee-question', 'Api\UsersController@service_invitee_question');
    Route::post('/invitee-question-details', 'Api\UsersController@invitee_question_details');
    Route::post('/update-invitee-question', 'Api\UsersController@update_invitee_question');
    Route::post('/delete-invitee-question', 'Api\UsersController@delete_invitee_question');
    Route::post('/delete-invitee-question', 'Api\UsersController@delete_invitee_question');
    Route::post('/service-availability', 'Api\UsersController@service_availability');
    Route::post('/add_staff','Api\StaffsController@add_staff');
    Route::post('/edit_staff','Api\StaffsController@edit_staff');
    Route::post('/edit_staff_login_data','Api\StaffsloginController@edit_staff_login_data');
    Route::post('/change-status-staff','Api\StaffsController@change_status_staff');
    Route::post('/staff_list','Api\StaffsController@staff_list');
    Route::post('/staff_import','Api\StaffsController@staff_import');
    Route::post('/staff-details','Api\StaffsController@staff_details');
    Route::post('/staff-details-login','Api\StaffsloginController@staff_details_login');
    Route::post('/delete-staff','Api\StaffsController@staff_delete');
    Route::post('/block-times','Api\StaffsController@block_times');
    Route::post('/staff_service_availability','Api\StaffsController@staff_service_availability');

    Route::post('/staff_service_availability_mobile','Api\StaffsController@staff_service_availability_mobile');
    Route::post('/service_staff_availability','Api\StaffsController@service_staff_availability');
    Route::post('/add_staff_service_availability','Api\StaffsController@add_staff_service_availability');
    Route::post('/delete_staff_availability','Api\StaffsController@delete_staff_availability');
    Route::post('/delete_staff_block_time','Api\StaffsController@delete_staff_block_time');
    Route::post('/services_lists','Api\StaffsController@services_lists');
    Route::post('/user_categories','Api\UsersController@user_categories');

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
    Route::post('/appoinment_list_staff','Api\StaffsloginController@appoinment_list_staff');
    Route::post('/notification_appoinment_list','Api\BookingsController@notification_appoinment_list');
    Route::post('/appoinment_list_mobile','Api\BookingsController@appoinment_list_mobile');
    Route::post('/recurring_appoinment_list_mobile','Api\BookingsController@recurring_appoinment_list_mobile');
    Route::post('/recurring_appoinment_details','Api\BookingsController@recurring_appoinment_details');
    Route::post('/staff_assignment','Api\BookingsController@staff_assignment');
    Route::post('/staff_appoinment_list_mobile','Api\StaffsloginController@staff_appoinment_list_mobile');
    Route::post('/client_appoinment_list_mobile','Api\BookingsController@client_appoinment_list_mobile');
    Route::post('/appointment_details','Api\BookingsController@appointment_details');
    Route::post('/staff_appointment_details','Api\StaffsloginController@staff_appointment_details');
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
    Route::post('/client_appointment_details_by_appointment_id','Api\ClientsController@appointment_details');
    Route::post('/reschedule_appointment_process','Api\ClientsController@reschedule_appointment_process');
    Route::post('/cancel_appointment_process','Api\ClientsController@cancel_appointment_process');
    Route::post('/business_provider_list','Api\ClientsController@business_provider_list');
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

    Route::post('/area_code','Api\StaffsController@area_code');
    Route::post('/get_post_code','Api\StaffsController@get_post_code');
    Route::post('/chnage_postal_code_status','Api\StaffsController@chnage_postal_code_status');
    Route::post('/postal_code_filter','Api\StaffsController@postal_code_filter');
    Route::post('/change_postal_code_customer_interface','Api\StaffsController@change_postal_code_customer_interface');

    Route::post('/client_login','Api\ClientsController@client_login');
    Route::post('/client_forgot_password','Api\ClientsController@client_forgot_password');
    Route::post('/client_registration','Api\ClientsController@client_registration');
    Route::any('/client_emailverification/{id}','Api\ClientsController@client_emailverification');
    Route::post('/client_info','Api\ClientsController@client_info');
    Route::post('/service_provicer_category_list','Api\ClientsController@service_provicer_category_list');
    Route::post('/service_invitee_question','Api\ClientsController@service_invitee_question');
    Route::any('/service_payment_terms','Api\ClientsController@service_payment_terms');
    Route::post('/client_appointment_booking_process','Api\ClientsController@client_appointment_booking_process');
    Route::post('/get_booking_rule','Api\ClientsController@get_booking_rule');
    Route::post('/client_profile_picture_upload','Api\ClientsController@client_profile_picture_upload');
    Route::post('/client_change_password','Api\ClientsController@client_change_password');
    Route::post('/client_booking_details','Api\ClientsController@client_booking_details');
    
    
    
    Route::post('/event_viewer_list','Api\UsersController@event_viewer_list');
    Route::post('/settings_membership','Api\PlanController@settings_membership');
    Route::post('/change_plan_duration','Api\PlanController@change_plan_duration');
    Route::post('/send-to-stripe','Api\PlanController@send_to_stripe');
    Route::post('/send-to-stripe-mobile','Api\PlanController@send_to_stripe_mobile');
    Route::post('/edit_service_list_staff','Api\StaffsController@edit_service_list_staff');
    Route::post('/update_staff_availability_form','Api\StaffsController@update_staff_availability_form');
    Route::post('/service-template','Api\UsersController@service_template');
    Route::post('/client_appointment_list','Api\ClientsController@client_appointment_list');
    Route::post('/client_payment_list','Api\ClientsController@client_payment_list');
    Route::post('/client_appointment_status','Api\ClientsController@client_appointment_status');
    Route::post('/client_booking_list','Api\ClientsController@client_booking_list');
    Route::post('/client-update-profile-settings','Api\ClientsController@client_update_profile_settings');

    Route::any('/staff_login','Api\UsersController@staff_login');
    Route::any('/staff_details_mobile','Api\StaffsController@staff_details_mobile');
    Route::any('/edit_team_member_indiv','Api\StaffsController@edit_team_member_indiv');
    Route::any('/update-profile-mobile','Api\ProfileController@update_profile_mobile');
    Route::any('/update-service-availability','Api\ProfileController@update_service_availability');

    Route::post('/get-service-colour-code','Api\BookingsController@get_service_colour_code');

    Route::post('/update_booking_flow','Api\BookingsController@update_booking_flow');
    Route::any('/booking_flow_data','Api\BookingsController@booking_flow_data');

    Route::post('/update_booking_rule','Api\BookingsController@update_booking_rule');
    Route::post('/update_lead_cancellation_time','Api\BookingsController@update_lead_cancellation_time');
    Route::any('/booking_rule_data','Api\BookingsController@booking_rule_data');

    Route::any('/notification_appointment_status','Api\BookingsController@notification_appointment_status');
    Route::any('/notification_profile_info','Api\BookingsController@notification_profile_info');

    Route::any('/notification_feedback','Api\BookingsController@notification_feedback');

    Route::any('/notification_update','Api\BookingsController@notification_update');

    Route::any('/request_for_review','Api\BookingsController@request_for_review');


 

    // Get appointments via API Key//
    Route::any('/fetch_appointments','Api\BookingsController@fetch_appointments');
    Route::any('/changepssword','Api\UsersController@changepssword');
    Route::any('/staff_changepssword','Api\StaffsloginController@staff_changepssword');
    Route::any('/get_stripe_email','Api\IntregrationController@get_stripe_email');
    Route::any('/invoice_booking_details','Api\InvoiceController@invoice_booking_details');
    Route::any('/send_staff_verification_email','Api\StaffsController@send_staff_verification_email');
    Route::any('/change_email','Api\ProfileController@change_email');
    Route::any('/delete_client','Api\ClientsController@delete_client');
    Route::post('/update_guide_value','Api\UsersController@update_guide_value');
    Route::any('/process-registration-step2','Api\UsersController@process_registration_step2');
    Route::any('/check_service_provider_username','Api\ProfileController@check_service_provider_username');
    Route::any('/appoinment_list_staff_mobile','Api\BookingsController@appoinment_list_staff_mobile');

    Route::any('/remove_invitee','Api\UsersController@remove_invitee');
    Route::any('/resend_invitee','Api\UsersController@resend_invitee');


    
});



/*
|-------------------------------------------------------------------------
|Website Routes
|------------------------------------------------------------------------
*/

Route::group(['prefix'=>''],function(){
    Route::get('/login','Website\UsersController@login');
    Route::any('/forgot-password/{user_data?}','Website\UsersController@forgot_password');
    Route::any('/send_reset_password_link','Website\UsersController@send_reset_password_link');
    Route::any('/','Website\UsersController@registration');
    Route::get('/registration-step1/{request_url}','Website\UsersController@registration_step1');
    Route::get('/registration-step2/{request_url}','Website\UsersController@registration_step2');
    Route::get('/dashboard/{type?}','Website\UsersController@dashboard');
    Route::get('/logout', 'Website\UsersController@logout');
    Route::any('/thank-you','Website\UsersController@thank_you');
    Route::get('/business-contact-info','Website\UsersController@business_contact_info');
    Route::get('/business-logo-social-network','Website\UsersController@business_logo_social_network');
    Route::any('/staff-dashboard','Website\StaffController@staff_dashboard');
    
    //Only for link purpose
    Route::any('/calendar/{service_id?}','Website\UsersController@calendar');
    Route::get('/gift-certificates','Website\UsersController@gift_certificates');
    Route::get('/marketing-discount-coupons','Website\UsersController@marketing_discount_coupons');
    Route::get('/offers','Website\UsersController@offers');
    Route::get('/reports','Website\UsersController@reports');
    Route::get('/client-database/{search_param?}','Website\UsersController@client_database');
    Route::get('/client-export','Website\UsersController@client_export');
    Route::get('/staff-details/{search_param?}','Website\UsersController@staff_details');
    Route::get('/staff-export','Website\UsersController@staff_export');
    Route::get('/integration','Website\IntregrationController@integration');
    Route::get('/settings-business-hours/{type}/{search_param?}','Website\UsersController@settings_business_hours');
    Route::get('/booking-options','Website\BookingsController@booking_options');
    Route::get('/booking-rules','Website\BookingsController@booking_rules');
    Route::get('/booking-policies','Website\BookingsController@booking_policies');
    Route::get('/notification-settings','Website\BookingsController@notification_settings');
    Route::get('/email-customisation','Website\BookingsController@email_customisation');
    Route::get('/business-details2','Website\UsersController@business_details2');
    Route::get('/invitees','Website\UsersController@invitees');
    Route::get('/services/{type}/{category?}','Website\UsersController@services');
    Route::get('/create_new_service','Website\UsersController@create_new_service');
    Route::get('/add_services/{type?}','Website\UsersController@add_services');
    Route::get('/edit_service/{service_id?}','Website\UsersController@edit_service');

	Route::get('/payment-options','Website\InvoiceController@payment_options');
    Route::get('/invoice','Website\InvoiceController@invoice');
    Route::get('/create-invoice/{order_id}','Website\InvoiceController@create_invoice');
    Route::get('/invoice-details/{order_id}','Website\InvoiceController@invoice_details');

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
    //Route::get('/client-service-details/{service?}','Website\ClientsController@client_service_details');


    Route::get('/profile-settings','Website\ProfileController@profile_settings');
    Route::get('/profile-picture','Website\ProfileController@profile_picture');
    Route::get('/profile-link','Website\ProfileController@profile_link');
    Route::get('/profile-payment','Website\ProfileController@profile_payment');
    Route::get('/profile-login','Website\ProfileController@profile_login');

    
    Route::get('/settings-membership','Website\PlanController@settings_membership');

    Route::any('/make-payment/{parameter?}','Website\PlanController@make_payment');

    Route::any('/booking-list/{duration?}','Website\BookingsController@booking_list');

    Route::any('/recurring-booking-list/{duration?}','Website\BookingsController@recurring_booking_list');

    Route::any('/recurring-booking-details/{order_id?}','Website\BookingsController@recurring_booking_details');
    
    Route::any('/staff-booking-list/{duration?}','Website\StaffController@staff_booking_list');

    Route::any('/stripe-connect','Website\IntregrationController@stripe_connect');

    Route::any('/paypal_intregration','Website\IntregrationController@paypal_intregration');

    Route::any('/client_stripe_payment/{parameter?}','Website\ClientsPaymentController@client_stripe_payment');

    Route::any('/client_payment_status/{parameter?}','Website\ClientsPaymentController@client_payment_status');

    Route::any('/client_paypal_payment/{parameter?}','Website\ClientsPaymentController@client_paypal_payment');

    Route::any('/client_paypal_success','Website\ClientsPaymentController@client_paypal_success');

    Route::any('/recuring_booking_list','Website\RecuringBookingController@recuring_booking_list');

    Route::any('/recuring_booking_details','Website\RecuringBookingController@recuring_booking_details');

    Route::any('/send_invoice','Website\InvoiceController@send_invoice');

    Route::any('/save_as_draft','Website\InvoiceController@save_as_draft');

    
    Route::get('/terms-and-condition','Website\UsersController@terms_and_condition');

    Route::get('/privacy-policy','Website\UsersController@privacy_policy');
    Route::any('/staff-verification-link/{staff_id}','Website\StaffController@staff_verification_link');
    Route::get('/calendar-connections','Website\UsersController@calendar_connections');

    Route::any('/send_sms','Website\UsersController@send_sms');

    
       
});



/*
|-------------------------------------------------------------------------
|Mobile Routes
|------------------------------------------------------------------------
*/

Route::group(['prefix'=>'mobile'],function(){
    Route::get('/login','Mobile\UsersController@login');
    Route::any('/','Mobile\UsersController@registration');
    Route::any('/registration-step','Mobile\UsersController@registration_step');
    Route::get('/registration-step1/{request_url}','Mobile\UsersController@registration_step1');
    Route::get('/registration-step2/{request_url}','Mobile\UsersController@registration_step2');
    Route::get('/dashboard/{type?}','Mobile\UsersController@dashboard');
    Route::get('/logout', 'Mobile\UsersController@logout');
    Route::get('/client-list/{search_param?}','Mobile\ClientsController@client_list');
    Route::get('/client-details/{search_param?}','Mobile\ClientsController@client_details');
    Route::get('/booking-list/{duration?}/{search_param?}','Mobile\BookingsController@booking_list');
    Route::get('/client-booking-list/{duration?}/{client_id?}','Mobile\BookingsController@client_booking_list');

    Route::get('/my-profile','Mobile\UsersController@my_profile');
    Route::get('/add-appointment','Mobile\BookingsController@add_appointment');
    Route::get('/add-client','Mobile\ClientsController@add_client');
    Route::get('/edit-client/{client_id}','Mobile\ClientsController@edit_client');
    Route::get('/staff-list','Mobile\StaffController@staff_list');
    Route::get('/add-staff','Mobile\StaffController@add_staff');
    Route::get('/service-list/{type?}/{service_category?}','Mobile\ServiceController@service_list');
    Route::get('/create-service','Mobile\ServiceController@create_service');
    Route::get('/add_services/{type?}','Mobile\ServiceController@add_services');
    Route::get('/edit_service/{service_id?}','Mobile\ServiceController@edit_service');
    Route::get('/review-list','Mobile\ReviewController@review_list');
    Route::get('/settings','Mobile\SettingsController@settings');
    Route::get('/membership','Mobile\PlanController@membership');
    Route::get('/business-hours','Mobile\UsersController@business_hours');
    Route::any('/make-payment/{parameter?}','Mobile\PlanController@make_payment');
    Route::any('/my-squeedr/{username?}','Mobile\UsersController@my_squeedr');
    Route::get('/staff-dashboard','Mobile\StaffController@staff_dashboard');
    Route::get('/staff-booking-list','Mobile\StaffController@staff_booking_list');
    Route::get('/staff-booking-list/{duration?}/','Mobile\StaffController@staff_booking_list');
    Route::any('/client-note/{search_param?}','Mobile\ClientsController@client_note');
    Route::any('/calendar','Mobile\UsersController@calendar');
    Route::any('/scan','Mobile\ScanController@scan');
    Route::any('/help','Mobile\helpController@help');
    Route::any('/forgot-password/{user_data?}','Mobile\UsersController@forgot_password');
    Route::any('/send_reset_password_link','Mobile\UsersController@send_reset_password_link');
    Route::get('/staff_calendar/{duration?}/','Mobile\StaffController@staff_calendar');
    Route::any('/add-client-notes','Mobile\ClientsController@add_client_notes');

});


/*
|-------------------------------------------------------------------------
|Client Routes
|------------------------------------------------------------------------
*/

Route::group(['prefix'=>'client'],function(){
    Route::get('/login','Website\ClientsController@client_login');
    Route::get('/registration','Website\ClientsController@client_registration');
    Route::get('/logout','Website\ClientsController@client_logout');
    Route::get('/cancel_appointent/{parameter?}','Website\ClientsController@cancel_appointment');
    Route::get('/reschedule-appointment/{parameter?}','Website\ClientsController@reschedule_appointment');
    Route::get('/client-dashboard/{parameter?}','Website\ClientsController@client_dashboard');
    Route::get('/client-info','Website\ClientsController@client_info');
    Route::get('/booking-verify','Website\ClientsController@booking_verify');
    //Route::get('/booking-details','Website\ClientsController@booking_details');
    Route::get('/view-staffs/{username?}','Website\ClientsController@view_staff_list');
    Route::get('/forgot-password/{parameter?}','Website\ClientsController@forgot_password');
    Route::get('/service-details/{service?}','Website\ClientsController@client_service_details');
    Route::get('/verification/{parameter?}','Website\ClientsController@client_verification');
    Route::get('/appointment-booking/{parameter?}','Website\ClientsController@client_appointment_booking');
    Route::get('/appointment-confirmation/{parameter?}','Website\ClientsController@client_appointment_confirmation');
    Route::any('/booking-list/{parameter?}/{duration?}','Website\ClientsController@client_booking_list');
    Route::any('/recurring-booking-list/{parameter?}/{duration?}','Website\ClientsController@client_recurring_booking_list');
    Route::any('/booking-details/{parameter?}/{order_id?}','Website\ClientsController@client_booking_details');
    Route::get('/profile-settings/{parameter?}','Website\ClientsController@client_profile_settings');
    Route::get('/profile-picture-settings/{parameter?}','Website\ClientsController@client_profile_picture_settings');
    Route::get('/login-settings/{parameter?}','Website\ClientsController@client_login_settings');

    

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







