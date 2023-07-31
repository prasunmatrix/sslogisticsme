'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/states/stateAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'stateApp' ]);
});