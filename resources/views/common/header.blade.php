@php
use \App\Helpers\Helper;
@endphp
@php 
$notification = Helper::notification();
$ins_noti = $notification['insurance_count'];
$per_noti = $notification['permit_count'];
$tax_noti = $notification['tax_count'];
$pol_noti = $notification['pollution_count'];
$reg_noti = $notification['registration_count'];
$total = $ins_noti+$per_noti+$tax_noti+$pol_noti+$reg_noti;
@endphp
 <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo \URL::route('dashboard'); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="{{asset('images/logistic_logo.png')}}"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">
              <img src="{{asset('images/logistic_logo.png')}}"> Logistics
          </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu" style="display: none;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="{{asset(\Config::get('constants.profileImagePath'))}}/{{ \Auth::user()->profile_picture }}" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              @if(\Auth::user()->user_role_id != \Config::get('constants.supervisorRoleId'))
                <li class="dropdown notifications-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning">{{$total}}</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">You have {{$total}} notifications</li>
                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                        @if($ins_noti>0)
                        <li>
                          <a href="<?php echo \URL::route('notification_insurance_view'); ?>">
                            <i class="fa fa-users text-aqua"></i> {{$ins_noti}} Insurance notification has arrived
                          </a>
                        </li>
                        @endif
                        @if($per_noti>0)
                        <li>
                          <a href="<?php echo \URL::route('notification_permit_view'); ?>">
                            <i class="fa fa-users text-aqua"></i> {{$per_noti}} Permit notification has arrived
                          </a>
                        </li>
                        @endif
                        @if($tax_noti>0)
                        <li>
                          <a href="<?php echo \URL::route('notification_tax_view'); ?>">
                            <i class="fa fa-users text-aqua"></i> {{$tax_noti}} Tax notification has arrived
                          </a>
                        </li>
                        @endif
                        @if($pol_noti>0)
                        <li>
                          <a href="<?php echo \URL::route('notification_pollution_view'); ?>">
                            <i class="fa fa-users text-aqua"></i> {{$pol_noti}} Pollution notification has arrived
                          </a>
                        </li>
                        @endif
                        @if($reg_noti>0)
                        <li>
                          <a href="<?php echo \URL::route('notification_registration_view'); ?>">
                            <i class="fa fa-users text-aqua"></i> {{$reg_noti}} Registration notification has arrived
                          </a>
                        </li>
                        @endif
                      </ul>
                    </li>
                    <!-- <li class="footer"><a href="#">View all</a></li> -->
                  </ul>
                </li>
              @endif
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu" style="display: none;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  @if(\Auth::user()->profile_picture == null)
                     <img src="{{asset(\Config::get('constants.profileImagePath'))}}/common_customer_image.jpg" class="user-image" alt="User Image"/>
                  @else
                    <img src="{{asset(\Config::get('constants.profileImagePath'))}}/{{ \Auth::user()->profile_picture }}" class="user-image" alt="User Image"/>
                  @endif
                  <span class="hidden-xs">{{ \Auth::user()->full_name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    @if(\Auth::user()->profile_picture == null)
                      <img src="{{asset(\Config::get('constants.profileImagePath'))}}/common_customer_image.jpg" class="user-image" alt="User Image"/>
                    @else
                      <img src="{{asset(\Config::get('constants.profileImagePath'))}}/{{ \Auth::user()->profile_picture }}" class="user-image" alt="User Image"/>
                    @endif
                    <p>
                      {{ \Auth::user()->full_name }}
                      <small>Member since {{ date('M,Y',strtotime(\Auth::user()->created_at)) }}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center" style="display: none;">
                      <a href="#"></a>
                    </div>
                    <div class="col-xs-12 text-center" >
                      <a href="<?php echo \URL::route('viewChangePassword'); ?>" class="btn_change_pass">Change Password</a>
                    </div>
                    <div class="col-xs-4 text-center" style="display: none;">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo \URL::route('viewProfile'); ?>" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    
                    <div class="pull-right"> 
                      <a ng-click="adminLogout();" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li style="display: none;">
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
 </header>

      

      