'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/users-mange/usersAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'userApp' ]);
});