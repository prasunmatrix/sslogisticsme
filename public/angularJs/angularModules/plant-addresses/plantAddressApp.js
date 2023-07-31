'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/plant-addresses/plantAddressAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'plantAddressApp' ]);
});