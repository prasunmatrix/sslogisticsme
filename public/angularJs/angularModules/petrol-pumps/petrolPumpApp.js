'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/petrol-pumps/petrolPumpAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'petrolPumpApp' ]);
});