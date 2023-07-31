  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(\Auth::user()->profile_picture == null)
            <img src="{{asset(\Config::get('constants.profileImagePath'))}}/common_customer_image.jpg" class="user-image" alt="User Image"/>
          @else
            <img src="{{asset(\Config::get('constants.profileImagePath'))}}/{{ \Auth::user()->profile_picture }}" class="user-image" alt="User Image"/>
          @endif
        </div>
        <div class="pull-left info">
          <p>
            <?php echo \Auth::user()->full_name; 
                  //echo \Route::currentRouteName();
            ?>
          </p>

          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!--<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="<?php echo \URL::route('dashboard'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
          </a>
          <!--<ul class="treeview-menu" style="display: none;">
            <li><a href="#"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>-->
        </li>
        
                   
        @permission('app_module_manage')   
          <li class="treeview {{setMenu('app-module')}}">
            <a href="#">
              <i class="fa fa fa-gear"></i>
              <span>App Module Management</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu {{setMenu('app-module')}}">
              <li {{setSubMenu('app-module','app.module.list')}}>
                <a href="{{route('app.module.list')}}"><i class="fa fa-circle-o"></i>App Module List</a>
              </li>
              <li {{setSubMenu('app-module','app.module.functionalities')}}>
                <a href="{{route('app.module.functionalities')}}"><i class="fa fa-circle-o"></i>App Module Functionality List</a>
              </li>
            </ul>
          </li>            
        @endpermission

        @permission('user_manage')          
          <li class="treeview {{setMenu('user')}}">
              <a href="#">
                  <i class="fa fa-folder"></i>
                  <span>User Management </span>
                  <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu {{setMenu('user')}}">
                @can('user_manage_view_role')
                  <li {{setSubMenu('user','user.role')}} >
                      <a href="{{route('user.role')}}"><i class="fa fa-circle-o"></i>User Role</a>
                  </li>
                @endcan
                  {{-- <li {{setSubMenu('user','user.permission')}}>
                      <a href="{{route('user.permission')}}"><i class="fa fa-circle-o"></i>User Permission</a>
                  </li> --}}
                @can('user_manage_view')
                  <li {{setSubMenu('user','user.list')}}>
                    <a href="{{route('user.list')}}"><i class="fa fa-circle-o"></i>User</a>
                  </li>
                @endcan
                @can('user_manage_add')
                  <li {{setSubMenu('user','user.create')}}> 
                      <a href="{{route('user.create')}}"><i class="fa fa-circle-o"></i>Add User</a>
                  </li>
                @endcan
              </ul>
          </li>
        @endpermission

        @permission('category_manage')
          <li class="treeview <?php if(\Route::currentRouteName() == 'categories' || \Route::currentRouteName() == 'viewAddCategory' || \Route::currentRouteName() == 'viewEditCategory') echo 'active' ?>">
            <a href="#">
              <i class="fa fa-list"></i> <span>Category</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu <?php if(\Route::currentRouteName() == 'categories' || \Route::currentRouteName() == 'viewAddCategory' || \Route::currentRouteName() == 'viewEditCategory') echo 'menu-open' ?>">
              @can('category_view')
                <li class="<?php if(\Route::currentRouteName() == 'categories'||\Route::currentRouteName() == 'viewEditCategory') echo 'active' ?>"><a href="<?php echo \URL::route('categories'); ?>"><i class="fa fa-circle-o"></i>Category List</a></li>
              @endcan
              @can('category_add')
                <li class="<?php if(\Route::currentRouteName() == 'viewAddCategory') echo 'active' ?>"><a href="<?php echo \URL::route('viewAddCategory'); ?>"><i class="fa fa-circle-o"></i>Add Category</a></li>
              @endcan
            </ul>
          </li>
        @endpermission

        @permission('sub_category_manage')
          <li class="treeview <?php if(\Route::currentRouteName() == 'subcategories' || \Route::currentRouteName() == 'viewAddSubcategory' || \Route::currentRouteName() == 'viewEditSubcategory') echo 'active' ?>">
            <a href="#">
              <i class="fa fa-sliders"></i> <span>Sub-Category (Item) </span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu <?php if(\Route::currentRouteName() == 'subcategories' || \Route::currentRouteName() == 'viewAddSubcategory' || \Route::currentRouteName() == 'viewEditSubcategory') echo 'menu-open' ?>">
              @can('sub_category_view')
                <li class="<?php if(\Route::currentRouteName() == 'subcategories'||\Route::currentRouteName() == 'viewEditSubcategory') echo 'active' ?>"><a href="<?php echo \URL::route('subcategories'); ?>"><i class="fa fa-circle-o"></i>Sub-Category List</a></li>
              @endcan
              @can('sub_category_add')
                <li class="<?php if(\Route::currentRouteName() == 'viewAddSubcategory') echo 'active' ?>"><a href="<?php echo \URL::route('viewAddSubcategory'); ?>"><i class="fa fa-circle-o"></i>Add Sub-Category</a></li>
              @endcan
            </ul>
          </li>
        @endpermission

        @permission('address_zone_manage')
          <li class="treeview <?php if(\Route::currentRouteName() == 'addressZones' || \Route::currentRouteName() == 'viewAddAddressZone' || \Route::currentRouteName() == 'viewEditAddressZone') echo 'active' ?>">
            <a href="#">
              <i class="fa fa-map-marker"></i> <span>Address Zones</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu <?php if(\Route::currentRouteName() == 'addressZones' || \Route::currentRouteName() == 'viewAddAddressZone' || \Route::currentRouteName() == 'viewEditAddressZone') echo 'menu-open' ?>">
              @can('address_zone_view')
                <li class="<?php if(\Route::currentRouteName() == 'addressZones'||\Route::currentRouteName() == 'viewEditAddressZone') echo 'active' ?>"><a href="<?php echo \URL::route('addressZones'); ?>"><i class="fa fa-circle-o"></i>Address Zones</a></li>
              @endcan
              @can('address_zone_add')
                <li class="<?php if(\Route::currentRouteName() == 'viewAddAddressZone') echo 'active' ?>"><a href="<?php echo \URL::route('viewAddAddressZone'); ?>"><i class="fa fa-circle-o"></i>Add Address Zone</a></li>
              @endcan
            </ul>
          </li>
        @endpermission

        @permission('plant_manage')
          <li class="treeview <?php if(\Route::currentRouteName() == 'plants' || \Route::currentRouteName() == 'viewAddPlant' || \Route::currentRouteName() == 'viewEditPlant' || \Route::currentRouteName() == 'plantAddresses' || \Route::currentRouteName() == 'plantView' || \Route::currentRouteName() == 'viewAddPlantAddress' || \Route::currentRouteName() == 'viewEditPlantAddress') echo 'active' ?>">
            <a href="#">
              <i class="fa fa-file-text"></i> <span>Plant Management</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu <?php if(\Route::currentRouteName() == 'plants' || \Route::currentRouteName() == 'viewAddPlant' || \Route::currentRouteName() == 'viewEditPlant' || \Route::currentRouteName() == 'plantAddresses' || \Route::currentRouteName() == 'viewAddPlantAddress' || \Route::currentRouteName() == 'viewEditPlantAddress') echo 'menu-open' ?>">
              @can('plant_manage_view')
                <li class="<?php if(\Route::currentRouteName() == 'plants'||\Route::currentRouteName() == 'viewEditPlant') echo 'active' ?>"><a href="<?php echo \URL::route('plants'); ?>"><i class="fa fa-circle-o"></i>Plant List</a></li>
              @endcan
              @can('plant_manage_add')
                <li class="<?php if(\Route::currentRouteName() == 'viewAddPlant') echo 'active' ?>"><a href="<?php echo \URL::route('viewAddPlant'); ?>"><i class="fa fa-circle-o"></i>Add Plant</a></li>
              @endcan
            </ul>
          </li>
        @endpermission

        @permission('party_manage')
          <li class="treeview <?php if(\Route::currentRouteName() == 'parties' || \Route::currentRouteName() == 'viewAddParty' || \Route::currentRouteName() == 'viewEditParty' || \Route::currentRouteName() == 'partyDestinations' || \Route::currentRouteName() == 'partyView' || \Route::currentRouteName() == 'viewAddPartyDestination' || \Route::currentRouteName() == 'viewEditPartyDestination' ) echo 'active' ?>">
            <a href="#">
              <i class="fa fa-crosshairs"></i> <span>Party Management (Destination)  </span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu <?php if(\Route::currentRouteName() == 'parties' || \Route::currentRouteName() == 'viewAddParty' || \Route::currentRouteName() == 'viewEditParty' || \Route::currentRouteName() == 'partyDestinations' || \Route::currentRouteName() == 'viewAddPartyDestination' || \Route::currentRouteName() == 'viewEditPartyDestination') echo 'menu-open' ?>">
              @can('party_manage_view')
                <li class="<?php if(\Route::currentRouteName() == 'parties'||\Route::currentRouteName() == 'viewEditParty') echo 'active' ?>"><a href="<?php echo \URL::route('parties'); ?>"><i class="fa fa-circle-o"></i>Party List</a></li>
              @endcan
              @can('party_manage_add')
                <li class="<?php if(\Route::currentRouteName() == 'viewAddParty') echo 'active' ?>"><a href="<?php echo \URL::route('viewAddParty'); ?>"><i class="fa fa-circle-o"></i>Add Party</a></li>
              @endcan
            </ul>
          </li>
        @endpermission

        @permission('petrol_pump_manage')
          <li class="treeview <?php if(\Route::currentRouteName() == 'petrolPumps' || \Route::currentRouteName() == 'viewAddPetrolPump' || \Route::currentRouteName() == 'viewEditPetrolPump' || \Route::currentRouteName() == 'petrolPumpView') echo 'active' ?>">
            <a href="#">
              <i class="fa fa-bullhorn"></i> <span>Petrol Pump Management </span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu <?php if(\Route::currentRouteName() == 'petrolPumps' || \Route::currentRouteName() == 'viewAddPetrolPump' || \Route::currentRouteName() == 'viewEditPetrolPump' || \Route::currentRouteName() == 'petrolPumpView') echo 'menu-open' ?>">
              @can('petrol_pump_view')
                <li class="<?php if(\Route::currentRouteName() == 'petrolPumps' || \Route::currentRouteName() == 'viewEditPetrolPump') echo 'active' ?>"><a href="<?php echo \URL::route('petrolPumps'); ?>"><i class="fa fa-circle-o"></i>Petrol Pump List</a></li>
              @endcan
              @can('petrol_pump_add')
                <li class="<?php if(\Route::currentRouteName() == 'viewAddPetrolPump') echo 'active' ?>"><a href="<?php echo \URL::route('viewAddPetrolPump'); ?>"><i class="fa fa-circle-o"></i>Add Petrol Pump</a></li>
              @endcan
            </ul>
          </li>
        @endpermission


        @permission('vendor_manage')
          <li class="treeview <?php if(\Route::currentRouteName() == 'vendors' || \Route::currentRouteName() == 'viewAddVendor' || \Route::currentRouteName() == 'viewEditVendor' || \Route::currentRouteName() == 'vendorView') echo 'active' ?>">
            <a href="#">
              <i class="fa fa-building"></i> <span> Vendor Management</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu <?php if(\Route::currentRouteName() == 'vendors' || \Route::currentRouteName() == 'viewAddVendor' || \Route::currentRouteName() == 'viewEditVendor' || \Route::currentRouteName() == 'vendorView') echo 'menu-open' ?>">
              @can('vendor_view')
                <li class="<?php if(\Route::currentRouteName() == 'vendors'||\Route::currentRouteName() == 'viewEditVendor') echo 'active' ?>"><a href="<?php echo \URL::route('vendors'); ?>"><i class="fa fa-circle-o"></i>Vendors</a></li>
              @endcan
              @can('vendor_add')
                <li class="<?php if(\Route::currentRouteName() == 'viewAddVendor') echo 'active' ?>"><a href="<?php echo \URL::route('viewAddVendor'); ?>"><i class="fa fa-circle-o"></i>Add Vendor</a></li>
              @endcan
            </ul>
          </li>
        @endpermission


        @permission('truck_manage')
           <li class="treeview <?php if(\Route::currentRouteName() == 'trucks' || \Route::currentRouteName() == 'viewAddTruck' || \Route::currentRouteName() == 'viewEditTruck' || \Route::currentRouteName() == 'truckView' || \Route::currentRouteName() == 'gpsTruckList') echo 'active' ?>">
            <a href="#">
              <i class="fa fa-truck"></i> <span>Truck Management</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu <?php if(\Route::currentRouteName() == 'trucks' || \Route::currentRouteName() == 'viewAddTruck' || \Route::currentRouteName() == 'viewEditTruck' || \Route::currentRouteName() == 'truckView') echo 'menu-open' ?>">
              @can('truck_manage_view')
                <li class="<?php if(\Route::currentRouteName() == 'trucks' || \Route::currentRouteName() == 'viewEditTruck') echo 'active' ?>"><a href="<?php echo \URL::route('trucks'); ?>"><i class="fa fa-circle-o"></i>Truck List</a></li>
              @endcan
              @can('truck_manage_add')
                <li class="<?php if(\Route::currentRouteName() == 'viewAddTruck') echo 'active' ?>"><a href="<?php echo \URL::route('viewAddTruck'); ?>"><i class="fa fa-circle-o"></i>Add Truck</a></li>
              @endcan
              @can('truck_manage_gps_view')
                <li style="display:none;" class="<?php if(\Route::currentRouteName() == 'gpsTruckList') echo 'active' ?>"><a href="<?php echo \URL::route('gpsTruckList'); ?>"><i class="fa fa-circle-o"></i>GPS Tracking</a></li>
              @endcan
            </ul>
          </li>
        @endpermission


        @permission('notification_manage')
          <li  class="treeview <?php if(\Route::currentRouteName() == 'notification_insurance_view' || \Route::currentRouteName() == 'notification_permit_view' || \Route::currentRouteName() == 'notification_tax_view' || \Route::currentRouteName() == 'notification_pollution_view' || \Route::currentRouteName() == 'notification_registration_view') echo 'active' ?>">
            <a href="#">
              <i class="fa fa-bell"></i> <span>Notification</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu <?php if(\Route::currentRouteName() == 'notification_insurance_view' || \Route::currentRouteName() == 'notification_permit_view' || \Route::currentRouteName() == 'notification_tax_view' || \Route::currentRouteName() == 'notification_pollution_view' || \Route::currentRouteName() == 'notification_registration_view') echo 'menu-open' ?>">

              @can('notification_insurance_view')
                <li class="<?php if(\Route::currentRouteName() == 'notification_insurance_view') echo 'active' ?>"><a href="<?php echo \URL::route('notification_insurance_view'); ?>"><i class="fa fa-circle-o"></i>Insurance</a></li>
              @endcan
              @can('notification_permit_view')
                <li class="<?php if(\Route::currentRouteName() == 'notification_permit_view') echo 'active' ?>"><a href="<?php echo \URL::route('notification_permit_view'); ?>"><i class="fa fa-circle-o"></i>Permit</a></li>
              @endcan
              @can('notification_tax_view')
                <li class="<?php if(\Route::currentRouteName() == 'notification_tax_view') echo 'active' ?>"><a href="<?php echo \URL::route('notification_tax_view'); ?>"><i class="fa fa-circle-o"></i>Tax</a></li>
              @endcan
              @can('notification_pollution_view')
                <li class="<?php if(\Route::currentRouteName() == 'notification_pollution_view') echo 'active' ?>"><a href="<?php echo \URL::route('notification_pollution_view'); ?>"><i class="fa fa-circle-o"></i>Pollution</a></li>
              @endcan
              @can('notification_registration_view')
                <li class="<?php if(\Route::currentRouteName() == 'notification_registration_view') echo 'active' ?>"><a href="<?php echo \URL::route('notification_registration_view'); ?>"><i class="fa fa-circle-o"></i>Registration</a></li>
              @endcan
            </ul>
          </li>
        @endpermission


        @permission('trip_manage')
          <li  class="treeview <?php if(\Route::currentRouteName() == 'trips' || \Route::currentRouteName() == 'viewAddTrip' || \Route::currentRouteName() == 'viewEditTrip' || \Route::currentRouteName() == 'tripView' || \Route::currentRouteName() == 'pdfTrip' || \Route::currentRouteName() == 'gpsTripList' || \Route::currentRouteName() == 'viewConsolidatedtripList' || \Route::currentRouteName() == 'extraCashList' || \Route::currentRouteName() == 'extraDieselList' || \Route::currentRouteName() == 'viewAddExtraCash' || \Route::currentRouteName() == 'viewEditExtraCash' || \Route::currentRouteName() == 'viewAddExtraDiesel' || \Route::currentRouteName() == 'viewEditExtraDiesel') echo 'active' ?>">
            <a href="#">
              <i class="fa fa-plane"></i> <span>Trip Management</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu <?php if(\Route::currentRouteName() == 'trips' || \Route::currentRouteName() == 'viewAddTrip' || \Route::currentRouteName() == 'viewEditTrip' || \Route::currentRouteName() == 'tripView' || \Route::currentRouteName() == 'gpsTripList' || \Route::currentRouteName() == 'pdfTrip' || \Route::currentRouteName() == 'viewConsolidatedtripList' || \Route::currentRouteName() == 'extraCashList' || \Route::currentRouteName() == 'extraDieselList' || \Route::currentRouteName() == 'viewAddExtraCash' || \Route::currentRouteName() == 'viewEditExtraCash' || \Route::currentRouteName() == 'viewAddExtraDiesel' || \Route::currentRouteName() == 'viewEditExtraDiesel') echo 'menu-open' ?>">
              @can('trip_manage_view')
                <li class="<?php if(\Route::currentRouteName() == 'trips' || \Route::currentRouteName() == 'viewEditTrip') echo 'active' ?>"><a href="<?php echo \URL::route('trips'); ?>"><i class="fa fa-circle-o"></i>Trip List</a></li>
              @endcan
              @can('trip_manage_add')
                <li class="<?php if(\Route::currentRouteName() == 'viewAddTrip') echo 'active' ?>"><a href="<?php echo \URL::route('viewAddTrip'); ?>"><i class="fa fa-circle-o"></i>Add Trip</a></li>
              @endcan
              @can('extra_cash')
                <li class="<?php if(\Route::currentRouteName() == 'extraCashList' || \Route::currentRouteName() == 'viewEditExtraCash' || \Route::currentRouteName() == 'viewAddExtraCash') echo 'active' ?>"><a href="<?php echo \URL::route('extraCashList'); ?>"><i class="fa fa-circle-o"></i>Extra Cash</a></li>
              @endcan
              @can('extra_diesel')
                <li class="<?php if(\Route::currentRouteName() == 'extraDieselList' || \Route::currentRouteName() == 'viewEditExtraDiesel' || \Route::currentRouteName() == 'viewAddExtraDiesel') echo 'active' ?>"><a href="<?php echo \URL::route('extraDieselList'); ?>"><i class="fa fa-circle-o"></i>Extra Diesel</a></li>
              @endcan
              @can('consolidated_trip')         
                <li class="<?php if(\Route::currentRouteName() == 'viewConsolidatedtripList') echo 'active' ?>"><a href="<?php echo \URL::route('viewConsolidatedtripList'); ?>"><i class="fa fa-circle-o"></i>Consolidated View</a></li>
              @endcan
              <!--@can('trip_manage_gps_view')
                <li class="<?php if(\Route::currentRouteName() == 'gpsTripList') echo 'active' ?>"><a href="<?php echo \URL::route('gpsTripList'); ?>"><i class="fa fa-circle-o"></i>GPS Tracking</a></li>
              @endcan -->
              @can('trip_manage_pdf_view')
                <li class="<?php if(\Route::currentRouteName() == 'pdfTrip') echo 'active' ?>"><a href="<?php echo \URL::route('pdfTrip'); ?>"><i class="fa fa-circle-o"></i>Download PDF</a></li>
              @endcan 
            </ul>
          </li>
        @endpermission        

        @permission('approvle_management')
          <li class="treeview <?php if(\Route::currentRouteName() == 'approvle_adv_view' || \Route::currentRouteName() == 'approvle_dsl_view' || \Route::currentRouteName() == 'misclleneous_view') echo 'active' ?>">
            <a href="#">
              <i class="fa fa-bullseye"></i> <span>Approval Management</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              @can('approvle_adv_view')
                <li class="<?php if(\Route::currentRouteName() == 'approvle_adv_view') echo 'active' ?>"><a href="<?php echo \URL::route('approvle_adv_view'); ?>"><i class="fa fa-circle-o"></i>Advance List</a></li>
              @endcan

              @can('approvle_dsl_view')
                <li class="<?php if(\Route::currentRouteName() == 'approvle_dsl_view') echo 'active' ?>"><a href="<?php echo \URL::route('approvle_dsl_view'); ?>"><i class="fa fa-circle-o"></i>Diesel List</a></li>
              @endcan
              
              @can('misclleneous_view')
                <li class="<?php if(\Route::currentRouteName() == 'misclleneous_view') echo 'active' ?>"><a href="<?php echo \URL::route('misclleneous_view'); ?>"><i class="fa fa-circle-o"></i>Miscellaneous List</a></li>
              @endcan
            </ul>
          </li>
        @endpermission

        @permission('report_management_section')
          <li class="treeview <?php if(\Route::currentRouteName() == 'customerReport' || \Route::currentRouteName() == 'vendorReport'  || \Route::currentRouteName() == 'paymentReport' || \Route::currentRouteName() == 'tripReport' || \Route::currentRouteName() == 'dieselReport' || \Route::currentRouteName() == 'cashReport' || \Route::currentRouteName() == 'ledgerReport') echo 'active' ?>">
            <a href="#">
              <i class="fa fa-files-o"></i> <span>Reports</span> 
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu <?php if(\Route::currentRouteName() == 'customerReport' || \Route::currentRouteName() == 'vendorReport' || \Route::currentRouteName() == 'paymentReport' || \Route::currentRouteName() == 'tripReport' || \Route::currentRouteName() == 'dieselReport' ||  \Route::currentRouteName() == 'cashReport' || \Route::currentRouteName() == 'ledgerReport') echo 'menu-open' ?>">
               @can('vendor_report_management')
                <li class="<?php if(\Route::currentRouteName() == 'vendorReport') echo 'active' ?>"><a href="<?php echo \URL::route('vendorReport'); ?>"><i class="fa fa-circle-o"></i>Customer Pending Report</a></li>
              @endcan
              @can('customer_report_management')
                <li class="<?php if(\Route::currentRouteName() == 'customerReport') echo 'active' ?>"><a href="<?php echo \URL::route('customerReport'); ?>"><i class="fa fa-circle-o"></i>Vendor Pending Report</a></li>
              @endcan
              @can('diesel_report_management')
                <li class="<?php if(\Route::currentRouteName() == 'dieselReport') echo 'active' ?>"><a href="<?php echo \URL::route('dieselReport'); ?>"><i class="fa fa-circle-o"></i>Diesel Report</a></li>
              @endcan
              @can('cash_report_management')
                <li class="<?php if(\Route::currentRouteName() == 'cashReport') echo 'active' ?>"><a href="<?php echo \URL::route('cashReport'); ?>"><i class="fa fa-circle-o"></i>Cash Report</a></li>
              @endcan
              @can('payment_report_management')
                <li class="<?php if(\Route::currentRouteName() == 'ledgerReport') echo 'active' ?>"><a href="<?php echo \URL::route('ledgerReport'); ?>"><i class="fa fa-circle-o"></i>Payment Report</a></li>
              @endcan
              @can('trip_report_management')
                <li class="<?php if(\Route::currentRouteName() == 'tripReport') echo 'active' ?>"><a href="<?php echo \URL::route('tripReport'); ?>"><i class="fa fa-circle-o"></i>Trip Report</a></li>
              @endcan
              <!--<li class="<?php if(\Route::currentRouteName() == 'ledgerReport') echo 'active' ?>"><a href="<?php echo \URL::route('ledgerReport'); ?>"><i class="fa fa-circle-o"></i>Ledger Report</a></li>-->
            </ul>
          </li> 
        @endpermission


        @permission('payment_module_manage')
          <li  class="treeview <?php if(\Route::currentRouteName() == 'plant_laser_view' || \Route::currentRouteName() == 'selected_plantlaser_view' || \Route::currentRouteName() == 'pay_to_plant' || \Route::currentRouteName() == 'petrolpump_laser_view' || \Route::currentRouteName() == 'selected_petrolpump_laser_view' || \Route::currentRouteName() == 'pay_to_petrolpump' || \Route::currentRouteName() == 'viewConsolidatedtripList' || \Route::currentRouteName() == 'viewAddVendorPay') echo 'active' ?>">
            <a href="#">
              <i class="fa fa-credit-card"></i> <span>Payment Module</span> 
              <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu  <?php if(\Route::currentRouteName() == 'plant_laser_view' || \Route::currentRouteName() == 'selected_plantlaser_view' || \Route::currentRouteName() == 'pay_to_plant' || \Route::currentRouteName() == 'petrolpump_laser_view' || \Route::currentRouteName() == 'selected_petrolpump_laser_view' || \Route::currentRouteName() == 'pay_to_petrolpump' || \Route::currentRouteName() == 'viewConsolidatedtripList' || \Route::currentRouteName() == 'viewAddVendorPay') echo 'menu-open' ?>">
              <!--@can('plant_laser')
                <li class="<?php if(\Route::currentRouteName() == 'plant_laser_view' || \Route::currentRouteName() == 'selected_plantlaser_view') echo 'active' ?>"><a href="<?php echo \URL::route('plant_laser_view'); ?>"><i class="fa fa-circle-o"></i>Plant Laser</a></li>
              @endcan -->
              @can('plant_payment')
                <li class="<?php if(\Route::currentRouteName() == 'pay_to_plant') echo 'active' ?>"><a href="<?php echo \URL::route('pay_to_plant'); ?>"><i class="fa fa-circle-o"></i>Add Payment in Plant</a></li>
              @endcan

              @if(\Auth::user()->user_role_id != \Config::get('constants.supervisorRoleId'))
                <!--@can('petrolpump_laser')
                  <li class="<?php if(\Route::currentRouteName() == 'petrolpump_laser_view' || \Route::currentRouteName() == 'selected_petrolpump_laser_view') echo 'active' ?>"><a href="<?php echo \URL::route('petrolpump_laser_view'); ?>"><i class="fa fa-circle-o"></i>Petrol Pump Laser </a></li>
                @endcan -->
                @can('petrolpump_payment')
                  <li class="<?php if(\Route::currentRouteName() == 'pay_to_petrolpump') echo 'active' ?>"><a href="<?php echo \URL::route('pay_to_petrolpump'); ?>"><i class="fa fa-circle-o"></i>Pay to Petrol Pump</a></li>      
                @endcan

                @can('vendor_payment')
                  <li class="<?php if(\Route::currentRouteName() == 'viewAddVendorPay') echo 'active' ?>"><a href="<?php echo \URL::route('viewAddVendorPay'); ?>"><i class="fa fa-circle-o"></i>Pay to Vendor</a></li>  
                @endcan
              @endif
              

            </ul>
          </li>
        @endpermission
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>