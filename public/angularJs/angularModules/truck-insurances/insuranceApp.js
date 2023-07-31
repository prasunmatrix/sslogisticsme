'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/truck-insurances/insuranceAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'insuranceApp' ]);
});