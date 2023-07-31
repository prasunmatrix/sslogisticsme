/*****************************************************
# Company Name          : Matrix Media Solutions Pvt. Ltd.
# Author                : Dilip Shaw                                   
# Created Date          : 27-09-2018
# Module                : truckModel                     
# Object name           : truckModel    
# Functionality         : Only Define a ss_trucks model with enter has many relation with ss_trips.                                  
# Purpose               : This is a model define for intract with database ss_trucks tables.  
*****************************************************/
'use strict';
// ============================================================================
var dbConn = require('../config/dbConnection');
var tripsModel = require('./tripsModel');

var truckModel = dbConn.Model.extend({
	tableName : 'ss_trucks',
	ss_trips : function() {
		return this.hasMany(tripsModel, 'truck_id');
	}
	
});

module.exports = truckModel;
// ============================================================================
