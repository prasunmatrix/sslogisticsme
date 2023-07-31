@extends('layouts.afterlogintemplate')
@section('content')

 
      <!-- Content Header (Page header) -->
      
      <section class="content-header">
        <h1>
          Add Subcategory   
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo \URL::route('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Add Subcategory</li>
        </ol>
      </section>
      <!-- Main content -->
      
  <div data-ng-controller="subcategoriesController" data-ng-init="viewCategoryList();">  
    <div class="flash-message" ng-hide="msgDisplay">
          @include('common.flash_message') 
          <span ng-view='danger' ng-cloak ng-bind='danger' class="alert alert-danger" ng-show="danger"></span>
    </div>
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add Subcategory</h3>
          
        </div>
        <div class="box-body">
          <form ng-submit="saveSubcategory();" id="subcategoryForm" name="subcategoryForm">
             {{csrf_field()}}

            <div class="form-group has-feedback">
              <select ng-model="selectCategory" name="selectCategory" ng-options="record.id as record.category_name for record in records" class="form-control" required>
                <option value="" selected="selected">Select Category</option>
              </select>
               <span class="invalidInputErrorClass" ng-show="subcategoryForm.selectCategory.$touched && subcategoryForm.selectCategory.$error.required">Please select the Category</span>
            </div>
            
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Item Name" name="subcategoryName" ng-model="subcategoryName" ng-maxlength="255" required/>
              <span class="invalidInputErrorClass" ng-cloak ng-show="subcategoryForm.subcategoryName.$touched && subcategoryForm.subcategoryName.$error.required">The Subcategory Name is required.</span>
            </div>

            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Item Description" name="subcategoryDesc" ng-model="subcategoryDesc" ng-maxlength="255"/>
              <span class="invalidInputErrorClass" ng-cloak ng-show="subcategoryForm.subcategoryDesc.$touched && subcategoryForm.subcategoryDesc.$error.required">The Subcategory Description is required.</span>
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
               <a class="btn btn-default btn-flat" href=<?php echo url(''); ?>/subcategories>Back</a>
                <button type="submit" ng-disabled="subcategoryForm.$invalid" class="btn btn-primary">Submit</button>
              </div><!-- /.col -->
            </div>
          </form> 
        </div><!-- /.box-body -->
        <div class="box-footer">
           
        </div><!-- /.box-footer-->
      </div><!-- /.box -->

    </section><!-- /.content -->

      <!-- /.content -->
  </div>
@endsection



@section('scripts')
  <script src="{{ asset('/angularJs/angularModules/subcategories/subcategoryApp.js') }}"></script>
@endsection

