<?php 


return [

    'module' => [ 
        /*'country_manage'=> [
            'title'=>'Country Management System',
            'permission'=>[
                'country_view'=>'View Country'
            ]
        ],
    	'city_manage'=> [
    		'title'=>'City Management System',
    		'permission'=>[
    			'city_add'=>'Add City',
    			'city_edit'=>'Edit City',
    			'city_delete'=>'Delete City',
    			'city_view'=>'View City'
    		]
    	],
    	'state_manage'=>[
    		'title'=>'State Management System',
    		'permission'=>[
    			'state_add'=>'Add State',
    			'state_edit'=>'Edit State',
    			'state_delete'=>'Delete State',
    			'state_view'=>'View State'
    		]
    	],*/
        'category_manage'=>[
            'title'=>'Category Management System',
            'permission'=>[
                'category_add'=>'Add Category',
                'category_edit'=>'Edit Category',
                'category_delete'=>'Delete Category',
                'category_view'=>'View Category'
            ]
        ],
    	'sub_category_manage'=>[
    		'title'=>'Sub Category Management System',
    		'permission'=>[
    			'sub_category_add'=>'Add Sub-Category',
    			'sub_category_edit'=>'Edit Sub-Category',
    			'sub_category_delete'=>'Delete Sub-Category',
    			'sub_category_view'=>'View Sub-Category'
    		]
    	],
    	'plant_manage'=>[
    		'title'=>'Plant Management System',
    		'permission'=>[
    			'plant_manage_add'=>'Add Plant',
    			'plant_manage_edit'=>'Edit Plant',
    			'plant_manage_delete'=>'Delete Plant',
    			'plant_manage_view'=>'View Plant',
                // 'plant_manage_address_add'=>'Add Plant Address',
                // 'Plant_manage_address_view'=>'View Plant Address',
                // 'plant_manage_address_edit'=>'Edit Plant Address',
                // 'plant_manage_address_delete'=>'Delete Plant Address',
    		]
    	],

    	'party_manage'=>[
    		'title'=>'Party Management System',
    		'permission'=>[
    			'party_manage_add'=>'Add Party',
    			'party_manage_edit'=>'Edit Party',
    			'party_manage_delete'=>'Delete Party',
                'party_manage_view'=>'View Party',
    			// 'party_manage_distination_add'=>'Add Party Destination',
    			// 'party_manage_distination_edit'=>'Edit Party Destination',
    			// 'party_manage_distination_delete'=>'Delete Party Destination',
    			// 'party_manage_distination_view'=>'View Party Destination',

    		]
    	],

    	'petrol_pump_manage'=>[
    		'title'=>'Petrol Pump Management System',
    		'permission'=>[
    			'petrol_pump_add'=>'Add Petrol Pump',
    			'petrol_pump_edit'=>'Edit Petrol Pump',
    			'petrol_pump_delete'=>'Delete Petrol Pump',
    			'petrol_pump_view'=>'View Petrol Pump',
    		]
    	],

    	'truck_manage'=>[
    		'title'=>'Truck Management System',
    		'permission'=>[
    			'truck_manage_add'=>'Add Truck',
    			'truck_manage_edit'=>'Edit Truck',
    			'truck_manage_delete'=>'Delete Truck',
    			'truck_manage_view'=>'View Truck',
                //'truck_manage_gps_view' => 'GPS Tracking by Truck',
    		]
    	],
    	'trip_manage'=>[
    		'title'=>'Trip Management System',
    		'permission'=>[
    			'trip_manage_add'=>'Add Trip',
    			'trip_manage_edit'=>'Edit Trip',
    			'trip_manage_delete'=>'Delete Trip',
    			'trip_manage_view'=>'View Trip',
                //'trip_manage_gps_view'=>'GPS Tracking by Trip',
                'trip_manage_upload_pdo'=>'Upload POD',
                'trip_manage_pdf_view'=>'View PDF',
                'consolidated_trip' => 'Consolidated View of Trip',
                'extra_cash'    => 'Extra Cash',
                'extra_diesel'  => 'Extra Diesel',
    		]
    	],
    	'report_management_section'=>[
    		'title'=>'Reports',
    		'permission'=>[
    			'customer_report_management'=>'Customer Report',
                'vendor_report_management' => 'Vendor Pending',
                'diesel_report_management' => 'Diesel Report',
                'cash_report_management' => 'Cash Report',
                'payment_report_management' => 'Payment Report',
                'trip_report_management' => 'Trip Report',
    		]
    	],
        'user_manage'=>[
            'title'=>'User Management System',
            'permission'=>[
                'user_manage_add'=>'Add User',
                'user_manage_edit'=>'Edit User',
                'user_manage_delete'=>'Delete User',
                'user_manage_view'=>'View User',
                'user_manage_assign_role'=>'Assign User Role',
                'user_manage_add_role'=>'Add User Role',
                'user_manage_edit_role'=>'Add Edit Role',
                'user_manage_delete_role'=>'Delete User Role',
                'user_manage_view_role'=>'View User Role',
                'user_details'=>'User Details',
                'user_status'=>'User Status',
            ]
        ],
        'app_module_manage'=>[
            'title'=>'App Module Management System',
            'permission'=>[
                'app_module_manage_view'=>'View App Module',
                'app_module_manage_functionalities'=>'View App Module functionalities',
            ]
        ],
        'notification_manage'=>[
            'title'=>'Notification Management System',
            'permission'=>[
                'notification_insurance_view'=>'View Insurance',
                'notification_permit_view'=>'View Permit',
                'notification_tax_view'=>'View Tax',
                'notification_pollution_view'=>'View Pollution',
                'notification_registration_view'=>'View Registration'
            ]
        ],
        'approvle_management'=>[
            'title'=>'Approval Management System',
            'permission'=>[
                'approvle_adv_view'=>'View ADV List',
                'approvle_dsl_view'=>'View DSL List',
                'misclleneous_view'=>'View Miscellaneous List',
            ]
        ],
        'payment_module_manage'=>[
            'title'=>'Payment Management System',
            'permission'=>[
                //'plant_laser'=>'Plant Laser',
                //'petrolpump_laser'=>'Petrol Pump Laser',
                'petrolpump_payment'=>'Petrol Pump Payment',
                'plant_payment'=>'Plant Payment',
                'vendor_payment'=>'Vendor Payment'
            ]
        ],
        'address_zone_manage'=>[
            'title'=>'Address Zone System',
            'permission'=>[
                'address_zone_add'=>'Add Address Zone',
                'address_zone_edit'=>'Edit Address Zone',
                'address_zone_delete'=>'Delete Address Zone',
                'address_zone_view'=>'View Address Zone'
            ]
        ],
        'vendor_manage'=>[
            'title'=>'Vendor Management System',
            'permission'=>[
                'vendor_add'=>'Add Vendor',
                'vendor_edit'=>'Edit Vendor',
                'vendor_delete'=>'Delete Vendor',
                'vendor_view'=>'View Vendor'
            ]
        ],
    ]

];
