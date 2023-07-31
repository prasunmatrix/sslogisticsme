<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



//============================= Without Auth Section =================================

/*signin signup section*/
Route::get('/', ['as'=>'login', 'uses'=>'UserController@login'])->middleware('cors');
Route::any('/do-login', ['as'=>'doLogin', 'uses'=>'UserController@doLogin'])->middleware('cors');
Route::any('/do-logout', ['as'=>'doLogout', 'uses'=>'UserController@doLogout']);

/*forgot password*/
Route::any('/view-forgot-password', ['as'=>'viewForgotPassword', 'uses'=>'UserController@viewForgotPassword'])->middleware('cors');
Route::any('/forgot-password', ['as'=>'forgotPassword', 'uses'=>'UserController@forgotPassword'])->middleware('cors');


/*reset password*/
Route::any('/view-reset-password', ['as'=>'viewResetPassword', 'uses'=>'UserController@viewResetPassword'])->middleware('cors');
Route::any('/reset-password', ['as'=>'resetPassword', 'uses'=>'UserController@resetPassword'])->middleware('cors');
Route::any('/get-reset-password-data', ['as'=>'getResetPasswordData', 'uses'=>'UserController@getResetPasswordData'])->middleware('cors');

//============================= Without Auth Section =================================




//==================================== Auth Section =========================================

