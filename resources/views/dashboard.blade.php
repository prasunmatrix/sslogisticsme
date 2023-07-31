@extends('layouts.afterlogintemplate')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard page
        <small>it all starts here</small> 
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Dashboard</li>
        <li class="active">Dashboard page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box" data-ng-controller="dashboardsController" data-ng-init="dashboardList();">

        <div class="box-body">
          <div class="row">
              <h2 class="dashboardPageHeading">Basic Information</h2>


              <?php //if (\Auth::user()->user_role_id != \Config::get('constants.supervisorRoleId'))   { ?>
                <a href=<?php echo url(''); ?>/user/user-list>
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-maroon">
                      <div class="inner">
                        <h3>@{{records.superVisorCount}}</h3>
                        <p>Supervisor</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-man"></i>
                      </div>
                      
                    </div>
                  </div><!-- ./col -->
                </a>
                
                <a href=<?php echo url(''); ?>/user/user-list>
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                      <div class="inner">
                        <h3>@{{records.accountantCount}}</h3>
                        <p>Accountant</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-suitcase"></i>
                      </div>
                      
                    </div>
                  </div><!-- ./col -->
                </a>

                
              <?php //} ?>
              <a href=<?php echo url(''); ?>/vendors>
                  <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-orange">
                      <div class="inner">
                        <h3>@{{records.vendorCount}}</h3>
                        <p>Vendor</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-university"></i>
                      </div>
                      
                    </div>
                  </div><!-- ./col -->
                </a>
              <a href=<?php echo url(''); ?>/trucks>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-blue">
                    <div class="inner">
                      <h3>@{{records.truckCount}}</h3>
                      <p>Truck</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-truck"></i>
                    </div>
                    
                  </div>
                </div><!-- ./col -->
              </a>
              
              <a href=<?php echo url(''); ?>/plants>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-purple">
                    <div class="inner">
                      <h3>@{{records.plantCount}}</h3>
                      <p>Plant</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-building"></i>
                    </div>
                    
                  </div>
                </div><!-- ./col -->
              </a>
              
              <a href=<?php echo url(''); ?>/petrolPumps>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>@{{records.pumpCount}}</h3>
                      <p>Petrol Pump</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-tint"></i>
                    </div>
                    
                  </div>
                </div><!-- ./col -->
              </a>
              
              <a href=<?php echo url(''); ?>/parties>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red-active">
                    <div class="inner">
                      <h3>@{{records.partyCount}}</h3>
                      <p>Party</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-crosshairs"></i>
                    </div>
                    
                  </div>
                </div><!-- ./col -->
              </a>
              
              
          </div>
        </div><!-- /.box-body -->

        <div class="box-body">
          <div class="row">
              <h2 class="dashboardPageHeading">Trip Information</h2>

              <a href=<?php echo url(''); ?>/trips>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-teal">
                    <div class="inner">
                      <h3>@{{records.awaitingTripCount}}</h3>
                      <p>Awaiting Trip</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    
                  </div>
                </div><!-- ./col -->
              </a>
              
              <a href=<?php echo url(''); ?>/trips>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-teal">
                    <div class="inner">
                      <h3>@{{records.runningTripCount}}</h3>
                      <p>Running Trip</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-plane"></i>
                    </div>
                    
                  </div>
                </div><!-- ./col -->
              </a>

              <a href=<?php echo url(''); ?>/trips>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-teal">
                    <div class="inner">
                      <h3>@{{records.settledTripCount}}</h3>
                      <p>Settled Trip</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-check-circle"></i>
                    </div>
                    
                  </div>
                </div><!-- ./col -->
              </a>

              <a href=<?php echo url(''); ?>/trips>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-teal">
                    <div class="inner">
                      <h3>@{{records.completedTripCount}}</h3>
                      <p>Completed Trip</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-arrows-alt"></i>
                    </div>
                    
                  </div>
                </div><!-- ./col -->
              </a>
          </div>
        </div><!-- /.box-body -->

        <div class="box-body">
          <div class="row">
              <h2 class="dashboardPageHeading">Approval Request Information</h2>

              <a href=<?php echo url(''); ?>/approvle-adv-view>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-orange">
                    <div class="inner">
                      <h3>@{{records.pendingAdvRequest}}</h3>
                      <p>Advance Request</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-inr"></i>
                    </div>
                    
                  </div>
                </div><!-- ./col -->
              </a>
              
              <a href=<?php echo url(''); ?>/approvle-dsl-view>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-orange">
                    <div class="inner">
                      <h3>@{{records.pendingDslRequest}}</h3>
                      <p>Diesel Request</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-tint"></i>
                    </div>
                    
                  </div>
                </div><!-- ./col -->
              </a>

              <a href=<?php echo url(''); ?>/misclleneous-view>
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-orange">
                    <div class="inner">
                      <h3>@{{records.pendingMiscRequest}}</h3>
                      <p>Miscellaneous Request</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-cog"></i>
                    </div>
                    
                  </div>
                </div><!-- ./col -->
              </a>
          </div>
        </div><!-- /.box-body -->

      </div><!-- /.box -->
    </section><!-- /.content -->
@endsection

@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/dashboards/dashboardsApp.js') }}"></script>
@endsection 

    