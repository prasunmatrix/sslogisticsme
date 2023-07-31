'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/notifications/notificationAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'notificationApp' ]);
});