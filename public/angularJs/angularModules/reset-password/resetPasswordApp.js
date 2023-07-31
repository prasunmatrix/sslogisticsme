'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/reset-password/resetPasswordAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'resetPasswordApp' ]);
});