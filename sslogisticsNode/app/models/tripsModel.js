/*****************************************************
# Company Name          : Matrix Media Solutions Pvt. Ltd.
# Author                : Dilip Shaw                                   
# Created Date          : 27-09-2018
# Module                : ss_trips                     
# Object name           : ss_trips    
# Functionality         : Only Define a ss_trips model.                                  
# Purpose               : This is a model define for intract with database ss_trips tables.  
*****************************************************/
'use strict';
// ============================================================================
var dbConn = require('../config/dbConnection');

var tripsModel = dbConn.Model.extend({
	tableName : 'ss_trips'
	
});

module.exports = tripsModel;
// ============================================================================
