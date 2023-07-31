"use strict";
require
		.config({
			baseUrl : baseUrl + "/angularJs",
			waitSeconds : 0,
			paths : {
				angular : "bower_components/angular/angular",
                appConfig : "app_config",
                c_lib : "custom_lib",
				ngAnimate : "bower_components/angular-animate/angular-animate",
				jquery : "bower_components/jquery/dist/jquery",
				bootstrap : "bower_components/bootstrap/dist/js/bootstrap",
				angularBootstrap : 'bower_components/angular-bootstrap/ui-bootstrap-tpls',
				ngSanitize : 'bower_components/angular-sanitize/angular-sanitize',
				dom : 'bower_components/domReady/domReady',
				spinner: "bower_components/angular-treasure-overlay-spinner/dist/treasure-overlay-spinner.min",
				ngAria : 'bower_components/others/angular-aria',
				ngMaterial : 'bower_components/others/angular-material',
				uiSelect : 'bower_components/angular-ui-select/dist/select',
				//ngImgCrop : 'bower_components/ngImgCrop/compile/unminified/ng-img-crop',
			},
			shim : {
				angular : {
					deps : [ 'appConfig', 'c_lib' ]
				},
				bootstrap : {
					deps : [ 'angular' ]
				},
				angularBootstrap : {
					deps : [ 'angular' ]
				},
				ngAnimate : {
					deps : [ 'angular' ]
				},
				jquery : {
					deps : [ 'angular' ]
				},
				ngSanitize : {
					deps : [ 'angular' ]
				},
				ngRoute : {
					deps : [ 'angular' ]
				},
				spinner:{
                	deps: ['angular']
            	},
				ngAria : {
					exports : 'angular'
				},
				ngMaterial : {
					exports : 'angular'
				},
				uiSelect : {
					exports : 'angular'
				}
			}
		});