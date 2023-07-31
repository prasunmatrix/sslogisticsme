'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/forgot-password/forgotPasswordAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'forgotPasswordApp' ]);
});