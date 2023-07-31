'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/party-destinations/partyDestinationAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'partyDestinationApp' ]);
});