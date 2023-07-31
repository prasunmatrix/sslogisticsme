'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/addressZones/addressZoneAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'addressZoneApp' ]);
});