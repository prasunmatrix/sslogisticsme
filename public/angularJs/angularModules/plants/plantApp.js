'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/plants/plantAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'plantApp' ]);
});