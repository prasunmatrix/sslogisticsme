'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/trucks/truckAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'truckApp' ]);
});