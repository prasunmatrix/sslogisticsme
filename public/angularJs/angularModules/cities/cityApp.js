'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/cities/cityAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'cityApp' ]);
});