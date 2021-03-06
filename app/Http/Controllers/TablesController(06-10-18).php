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

        $this->tableNameUserRequestKey = config('constants.tables.user_token');

        $this->tableNameClient = config('constants.tables.client');

        $this->tableNameUserEmailCustomisation = config('constants.tables.user_email_customisation');

        $this->tableNameAppointment = config('constants.tables.appointment');

        $this->tableNameCalendarSettings = config('constants.tables.calendar_settings');


        $this->tableNameBlockDateTime = config('constants.tables.block_date_time');

        $this->tableNameBookingPolicy = config('constants.tables.booking_policy');

        $this->tableNameNotificationSettings = config('constants.tables.user_notification_settings');

        $this->tableNamePlan = config('constants.tables.plan');

        





        

    }

}