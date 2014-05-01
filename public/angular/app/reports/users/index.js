var reports = angular.module('reports', [
	'reports-services',
	'reports-controllers',
	'reports-directives'
	]);
/*
 *
 * Configure app
 * Configure routes
 *
 */

 reports.config(function($routeProvider){

 	$routeProvider.when('/',{
 		templateUrl: './views/reports/reportcard/dashboard',
 		controller: 'HomeController',
 		resolve: {
 			myClasses: function(Classes) {
	 			return Classes.myClasses();
 			}
 		}
 	});
 	
 	$routeProvider.when('/report-cards',{
 		templateUrl: './views/reports/reportcard/dashboard',
 		controller: 'HomeController',
 		resolve: {
 			myClasses: function(Classes) {
	 			return Classes.myClasses();
 			}
 		}
 	});
 	
 	$routeProvider.when('/report-cards-hod',{
 		templateUrl: './views/reportsadmin/reportcard/dashboard',
 		controller: 'HomeHodController',
 		resolve: {
 			departmentClasses: function(Classes) {
	 			return Classes.departmentClasses();
 			}
 		}
 	});

 	$routeProvider.when('/report-cards-hod-all',{
 		templateUrl: './views/reportsadmin/reportcard/dashboard',
 		controller: 'HomeAllController',
 		resolve: {
 			allClasses: function(Classes) {
	 			return Classes.allClasses();
 			}
 		}
 	});

 	$routeProvider.when('/report-cards/edit-report-cards',{
 		templateUrl: './views/reports/reportcard/edit-report-cards',
 		controller: 'EditReportCardController'
 	});

 	$routeProvider.when('/report-cards/admin-edit-report-cards',{
 		templateUrl: './views/reportsadmin/reportcard/edit-report-cards',
 		controller: 'EditReportCardController'
 	});

 	$routeProvider.otherwise({
 		redirectTo: '/'
 	});

 });