Route::group(['middleware' => ['auth','cors']] , function(){ 
	
	/*clear cache*/
	Route::get('/clear-cache', function() { $exitCode = Artisan::call('cache:clear');  return 1; });


	/*dashboard section*/
	Route::get('/dashboard', ['as'=>'dashboard', 'uses'=>'DashboardController@index']);
	Route::any('/dashboard-list', ['as'=>'dashboardList', 'uses'=>'DashboardController@dashboardList']);


	/*profile section*/
	Route::any('/view-profile', ['as'=>'viewProfile', 'uses'=>'UserController@viewProfile']);
	Route::any('/save-profile', ['as'=>'saveProfile', 'uses'=>'UserController@saveProfile']);
	Route::any('/get-profile-data', ['as'=>'getProfileData', 'uses'=>'UserController@getProfileData']);
	Route::any('upload-profile-image', ['as'=>'uploadProfileImage', 'uses'=>'UserController@uploadProfileImage']);			


	/*change password*/
	Route::any('/view-change-password', ['as'=>'viewChangePassword', 'uses'=>'UserController@viewChangePassword']);
	Route::any('/change-password', ['as'=>'changePassword', 'uses'=>'UserController@changePassword']);


	/*countries*/
	/*Route::get('/countries', ['as'=>'countries', 'middleware' => 'permission:country_view', 'uses'=>'CountryController@index']);
	Route::any('/get-country-list', ['as'=>'getCountryList', 'middleware' => 'permission:country_view', 'uses'=>'CountryController@getCountryList']);*/


	/*states*/
	/*Route::get('/states', ['as'=>'states', 'middleware' => 'permission:state_view', 'uses'=>'StateController@index']);
	Route::any('/get-state-list', ['as'=>'getStateList', 'middleware' => 'permission:state_view', 'uses'=>'StateController@getStateList']);
	Route::any('/view-country-list', ['as'=>'viewCountryList', 'middleware' => 'permission:country_view', 'uses'=>'StateController@viewCountryList']);
	Route::any('/view-state-add-form', ['as'=>'viewAddState', 'middleware' => 'permission:state_add', 'uses'=>'StateController@viewAddState']);
	Route::any('/save-state', ['as'=>'saveState', 'uses'=>'StateController@saveState']);
	Route::any('view-state-edit-form/{id}', ['as'=>'viewEditState', 'middleware' => 'permission:state_edit', 'uses'=>'StateController@viewEditState']);
	Route::any('get-edit-state', ['as'=>'getEditState', 'middleware' => 'permission:state_edit', 'uses'=>'StateController@getEditState']);
	Route::any('delete-state', ['as'=>'deleteState', 'middleware' => 'permission:state_delete', 'uses'=>'StateController@deleteState']);*/



	/*cities*/
	/*Route::get('/cities', ['as'=>'cities', 'middleware' => 'permission:city_view', 'uses'=>'CityController@index']);
	Route::any('/get-city-list', ['as'=>'getCityList', 'middleware' => 'permission:city_view', 'uses'=>'CityController@getCityList']);
	Route::any('/view-state-list', ['as'=>'viewStateList', 'middleware' => 'permission:state_view', 'uses'=>'CityController@viewStateList']);
	Route::any('/view-city-add-form', ['as'=>'viewAddCity', 'middleware' => 'permission:city_add', 'uses'=>'CityController@viewAddCity']);
	Route::any('/save-city', ['as'=>'saveCity', 'uses'=>'CityController@saveCity']);
	Route::any('view-city-edit-form/{id}', ['as'=>'viewEditCity', 'middleware' => 'permission:city_edit', 'uses'=>'CityController@viewEditCity']);
	Route::any('get-edit-city', ['as'=>'getEditCity', 'middleware' => 'permission:city_edit', 'uses'=>'CityController@getEditCity']);
	Route::any('delete-city', ['as'=>'deleteCity', 'middleware' => 'permission:city_delete', 'uses'=>'CityController@deleteCity']);*/



	/*categories*/
	Route::get('/categories', ['as'=>'categories', 'middleware' => 'permission:category_view', 'uses'=>'CategoryController@index']);
	Route::any('/get-category-list', ['as'=>'getCategoryList', 'middleware' => 'permission:category_view', 'uses'=>'CategoryController@getCategoryList']);
	Route::any('/view-category-add-form', ['as'=>'viewAddCategory', 'middleware' => 'permission:category_add', 'uses'=>'CategoryController@viewAddCategory']);
	Route::any('/save-category', ['as'=>'saveCategory', 'uses'=>'CategoryController@saveCategory']);
	Route::any('view-category-edit-form/{id}/{currentPage}', ['as'=>'viewEditCategory', 'middleware' => 'permission:category_edit', 'uses'=>'CategoryController@viewEditCategory']);
	Route::any('get-edit-category', ['as'=>'getEditCategory', 'middleware' => 'permission:category_edit', 'uses'=>'CategoryController@getEditCategory']);
	Route::any('delete-category', ['as'=>'deleteCategory', 'middleware' => 'permission:category_delete', 'uses'=>'CategoryController@deleteCategory']);
	


	/*subcategories*/
	Route::get('/subcategories', ['as'=>'subcategories', 'middleware' => 'permission:sub_category_view', 'uses'=>'SubcategoryController@index']);
	Route::any('/get-subcategory-list', ['as'=>'getSubcategoryList', 'middleware' => 'permission:sub_category_view', 'uses'=>'SubcategoryController@getSubcategoryList']);
	Route::any('/view-category-list', ['as'=>'viewCategoryList', 'middleware' => 'permission:category_view', 'uses'=>'SubcategoryController@viewCategoryList']);
	Route::any('/view-subcategory-add-form', ['as'=>'viewAddSubcategory', 'middleware' => 'permission:sub_category_add','uses'=>'SubcategoryController@viewAddSubcategory']);
	Route::any('/save-subcategory', ['as'=>'saveSubcategory', 'uses'=>'SubcategoryController@saveSubcategory']);
	Route::any('view-subcategory-edit-form/{id}/{currentPage}', ['as'=>'viewEditSubcategory', 'middleware' => 'permission:sub_category_edit', 'uses'=>'SubcategoryController@viewEditSubcategory']);
	Route::any('get-edit-subcategory', ['as'=>'getEditSubcategory', 'middleware' => 'permission:sub_category_edit', 'uses'=>'SubcategoryController@getEditSubcategory']);
	Route::any('delete-subcategory', ['as'=>'deleteSubcategory', 'middleware' => 'permission:sub_category_delete', 'uses'=>'SubcategoryController@deleteSubcategory']);
	Route::any('save-csv-subcategory', ['as'=>'saveCSVSubcategory', 'middleware' => 'permission:sub_category_add', 'uses'=>'SubcategoryController@saveCSVSubcategory']);
	Route::any('view-subcategory-list', ['as'=>'viewTripSubcatList', 'middleware' => 'permission:sub_category_view', 'uses'=>'SubcategoryController@viewTripSubcatList']);





	/*plants*/
	Route::get('/plants', ['as'=>'plants', 'middleware' => 'permission:plant_manage_view', 'uses'=>'PlantController@index']);
	Route::any('/get-plant-list', ['as'=>'getPlantList', 'middleware' => 'permission:plant_manage_view', 'uses'=>'PlantController@getPlantList']);
	Route::any('/view-plant-add-form', ['as'=>'viewAddPlant', 'middleware' => 'permission:plant_manage_add', 'uses'=>'PlantController@viewAddPlant']);
	Route::any('/save-plant', ['as'=>'savePlant', 'uses'=>'PlantController@savePlant']);
	Route::any('view-plant-edit-form/{id}/{currentPage}', ['as'=>'viewEditPlant', 'middleware' => 'permission:plant_manage_edit','uses'=>'PlantController@viewEditPlant']);
	Route::any('get-edit-plant', ['as'=>'getEditPlant', 'middleware' => 'permission:plant_manage_edit', 'uses'=>'PlantController@getEditPlant']);
	Route::any('delete-plant', ['as'=>'deletePlant', 'middleware' => 'permission:plant_manage_delete', 'uses'=>'PlantController@deletePlant']);
	Route::any('view-supervisor-list', ['as'=>'viewSupervisorList', 'middleware' => 'permission:plant_manage_add', 'uses'=>'PlantController@viewSupervisorList']);
	Route::any('save-csv-plant', ['as'=>'saveCSVPlant', 'middleware' => 'permission:plant_manage_add', 'uses'=>'PlantController@saveCSVPlant']);
	Route::any('view-plantList-having-plantAddress', ['as'=>'viewPlantListHavingPlantAddress', 'middleware' => 'permission:plant_manage_view', 'uses'=>'PlantController@viewPlantListHavingPlantAddress']);
	Route::any('view-trip-plantList', ['as'=>'viewTripPlantList', 'middleware' => 'permission:trip_manage_add', 'uses'=>'PlantController@viewTripPlantList']);
	Route::get('plant-view/{id}/{currentPage}', ['as'=>'plantView', 'middleware' => 'permission:plant_manage_view', 'uses'=>'PlantController@viewRecord']);
	Route::any('get-plant-details', ['as'=>'getPlantDetails', 'middleware' => 'permission:plant_manage_view', 'uses'=>'PlantController@getPlantDetails']);
	Route::any('get-user-plant', ['as'=>'getUserPlant', 'middleware' => 'permission:plant_manage_view', 'uses'=>'PlantController@getUserPlant']);
	Route::any('get-active-plant-list', ['as'=>'activePlantList', 'middleware' => 'permission:plant_manage_view', 'uses'=>'PlantController@activePlantList']);

	
	

	/*plant addresses*/
	/*Route::get('/plantAddresses', ['as'=>'plantAddresses', 'middleware' => 'permission:Plant_manage_address_view', 'uses'=>'PlantAddressController@index']);
	Route::any('/get-plantAddress-list', ['as'=>'getPlantAddressList', 'middleware' => 'permission:Plant_manage_address_view', 'uses'=>'PlantAddressController@getPlantAddressList']);
	Route::any('/view-plantAddress-add-form', ['as'=>'viewAddPlantAddress','middleware' => 'permission:plant_manage_address_add', 'uses'=>'PlantAddressController@viewAddPlantAddress']);
	Route::any('/save-plantAddress', ['as'=>'savePlantAddress', 'uses'=>'PlantAddressController@savePlantAddress']);
	Route::any('view-plantAddress-edit-form/{id}', ['as'=>'viewEditPlantAddress', 'middleware' => 'permission:plant_manage_address_edit', 'uses'=>'PlantAddressController@viewEditPlantAddress']);
	Route::any('get-edit-plantAddress', ['as'=>'getEditPlantAddress', 'middleware' => 'permission:plant_manage_address_edit','uses'=>'PlantAddressController@getEditPlantAddress']);
	Route::any('delete-plantAddress', ['as'=>'deletePlantAddress', 'middleware' => 'permission:plant_manage_address_delete', 'uses'=>'PlantAddressController@deletePlantAddress']);
	Route::any('/view-plant-list', ['as'=>'viewPlantList', 'middleware' => 'permission:plant_manage_view', 'uses'=>'PlantAddressController@viewPlantList']);
	Route::any('/save-csv-plantAddress', ['as'=>'saveCSVPlantAddress', 'middleware' => 'permission:plant_manage_address_add', 'uses'=>'PlantAddressController@saveCSVPlantAddress']);*/



	/*petrol pumps*/
	Route::get('/petrolPumps', ['as'=>'petrolPumps', 'middleware' => 'permission:petrol_pump_view', 'uses'=>'PetrolPumpController@index']);
	Route::any('/get-petrolPump-list', ['as'=>'getPetrolPumpList', 'middleware' => 'permission:petrol_pump_view', 'uses'=>'PetrolPumpController@getPetrolPumpList']);
	Route::any('/view-city-list', ['as'=>'viewCityList', 'middleware' => 'permission:city_view','uses'=>'PetrolPumpController@viewCityList']);
	Route::any('/view-petrolPump-add-form', ['as'=>'viewAddPetrolPump', 'middleware' => 'permission:petrol_pump_add','uses'=>'PetrolPumpController@viewAddPetrolPump']);
	Route::any('/save-petrolPump', ['as'=>'savePetrolPump', 'uses'=>'PetrolPumpController@savePetrolPump']);
	Route::any('view-petrolPump-edit-form/{id}/{currentPage}', ['as'=>'viewEditPetrolPump','middleware' => 'permission:petrol_pump_edit', 'uses'=>'PetrolPumpController@viewEditPetrolPump']);
	Route::any('get-edit-petrolPump', ['as'=>'getEditPetrolPump', 'middleware' => 'permission:petrol_pump_edit', 'uses'=>'PetrolPumpController@getEditPetrolPump']);
	Route::any('delete-petrolPump', ['as'=>'deletePetrolPump', 'middleware' => 'permission:petrol_pump_delete', 'uses'=>'PetrolPumpController@deletePetrolPump']);
	Route::any('save-csv-petrolPump', ['as'=>'saveCSVPetrolPump', 'middleware' => 'permission:petrol_pump_add', 'uses'=>'PetrolPumpController@saveCSVPetrolPump']);
	Route::any('/view-petrolpump-list', ['as'=>'viewPetrolpumpList', 'middleware' => 'permission:petrol_pump_view', 'uses'=>'PetrolPumpController@viewPetrolpumpList']);
	Route::get('petrol-pump-view/{id}/{currentPage}', ['as'=>'petrolPumpView', 'middleware' => 'permission:petrol_pump_view', 'uses'=>'PetrolPumpController@viewRecord']);
	Route::any('get-petrol-pump-details', ['as'=>'getPetrolPumpDetails', 'middleware' => 'permission:petrol_pump_view', 'uses'=>'PetrolPumpController@getPetrolPumpDetails']);



	/*trucks*/
	Route::get('/trucks', ['as'=>'trucks', 'middleware' => 'permission:truck_manage_view', 'uses'=>'TruckController@index']);
	Route::any('/get-truck-list', ['as'=>'getTruckList', 'middleware' => 'permission:truck_manage_view', 'uses'=>'TruckController@getTruckList']);
	Route::any('/view-truck-add-form', ['as'=>'viewAddTruck', 'middleware' => 'permission:truck_manage_add','uses'=>'TruckController@viewAddTruck']);
	Route::any('/save-truck', ['as'=>'saveTruck', 'uses'=>'TruckController@saveTruck']);
	Route::any('view-truck-edit-form/{id}/{currentPage}', ['as'=>'viewEditTruck', 'middleware' => 'permission:truck_manage_edit', 'uses'=>'TruckController@viewEditTruck']);
	Route::any('get-edit-truck', ['as'=>'getEditTruck', 'middleware' => 'permission:truck_manage_edit', 'uses'=>'TruckController@getEditTruck']);
	Route::any('delete-truck', ['as'=>'deleteTruck', 'middleware' => 'permission:truck_manage_delete', 'uses'=>'TruckController@deleteTruck']);
	Route::any('upload-registration-file', ['as'=>'uploadRegistrationFile', 'middleware' => 'permission:truck_manage_add', 'uses'=>'TruckController@uploadRegistrationFile']);
	Route::any('upload-insurance-file', ['as'=>'uploadInsuranceFile', 'middleware' => 'permission:truck_manage_add', 'uses'=>'TruckController@uploadInsuranceFile']);
	Route::any('upload-permit-file', ['as'=>'uploadPermitFile', 'middleware' => 'permission:truck_manage_add', 'uses'=>'TruckController@uploadPermitFile']);
	Route::any('upload-tax-file', ['as'=>'uploadTaxFile', 'middleware' => 'permission:truck_manage_add','uses'=>'TruckController@uploadTaxFile']);
	Route::any('upload-pollution-file', ['as'=>'uploadPollutionFile', 'middleware' => 'permission:truck_manage_add','uses'=>'TruckController@uploadPollutionFile']);
	Route::get('truck-view/{id}/{currentPage}', ['as'=>'truckView', 'middleware' => 'permission:truck_manage_view', 'uses'=>'TruckController@viewRecord']);
	Route::any('get-truck-details', ['as'=>'getTruckDetails', 'middleware' => 'permission:truck_manage_view', 'uses'=>'TruckController@getTruckDetails']);
	Route::any('/view-truck-list', ['as'=>'viewTruckList', 'middleware' => 'permission:truck_manage_view', 'uses'=>'TruckController@viewTruckList']);
	Route::any('/gps-truck-list', ['as'=>'gpsTruckList', 'middleware' => 'permission:truck_manage_gps_view', 'uses'=>'TruckController@gpsTruckList']);
	Route::any('/view-gps-truck-list', ['as'=>'viewGPSTruckList', 'middleware' => 'permission:truck_manage_gps_view', 'uses'=>'TruckController@viewGPSTruckList']);
	Route::any('/get-all-vendor-list', ['as'=>'getAllVendorList', 'middleware' => 'permission:vendor_view', 'uses'=>'TruckController@getAllVendorList']);
	Route::any('/view-trip-truck-list', ['as'=>'viewTripTruckList', 'middleware' => 'permission:truck_manage_view', 'uses'=>'TruckController@viewTripTruckList']);
	Route::any('/view-edit-trip-truck-list', ['as'=>'getEditTripTruckList', 'middleware' => 'permission:truck_manage_view', 'uses'=>'TruckController@getEditTripTruckList']);
	Route::any('/plant-wise-truck-list', ['as'=>'getPlantWiseActiveTruckList', 'middleware' => 'permission:truck_manage_view', 'uses'=>'TruckController@getPlantWiseActiveTruckList']);
	Route::any('/view-cash-truck-list', ['as'=>'viewCashTruckList', 'middleware' => 'permission:truck_manage_view', 'uses'=>'TruckController@viewCashTruckList']);
	Route::any('/view-edit-truck-list', ['as'=>'getEditTruckList', 'middleware' => 'permission:truck_manage_view', 'uses'=>'TruckController@getEditTruckList']);




	/*parties*/
	Route::get('/parties', ['as'=>'parties',  'middleware' => 'permission:party_manage_view', 'uses'=>'PartyController@index']);
	Route::any('/get-party-list', ['as'=>'getPartyList', 'middleware' => 'permission:party_manage_view', 'uses'=>'PartyController@getPartyList']);
	Route::any('/view-party-list', ['as'=>'viewPartyList', 'middleware' => 'permission:party_manage_view', 'uses'=>'PartyController@viewPartyList']);
	Route::any('/view-party-add-form', ['as'=>'viewAddParty', 'middleware' => 'permission:party_manage_add', 'uses'=>'PartyController@viewAddParty']);
	Route::any('/save-party', ['as'=>'saveParty', 'uses'=>'PartyController@saveParty']);
	Route::any('view-party-edit-form/{id}/{currentPage}', ['as'=>'viewEditParty', 'middleware' => 'permission:party_manage_edit', 'uses'=>'PartyController@viewEditParty']);
	Route::any('get-edit-party', ['as'=>'getEditParty', 'middleware' => 'permission:party_manage_edit', 'uses'=>'PartyController@getEditParty']);
	Route::any('delete-party', ['as'=>'deleteParty', 'middleware' => 'permission:party_manage_delete','uses'=>'PartyController@deleteParty']);
	Route::any('save-csv-party', ['as'=>'saveCSVParty', 'middleware' => 'permission:party_manage_add', 'uses'=>'PartyController@saveCSVParty']);
	Route::any('view-partyList-having-partyDestination', ['as'=>'viewPartyListHavingPartyDestination', 'middleware' => 'permission:party_manage_view', 'uses'=>'PartyController@viewPartyListHavingPartyDestination']);
	Route::any('view-trip-partyList', ['as'=>'viewTripPartyList','middleware' => 'permission:trip_manage_add', 'uses'=>'PartyController@viewTripPartyList']);
	Route::get('party-view/{id}/{currentPage}', ['as'=>'partyView', 'middleware' => 'permission:party_manage_view', 'uses'=>'PartyController@viewRecord']);
	Route::any('get-party-details', ['as'=>'getPartyDetails', 'middleware' => 'permission:party_manage_view', 'uses'=>'PartyController@getPartyDetails']);
	Route::any('get-addresswise-party-listing', ['as'=>'getAddressWisePartyDetails', 'middleware' => 'permission:party_manage_view', 'uses'=>'PartyController@getAddressWisePartyDetails']);
	Route::any('get-trip-party-address', ['as'=>'viewTripPartyAddressZone', 'middleware' => 'permission:address_zone_view', 'uses'=>'PartyController@viewTripPartyAddressZone']);





	/*party destinations*/
	/*Route::get('/partyDestinations', ['as'=>'partyDestinations', 'middleware' => 'permission:party_manage_distination_view', 'uses'=>'PartyDestinationController@index']);
	Route::any('/get-partyDestination-list', ['as'=>'getPartyDestinationList', 'middleware' => 'permission:party_manage_distination_view', 'uses'=>'PartyDestinationController@getPartyDestinationList']);
	Route::any('/view-partyDestination-add-form', ['as'=>'viewAddPartyDestination', 'middleware' => 'permission:party_manage_distination_add', 'uses'=>'PartyDestinationController@viewAddPartyDestination']);
	Route::any('/save-partyDestination', ['as'=>'savePartyDestination', 'uses'=>'PartyDestinationController@savePartyDestination']);
	Route::any('view-partyDestination-edit-form/{id}', ['as'=>'viewEditPartyDestination', 'middleware' => 'permission:party_manage_distination_edit', 'uses'=>'PartyDestinationController@viewEditPartyDestination']);
	Route::any('get-edit-partyDestination', ['as'=>'getEditPartyDestination', 'middleware' => 'permission:party_manage_distination_edit', 'uses'=>'PartyDestinationController@getEditPartyDestination']);
	Route::any('delete-partyDestination', ['as'=>'deletePartyDestination', 'middleware' => 'permission:party_manage_distination_delete', 'uses'=>'PartyDestinationController@deletePartyDestination']);
	Route::any('save-csv-partyDestination', ['as'=>'saveCSVPartyDestination', 'middleware' => 'permission:party_manage_distination_add', 'uses'=>'PartyDestinationController@saveCSVPartyDestination']);*/




	/*truck insurances*/
	Route::get('/truckInsurances', ['as'=>'truckInsurances', 'uses'=>'TruckInsuranceController@index']);
	Route::any('/get-truckInsurance-list', ['as'=>'getTruckInsuranceList', 'uses'=>'TruckInsuranceController@getTruckInsuranceList']);
	Route::any('/view-truckInsurance-add-form', ['as'=>'viewAddTruckInsurance', 'uses'=>'TruckInsuranceController@viewAddTruckInsurance']);
	Route::any('/save-truckInsurance', ['as'=>'saveTruckInsurance', 'uses'=>'TruckInsuranceController@saveTruckInsurance']);
	Route::any('view-truckInsurance-edit-form/{id}', ['as'=>'viewEditTruckInsurance', 'uses'=>'TruckInsuranceController@viewEditTruckInsurance']);
	Route::any('get-edit-truckInsurance', ['as'=>'getEditTruckInsurance', 'uses'=>'TruckInsuranceController@getEditTruckInsurance']);
	Route::any('delete-truckInsurance', ['as'=>'deleteTruckInsurance', 'uses'=>'TruckInsuranceController@deleteTruckInsurance']);



	/*trips*/
	Route::get('/trips', ['as'=>'trips', 'middleware' => 'permission:trip_manage_view', 'uses'=>'TripController@index']);
	Route::any('/get-trip-list', ['as'=>'getTripList', 'middleware' => 'permission:trip_manage_view', 'uses'=>'TripController@getTripList']);
	Route::get('trip-view/{id}/{currentPage}', ['as'=>'tripView', 'middleware' => 'permission:trip_manage_view', 'uses'=>'TripController@viewRecord']);
	Route::any('get-trip-details', ['as'=>'getTripDetails', 'middleware' => 'permission:trip_manage_view', 'uses'=>'TripController@getTripDetails']);
	Route::any('/view-trip-add-form', ['as'=>'viewAddTrip', 'middleware' => 'permission:trip_manage_add', 'uses'=>'TripController@viewAddTrip']);
	Route::any('/save-trip', ['as'=>'saveTrip', 'uses'=>'TripController@saveTrip']);
	Route::any('view-trip-edit-form/{id}/{currentPage}', ['as'=>'viewEditTrip', 'middleware' => 'permission:trip_manage_edit', 'uses'=>'TripController@viewEditTrip']);
	Route::any('get-edit-trip', ['as'=>'getEditTrip', 'middleware' => 'permission:trip_manage_edit', 'uses'=>'TripController@getEditTrip']);
	Route::any('/view-truckowner', ['as'=>'getTruckOwner', 'uses'=>'TripController@getTruckOwner']);
	Route::any('upload-pod-file', ['as'=>'uploadPODFile', 'middleware' => 'permission:trip_manage_add','uses'=>'TripController@uploadPODFile']);
	Route::any('save-pod-file', ['as'=>'savePOD', 'middleware' => 'permission:trip_manage_upload_pdo','uses'=>'TripController@savePOD']);
	Route::any('ADV-edit-request', ['as'=>'ADVEditRequest', 'middleware' => 'permission:trip_manage_edit','uses'=>'TripController@ADVEditRequest']);
	Route::any('DSL-edit-request', ['as'=>'DSLEditRequest', 'middleware' => 'permission:trip_manage_edit','uses'=>'TripController@DSLEditRequest']);
	Route::any('close-trip', ['as'=>'closeTrip', 'middleware' => 'permission:trip_manage_edit','uses'=>'TripController@closeTrip']);
	Route::any('pdf-trip', ['as'=>'pdfTrip', 'middleware' => 'permission:trip_manage_pdf_view','uses'=>'TripController@pdfTrip']);
	Route::any('view-pdf-trip', ['as'=>'viewPDFTrip', 'middleware' => 'permission:trip_manage_pdf_view','uses'=>'TripController@viewPDFTrip']);
	Route::any('get-plant-trip-list', ['as'=>'getPlantWiseTripList', 'middleware' => 'permission:trip_manage_pdf_view','uses'=>'TripController@getPlantWiseTripList']);
	Route::any('view-selected-subcategory-details', ['as'=>'viewSelectedSubCatDetails', 'middleware' => 'permission:sub_category_view','uses'=>'TripController@viewSelectedSubCatDetails']);
	Route::any('save-plant-edit-request', ['as'=>'savePlantEditRequest', 'middleware' => 'permission:trip_manage_edit','uses'=>'TripController@savePlantEditRequest']);
	Route::any('save-petrolpump-edit-request', ['as'=>'savePetrolPumpEditRequest', 'middleware' => 'permission:trip_manage_edit','uses'=>'TripController@savePetrolPumpEditRequest']);
	Route::any('/gps-trip-list', ['as'=>'gpsTripList', 'middleware' => 'permission:trip_manage_gps_view', 'uses'=>'TripController@gpsTripList']);
	Route::any('view-gps-trip-list', ['as'=>'viewGPSTripList', 'middleware' => 'permission:trip_manage_gps_view','uses'=>'TripController@viewGPSTripList']);
	Route::any('save-trip-pod', ['as'=>'saveTripPod', 'uses'=>'TripController@saveTripPod']);
	Route::any('trip-wise-pod', ['as'=>'tripWisePOD', 'middleware' => 'permission:trip_manage_view', 'uses'=>'TripController@tripWisePOD']);
	Route::any('trip-latest-pod', ['as'=>'tripLatestPOD', 'middleware' => 'permission:trip_manage_view', 'uses'=>'TripController@tripLatestPOD']);
	Route::any('delete-POD', ['as'=>'deletePOD', 'middleware' => 'permission:trip_manage_view', 'uses'=>'TripController@deletePOD']);
	Route::any('truck-wise-trip-list', ['as'=>'getTruckWiseTripList', 'middleware' => 'permission:trip_manage_view', 'uses'=>'TripController@getTruckWiseTripList']);
	Route::any('trip-delete', ['as'=>'tripDelete', 'middleware' => 'permission:trip_manage_view', 'uses'=>'TripController@tripDelete']);



	Route::any('get-tcpdf', ['as'=>'getTcPdf', 'middleware' => 'permission:trip_manage_view', 'uses'=>'TripController@getTcPdf']);

	Route::any('downloadPDF', ['as'=>'downloadPDF', 'uses'=>'TestController@downloadPDF']);



	/*consolidated trip view*/
	Route::any('view-consolidated-trip-details', ['as'=>'viewConsolidatedtripList', 'middleware' => 'permission:consolidated_trip','uses'=>'ConsolidatedTripController@index']);
	Route::any('search-trip', ['as'=>'searchTrip', 'middleware' => 'permission:consolidated_trip','uses'=>'ConsolidatedTripController@searchTrip']);
	Route::any('save-trip-payment', ['as'=>'saveTripPayment', 'middleware' => 'permission:consolidated_trip','uses'=>'ConsolidatedTripController@saveTripPayment']);
	Route::any('generate-bill', ['as'=>'generateBill', 'middleware' => 'permission:consolidated_trip','uses'=>'ConsolidatedTripController@generateBill']);




	/*Extra Cash and Diesel*/
	Route::any('extra-cash-list', ['as'=>'extraCashList', 'middleware' => 'permission:extra_cash','uses'=>'ExtraCashDieselController@extraCashList']);
	Route::any('/get-extra-cash-list', ['as'=>'getExtraCashList', 'middleware' => 'permission:extra_cash','uses'=>'ExtraCashDieselController@getExtraCashList']);
	Route::any('/view-extra-cash-add-form', ['as'=>'viewAddExtraCash', 'middleware' => 'permission:extra_cash', 'uses'=>'ExtraCashDieselController@viewAddExtraCash']);
	Route::any('/save-extra-cash', ['as'=>'saveExtraCash', 'uses'=>'ExtraCashDieselController@saveExtraCash']);
	Route::any('view-extra-cash-edit-form/{id}/{currentPage}', ['as'=>'viewEditExtraCash', 'middleware' => 'permission:extra_cash', 'uses'=>'ExtraCashDieselController@viewEditExtraCash']);
	Route::any('get-edit-extra-cash', ['as'=>'getEditExtraCash', 'middleware' => 'permission:extra_cash', 'uses'=>'ExtraCashDieselController@getEditExtraCash']);
	Route::any('delete-extra-cash', ['as'=>'deleteExtraCash', 'middleware' => 'permission:extra_cash', 'uses'=>'ExtraCashDieselController@deleteExtraCash']);

	Route::any('extra-diesel-list', ['as'=>'extraDieselList', 'middleware' => 'permission:extra_diesel','uses'=>'ExtraCashDieselController@extraDieselList']);
	Route::any('/get-extra-diesel-list', ['as'=>'getExtraDieselList', 'middleware' => 'permission:extra_diesel','uses'=>'ExtraCashDieselController@getExtraDieselList']);
	Route::any('/view-extra-diesel-add-form', ['as'=>'viewAddExtraDiesel', 'middleware' => 'permission:extra_diesel', 'uses'=>'ExtraCashDieselController@viewAddExtraDiesel']);
	Route::any('/save-extra-diesel', ['as'=>'saveExtraDiesel', 'uses'=>'ExtraCashDieselController@saveExtraDiesel']);
	Route::any('view-extra-diesel-edit-form/{id}/{currentPage}', ['as'=>'viewEditExtraDiesel', 'middleware' => 'permission:extra_diesel', 'uses'=>'ExtraCashDieselController@viewEditExtraDiesel']);
	Route::any('get-edit-extra-diesel', ['as'=>'getEditExtraDiesel', 'middleware' => 'permission:extra_diesel', 'uses'=>'ExtraCashDieselController@getEditExtraDiesel']);
	Route::any('delete-extra-diesel', ['as'=>'deleteExtraDiesel', 'middleware' => 'permission:extra_diesel', 'uses'=>'ExtraCashDieselController@deleteExtraDiesel']);




	/*Address Zones*/
	Route::get('/addressZones', ['as'=>'addressZones', 'middleware' => 'permission:address_zone_view', 'uses'=>'AddressZoneController@index']);
	Route::any('/get-addressZone-list', ['as'=>'getAddressZoneList', 'middleware' => 'permission:address_zone_view', 'uses'=>'AddressZoneController@getAddressZoneList']);
	Route::any('/view-addressZone-add-form', ['as'=>'viewAddAddressZone', 'middleware' => 'permission:address_zone_add', 'uses'=>'AddressZoneController@viewAddAddressZone']);
	Route::any('/save-addressZone', ['as'=>'saveAddressZone', 'uses'=>'AddressZoneController@saveAddressZone']);
	Route::any('view-addressZone-edit-form/{id}/{currentPage}', ['as'=>'viewEditAddressZone', 'middleware' => 'permission:address_zone_edit', 'uses'=>'AddressZoneController@viewEditAddressZone']);
	Route::any('get-edit-addressZone', ['as'=>'getEditAddressZone', 'middleware' => 'permission:address_zone_edit', 'uses'=>'AddressZoneController@getEditAddressZone']);
	Route::any('delete-addressZone', ['as'=>'deleteAddressZone', 'middleware' => 'permission:address_zone_delete', 'uses'=>'AddressZoneController@deleteAddressZone']);
	Route::any('get-addressZone-listing', ['as'=>'getAddressZoneListing', 'middleware' => 'permission:address_zone_view', 'uses'=>'AddressZoneController@getAddressZoneListing']);
	Route::any('save-modal-address-zone', ['as'=>'saveModalAddressZone', 'uses'=>'AddressZoneController@saveModalAddressZone']);




	/*Vendors*/
	Route::get('/vendors', ['as'=>'vendors', 'middleware' => 'permission:vendor_view', 'uses'=>'VendorController@index']);
	Route::any('/get-vendor-list', ['as'=>'getVendorList', 'middleware' => 'permission:vendor_view', 'uses'=>'VendorController@getVendorList']);
	Route::get('vendor-view/{id}/{currentPage}', ['as'=>'vendorView', 'middleware' => 'permission:vendor_view', 'uses'=>'VendorController@viewRecord']);
	Route::any('get-vendor-details', ['as'=>'getVendorDetails', 'middleware' => 'permission:vendor_view', 'uses'=>'VendorController@getVendorDetails']);
	Route::any('/view-vendor-add-form', ['as'=>'viewAddVendor', 'middleware' => 'permission:vendor_add', 'uses'=>'VendorController@viewAddVendor']);
	Route::any('/save-vendor', ['as'=>'saveVendor', 'uses'=>'VendorController@saveVendor']);
	Route::any('view-vendor-edit-form/{id}/{currentPage}', ['as'=>'viewEditVendor', 'middleware' => 'permission:vendor_edit', 'uses'=>'VendorController@viewEditVendor']);
	Route::any('get-edit-vendor', ['as'=>'getEditVendor', 'middleware' => 'permission:vendor_edit', 'uses'=>'VendorController@getEditVendor']);
	Route::any('delete-vendor', ['as'=>'deleteVendor', 'middleware' => 'permission:vendor_delete', 'uses'=>'VendorController@deleteVendor']);
	Route::any('check-vendor-details', ['as'=>'checkVendorDetails', 'middleware' => 'permission:vendor_view', 'uses'=>'VendorController@checkVendorDetails']);
	Route::any('check-vendor-name-details', ['as'=>'checkVendorNameDetails', 'middleware' => 'permission:vendor_view', 'uses'=>'VendorController@checkVendorNameDetails']);
	Route::any('get-trip-vendor-list', ['as'=>'viewVendorList', 'middleware' => 'permission:vendor_view', 'uses'=>'VendorController@viewVendorList']);
	Route::any('get-active-bank-list', ['as'=>'getActiveBankList', 'middleware' => 'permission:vendor_view', 'uses'=>'VendorController@getActiveBankList']);
	Route::any('get-ifsc-list', ['as'=>'getIFSCList', 'middleware' => 'permission:vendor_view', 'uses'=>'VendorController@getIFSCList']);
	


   /*Reports*/
   Route::any('trip-report', ['as'=>'tripReport', 'middleware' => 'permission:trip_report_management', 'uses'=>'TripController@tripReport']);
   Route::any('get-trip-report', ['as'=>'getTripReport', 'middleware' => 'permission:trip_report_management', 'uses'=>'TripController@getTripReport']);
   Route::any('vendor-report', ['as'=>'customerReport', 'middleware' => 'permission:customer_report_management', 'uses'=>'VendorController@customerReport']);
   Route::any('get-vendor-report', ['as'=>'getCustomerReport', 'middleware' => 'permission:customer_report_management', 'uses'=>'VendorController@getCustomerReport']);
   Route::any('plant-trip-report', ['as'=>'vendorReport', 'middleware' => 'permission:vendor_report_management', 'uses'=>'VendorController@vendorReport']);
   Route::any('get-plant-trip-report', ['as'=>'getVendorReport', 'middleware' => 'permission:vendor_report_management', 'uses'=>'VendorController@getVendorReport']);
   Route::any('payment-report', ['as'=>'paymentReport', 'middleware' => 'permission:payment_report_management', 'uses'=>'TripController@paymentReport']);
   Route::any(' get-payment-report', ['as'=>'getPaymentReport', 'middleware' => 'permission:payment_report_management', 'uses'=>'TripController@getPaymentReport']);
   Route::any('cash-report', ['as'=>'cashReport', 'middleware' => 'permission:cash_report_management', 'uses'=>'PlantController@cashReport']);
   Route::any('get-cash-report', ['as'=>'getCashReport', 'middleware' => 'permission:cash_report_management', 'uses'=>'PlantController@getCashReport']);
   Route::any('diesel-report', ['as'=>'dieselReport', 'middleware' => 'permission:diesel_report_management', 'uses'=>'PetrolPumpController@dieselReport']);
   Route::any('get-diesel-report', ['as'=>'getDieselReport', 'middleware' => 'permission:diesel_report_management', 'uses'=>'PetrolPumpController@getDieselReport']);
   Route::any('ledger-report', ['as'=>'ledgerReport',  'uses'=>'TripController@ledgerReport']);
   Route::any('get-ledger-report', ['as'=>'getLedgerReport', 'uses'=>'TripController@getLedgerReport']);
   Route::any('get-bill-details',  ['as'=>'getBillDetails', 'uses'=>'TripController@getBillDetails']);


	/***********************User Management System**********************************/
	Route::prefix('user')->group(function () {
	    
	    Route::post('add-user-information','UserController@addUser')
	    		->name('user.add')
	    		->middleware('permission:user_manage_add');

	    Route::get('add-user/{user_id?}/{page?}','UserController@user')
	    		->name('user.create')
	    		->middleware('permission:user_manage_edit');

	    Route::get('user-list','UserController@userList')
	    		->name('user.list')
	    		->middleware('permission:user_manage_view');

	    Route::get('remove-user/{user_id}','UserController@removeUser')
	    		->name('user.remove')
	    		->middleware('permission:user_manage_delete');

	   	Route::get('user-details/{user_id?}','UserController@userDetails')
	    		->name('user.details')
	    		->middleware('permission:user_details');	  

	    Route::any('user-status/{user_id?}','UserController@userStatus')
	    		->name('user.status')
	    		->middleware('permission:user_status');	  		

		Route::get('role','UserController@userRole')
				->name('user.role')
				->middleware('permission:user_manage_view_role');

		Route::post('role','UserController@addUserRole')
				->name('user.add.role')
				->middleware('permission:user_manage_add_role');

		Route::get('remove-role/{role_id}','UserController@removeUserRole')
				->name('user.remove.role')
				->middleware('permission:user_manage_delete_role');

		/*Route::get('permission','UserController@userPermission')->name('user.permission');
		Route::post('permission','UserController@addUserPermission')->name('user.add.permission');*/

		Route::get('assign-role-permission/{role_id}','UserController@roleModuleShow')
				->name('user.role.permission')
				->middleware('permission:user_manage_view_role');

		Route::post('assign-role-permission','UserController@assignRolePermission')
				->name('user.add.role.permission')
				->middleware('permission:user_manage_assign_role');


	});
	
	/****************************End User Management System*************************/




	/****************************Notification*************************/

	Route::get('/notification_insurance_view', ['as'=>'notification_insurance_view', 'middleware' => 'permission:notification_insurance_view', 'uses'=>'NotificationController@notification_insurance_view']);
	Route::any('/get-insurance-list', ['as'=>'getInsuranceList', 'middleware' => 'permission:notification_insurance_view', 'uses'=>'NotificationController@getInsuranceList']);

	Route::get('/notification_permit_view', ['as'=>'notification_permit_view', 'middleware' => 'permission:notification_permit_view', 'uses'=>'NotificationController@notification_permit_view']);
	Route::any('/get-permit-list', ['as'=>'getPermitList', 'middleware' => 'permission:notification_permit_view', 'uses'=>'NotificationController@getPermitList']);

	Route::get('/notification_tax_view', ['as'=>'notification_tax_view', 'middleware' => 'permission:notification_tax_view', 'uses'=>'NotificationController@notification_tax_view']);
	Route::any('/get-tax-list', ['as'=>'getTaxList', 'middleware' => 'permission:notification_tax_view', 'uses'=>'NotificationController@getTaxList']);

	Route::get('/notification_pollution_view', ['as'=>'notification_pollution_view', 'middleware' => 'permission:notification_pollution_view', 'uses'=>'NotificationController@notification_pollution_view']);
	Route::any('/get-pollution-list', ['as'=>'getPollutionList', 'middleware' => 'permission:notification_pollution_view', 'uses'=>'NotificationController@getPollutionList']);

	Route::get('/notification_registration_view', ['as'=>'notification_registration_view', 'middleware' => 'permission:notification_registration_view', 'uses'=>'NotificationController@notification_registration_view']);
	Route::any('/get-registration-list', ['as'=>'getRegistrationList', 'middleware' => 'permission:notification_registration_view', 'uses'=>'NotificationController@getRegistrationList']);

	/****************************Notification*************************/



	/****************************payment module manage*************************/

	Route::get('/plant-laser-view', ['as'=>'plant_laser_view', 'middleware' => 'permission:plant_manage_view', 'uses'=>'PlantLaserController@index']);
	Route::any('/get-allplant-list', ['as'=>'all_plant_list', 'middleware' => 'permission:plant_payment', 'uses'=>'PlantLaserController@all_plan_list']);
	Route::any('/view-selected-plantlaser/{id}/{year}', ['as'=>'selected_plantlaser_view', 'middleware' => 'permission:plant_manage_view', 'uses'=>'PlantLaserController@selected_plant_laser_view']);
	Route::any('/get-plantLaser-list', ['as'=>'plant_laser_list', 'middleware' => 'permission:plant_manage_view', 'uses'=>'PlantLaserController@plant_laser_list']);

	Route::get('/petrolpump-laser-view', ['as'=>'petrolpump_laser_view', 'middleware' => 'permission:petrol_pump_view', 'uses'=>'PetrolpumpLaserController@index']);
	Route::any('/get-allpetrolpump-list', ['as'=>'all_petrolpump_list', 'middleware' => 'permission:petrol_pump_view', 'uses'=>'PetrolpumpLaserController@all_petrolpump_list']);
	Route::any('/view-selected-petrolpump-laser/{id}/{year}', ['as'=>'selected_petrolpump_laser_view', 'middleware' => 'permission:petrol_pump_view', 'uses'=>'PetrolpumpLaserController@selected_petrolpump_laser_view']);
	Route::any('/get-petrolpump-laser-list', ['as'=>'petrolpump_laser_list', 'middleware' => 'permission:petrolpump_payment', 'uses'=>'PetrolpumpLaserController@petrolpump_laser_list']);

	Route::get('/pay-to-petrolpump', ['as'=>'pay_to_petrolpump', 'middleware' => 'permission:petrolpump_payment', 'uses'=>'PetrolpumpPayController@index']);
	Route::any('/add-petrolpump-payment', ['as'=>'add_petrolpump_payment', 'middleware' => 'permission:petrolpump_payment', 'uses'=>'PetrolpumpPayController@savePetrolPumpPayment']);

	Route::get('/pay-to-plant', ['as'=>'pay_to_plant', 'middleware' => 'permission:plant_payment', 'uses'=>'PlantPayController@index']);
	Route::any('/add-plant-payment', ['as'=>'add_plant_payment', 'middleware' => 'permission:plant_payment', 'uses'=>'PlantPayController@savePlantPayment']);


	Route::get('/pay-to-vendor', ['as'=>'viewAddVendorPay', 'middleware' => 'permission:vendor_payment', 'uses'=>'VendorPayController@viewAddVendorPay']);
	Route::any('/save-vendor-payment', ['as'=>'saveVendorPay', 'middleware' => 'permission:vendor_payment', 'uses'=>'VendorPayController@saveVendorPay']);

	/****************************payment module manage*************************/

	/****************************Approval manage*************************/

	Route::get('/misclleneous-view', ['as'=>'misclleneous_view', 'middleware' => 'permission:misclleneous_view', 'uses'=>'ApprovalManageController@misclleneous']);
	Route::any('/get-misclleneous-list', ['as'=>'all_misclleneous_list', 'middleware' => 'permission:misclleneous_view', 'uses'=>'ApprovalManageController@all_misclleneous_list']);
	Route::any('/approve-disapprove-misclleneous', ['as'=>'approve_misclleneous', 'middleware' => 'permission:misclleneous_view', 'uses'=>'ApprovalManageController@approve_misclleneous']);

	Route::get('/approvle-adv-view', ['as'=>'approvle_adv_view', 'middleware' => 'permission:approvle_adv_view', 'uses'=>'ApprovalManageController@approvle_adv_view']);
	Route::any('/get-adv-list', ['as'=>'all_adv_list', 'middleware' => 'permission:approvle_adv_view', 'uses'=>'ApprovalManageController@all_adv_list']);
	Route::any('/approve-disapprove-adv', ['as'=>'approve_adv', 'middleware' => 'permission:approvle_adv_view', 'uses'=>'ApprovalManageController@approve_adv']);

	Route::get('/approvle-dsl-view', ['as'=>'approvle_dsl_view', 'middleware' => 'permission:approvle_dsl_view', 'uses'=>'ApprovalManageController@approvle_dsl_view']);
	Route::any('/get-dsl-list', ['as'=>'all_dsl_list', 'middleware' => 'permission:approvle_dsl_view', 'uses'=>'ApprovalManageController@all_dsl_list']);
	Route::any('/approve-disapprove-dsl', ['as'=>'approve_dsl', 'middleware' => 'permission:approvle_dsl_view', 'uses'=>'ApprovalManageController@approve_dsl']);

	/****************************Approval manage*************************/

	/***************************App Module********************************/
	Route::prefix('app-module')->group(function () {
		Route::get('list','UserController@showAppModule')
				->name('app.module.list');

		Route::get('functions-list','UserController@showAppModulefunctions')
				->name('app.module.functionalities');
	});
	/***************************End App Module******************************/

	/***************************Unauthorized Access*************************/
	Route::get('403',function(){
		return view('access-deny');
	})->name('access.deny');
	/**************************End Unauthorized Access**********************/
				
});
//==================================== Auth Section =========================================
