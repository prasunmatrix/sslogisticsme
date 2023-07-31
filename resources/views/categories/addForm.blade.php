@extends('layouts.afterlogintemplate')
@section('content')


      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Add Category   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Add Category</li>
        </ol>
      </section>
      <!-- Main content -->
      
    <div data-ng-controller="categoriesController">  
      
      <section class="content">
        <!-- Default box -->
        <div class="box">
         <div class="flash-message" ng-hide="msgDisplay">
            @include('common.flash_message') 
            <span ng-view='danger' ng-cloak ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
         </div>
          
          <div class="box-header with-border">
            <h3 class="box-title">Add Category</h3>
            
          </div>
          <div class="box-body">
            <form ng-submit="saveCategory();" id="categoryForm" name="categoryForm">
               {{csrf_field()}}
              
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Category Name" name="categoryName" ng-model="categoryName" ng-maxlength="255" required/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="categoryForm.categoryName.$touched && categoryForm.categoryName.$error.required">The Category Name is required.</span>
              </div>

              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Category Description" name="categoryDesc" ng-model="categoryDesc" ng-maxlength="255"/>
                <span class="invalidInputErrorClass" ng-cloak ng-show="categoryForm.categoryDesc.$touched && categoryForm.categoryDesc.$error.required">The Category Description is required.</span>
              </div>

              <div class="form-group has-feedback">
              
              <div class="active_checkbox">
                <label>Active:- </label>
                <input type="checkbox" name="status" ng-model="status" ng-checked="status == '1'" ng-true-value="'A'" ng-false-value="'I'" >
              </div>
              
              </div>

            


              <div class="row submit-button-holder">
                <div class="col-xs-8">    
                                        
                </div><!-- /.col -->
                <div class="col-xs-4">
                 <a class="btn btn-default btn-flat" href=<?php echo url(''); ?>/categories>Back</a>
                  <button type="submit" ng-disabled="categoryForm.$invalid" class="btn btn-primary">Submit</button>
                </div><!-- /.col -->
              </div>
            </form> 
          </div><!-- /.box-body -->
          <div class="box-footer">
             
          </div><!-- /.box-footer-->
        </div><!-- /.box -->

      </section><!-- /.content -->
    </div>

      <!-- /.content -->

@endsection



@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/categories/categoryApp.js') }}"></script>
@endsection

