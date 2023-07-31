/*****************************************************
App Routes
# Company Name          : Matrix Media Solutions Pvt. Ltd.
# Author                : Dilip Shaw                                   
# Created Date          : 26-09-2018
# App Routes            : App Routes
# Functionality         : This is a custom built App Routes with Node, Express Js, and others related Js.
# Purpose               : For Manage All App Routes
****************************************************/
'use strict';
// ============================================================================
var express = require('express');
var router = express.Router();
// ============================================================================
// =======Include Controllers=============================//
var home = require('../controllers/homeController');
var gps = require('../controllers/gpsController');
var map = require('../controllers/mapController');
// =======End Include Controllers=========================//
// ============================================================================
// =======Routes=============================//
// ===home page 
router.get('/', home.homePage);
// ===gps device data save get url
router.get('/gps/device/data', gps.gpsTrackingDataSave);
// ===gps device data save post url
router.post('/gps/device/data', gps.gpsTrackingDataSave);
// ===truck no wise map view
router.all('/map/device/:slug', map.gpsTrackingwWithTruck);
// =======End Routes=========================//
// ============================================================================
// ===404 error define
router.use(function(req, res) {
	res.status(404);
	res.render('404');
});
// ============================================================================
// ===500 error define
router.use(function(error, req, res, next) {
	res.status(500);
	res.render('500');
});
// ============================================================================
module.exports = router;
// ============================================================================
