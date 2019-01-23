<?php

/**

* @Author : NCRTS

* Table Controller for all database table name preference

* 

*/

namespace App\Http\Controllers;



class TablesController {

    //public $tableNameUser;

    function __construct(){

        



        $this->tableNameCategory = config('constants.tables.categories');

        $this->tableNameCountry = config('constants.tables.countries');

        $this->tableNameProfession = config('constants.tables.profession');

        $this->tableNameCurrency = config('constants.tables.currency');

        $this->tableNameStaff = config('constants.tables.staff');

        //admin section

        $this->tableNameMasterAdmin = config('constants.tables.masterAdmin');

        $this->tableNameUser = config('constants.tables.user');

        $this->tableUserService = config('constants.tables.user_service');

        $this->tableServiceInviteeQuestion = config('constants.tables.service_invitee_question');

        $this->tableNameUserRequestKey = config('constants.tables.user_token');

        $this->tableNameClient = config('constants.tables.client');

        $this->tableNameUserEmailCustomisation = config('constants.tables.user_email_customisation');

        $this->tableNameAppointment = config('constants.tables.appointment');

        $this->tableNameCalendarSettings = config('constants.tables.calendar_settings');


        $this->tableNameBlockDateTime = config('constants.tables.block_date_time');

        $this->tableNameBookingPolicy = config('constants.tables.booking_policy');

        $this->tableNameNotificationSettings = config('constants.tables.user_notification_settings');

        $this->tableNamePaymentOptions = config('constants.tables.payment_option');

        $this->tableNameStaffServiceAvailability = config('constants.tables.staff_service_availability');

        $this->tableNameStaffPostalCode = config('constants.tables.staff_postal_code');

        $this->tableNameUserEventViewer = config('constants.tables.user_event_viewer');

        $this->tableNamePlan = config('constants.tables.plan');

        $this->tableNameUserSubscription = config('constants.tables.user_subscription');

        $this->tableNameUserDashboardReport = config('constants.tables.user_dashboard_reports');

        $this->tableNameFeedback = config('constants.tables.feedback');

        $this->tableNameServiceAvailability = config('constants.tables.service_availability');

        $this->tableNameBookinFlow = config('constants.tables.booking_flow');

        $this->tableNameBookingRule = config('constants.tables.booking_rule');

        $this->tableNameNotificationUpdates = config('constants.tables.notification_updates');

        $this->tableNameUserClient = config('constants.tables.user_client');
        
        $this->tableNameEmailTemplateMaster = config('constants.tables.email_template_master');

        $this->tableNameReviewRequest = config('constants.tables.request_for_review');

        


        
        

        

    }

}