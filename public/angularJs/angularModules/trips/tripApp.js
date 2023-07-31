'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/trips/tripAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'tripApp' ]);
});