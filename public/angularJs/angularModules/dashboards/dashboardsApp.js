'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/dashboards/dashboardsAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'dashboardApp' ]);
});