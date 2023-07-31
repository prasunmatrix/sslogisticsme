'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/countries/countryAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'countryApp' ]);
});