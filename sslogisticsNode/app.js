/*****************************************************
App Manager
# Company Name          : Matrix Media Solutions Pvt. Ltd.
# Author                : Dilip Shaw                                   
# Created Date          : 26-09-2018
# App Manager           : App Manager
# Functionality         : This is a custom built Framework with Node, Express Js, and others related Js.
# Purpose               : Manage All Node Modules 
****************************************************/

//========================================================================
//===========Include node plugin in app js =============//
var express = require('express');
var reload = require('reload');
var path = require('path');
var http = require('http');
app = express();
// ===============create the node server=================//
var server = http.createServer(app);
ioServer = require('socket.io').listen(server);
//========================================================================
// =============Create the app output port===============//
app.set('port', process.env.PORT || 5033);
// ===define public folder name for this app============//
app.use(express.static(path.join(__dirname, 'public')));
// =========include view engine=========================//
app.set('view engine', 'ejs');
// =========include view engine file path===============//
app.set('views', 'app/views');
//========================================================================
// =====include site Controllers file====================//
require('./app/config/include_file');
// =====include site configuration file==================//
require('./app/config/config');
// =======================================================================
// ===============run the node server====================//
server.listen(process.env.PORT || app.get('port'), function() {
	console.log('Listening on port ' + app.get('port'));
});
// ===============reload the node server=================//
reload(server, app);
// =======================================================================
