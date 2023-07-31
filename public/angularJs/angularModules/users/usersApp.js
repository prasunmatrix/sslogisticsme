'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/users/usersAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'userApp' ]);
});