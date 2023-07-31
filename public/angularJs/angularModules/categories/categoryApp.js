'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/categories/categoryAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'categoryApp' ]);
});