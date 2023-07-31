'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/parties/partyAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'partyApp' ]);
});