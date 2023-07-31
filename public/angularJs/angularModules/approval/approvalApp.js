'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/approval/approvalAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'approvalApp' ]);
});