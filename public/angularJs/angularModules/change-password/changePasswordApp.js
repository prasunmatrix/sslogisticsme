'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/change-password/changePasswordAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'changePasswordApp' ]);
});