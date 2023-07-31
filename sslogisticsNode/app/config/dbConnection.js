/*****************************************************
App Database Connection
# Company Name          : Matrix Media Solutions Pvt. Ltd.
# Author                : Dilip Shaw                                   
# Created Date          : 26-09-2018
# App Routes            : App Database Connection
# Functionality         : This is a databse connection configration files.
# Purpose               : For Manage Databse Connection
****************************************************/
'use strict';
var knex = require('knex')({
	client : 'mysql',
	connection : {
		host : '192.168.1.7', //localhost
		user : 'devsslogistics', //database username
		password : 'qHEvRcWZtqr3z2fJ', // database password
		database : 'devsslogistics', // database name
		timezone : 'UTC', // timezone
		charset : 'utf8' // charset 
	}
});

var dbConn = require('bookshelf')(knex);

module.exports = dbConn;