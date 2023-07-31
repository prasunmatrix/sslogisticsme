'use strict';
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/profile/profileAppManager' ,
		], function() {
	angular.bootstrap(document, [ 'myApp', 'profileApp' ]);
	
});