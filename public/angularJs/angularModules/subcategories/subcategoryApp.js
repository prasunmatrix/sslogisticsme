'use strict'
require([ 'angular', 'angularModules/common/commonAppManager',
		'angularModules/subcategories/subcategoryAppManager' ], function() {
	angular.bootstrap(document, [ 'myApp', 'subcategoryApp' ]);
});