<?php

return [

    'tables'=>[

        //admin 

        'masterAdmin' => 'admin_master',

        'categories' => 'categories',

        'countries' => 'countries',

        'profession' => 'profession',

        'currency' => 'currency',

        'user' => 'user',

        'user_service' => 'user_service',

        'user_token' => 'user_token',

        'staff' => 'staff',

        'client' => 'client',

        'user_email_customisation' => 'user_email_customisation',

        'appointment' => 'appointment',

        'calendar_settings' => 'calendar_settings',

        'block_date_time' => 'block_date_time',

        'booking_policy' => 'booking_policy',

        'user_notification_settings' => 'user_notification_settings',
        
        'payment_option' => 'payment_option',

        'staff_service_availability' => 'staff_service_availability',

        'staff_postal_code' => 'staff_postal_code',

        'user_event_viewer' => 'user_event_viewer',

        'plan' => 'plan',

        'user_subscription' => 'user_subscription',

        'user_dashboard_reports' => 'user_dashboard_reports',

        'service_invitee_question' => 'service_invitee_question',

        'feedback' => 'feedback',

        'service_availability' => 'service_availability',

        'booking_flow' => 'booking_flow',

        'booking_rule' => 'booking_rule',

        'notification_updates' => 'notification_updates',

    ],

    'google'=>[

        'apiKey'=>'AIzaSyDxyJd7QgKrzbLkzcidyq64H_YNyJaNoXA',

    ],



    // STRIPE //

    /***** Test Account *****/

    'stripe'=>[

        'CUSTOMER_ID'=>'ca_B8Dz9Fv0Ws0PWzP6eogVk91xdJpqELoi',

        'PUBLIC_KEY'=>'pk_test_yZ1a1tGQyNOv4sasz1ZvxnXB',

        'SECRET_KEY'=>'sk_test_mYBT9h1w3PgJOPLuBk9RErEe',

        'TOKEN_URI'=>'https://connect.stripe.com/oauth/token',

        'AUTHORIZE_URI'=>'https://connect.stripe.com/oauth/authorize',

    ],





];

?>

