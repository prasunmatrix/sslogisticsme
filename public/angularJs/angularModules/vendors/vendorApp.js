'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/vendors/vendorAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'vendorApp' ]);
});