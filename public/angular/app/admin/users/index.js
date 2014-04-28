var user = angular.module('user', [
	'user-services',
	'user-controllers',
	'users-directives'
	]);
/*
 *
 * Configure app
 * Configure routes
 *
 */

 user.config(function($routeProvider){

 	$routeProvider.when('/users-staff',{
 		templateUrl: './users-staff',
 		controller: 'HomeController',
 		resolve: {
 			staffUsers: function(StaffUsers) {
	 			return StaffUsers.get();
 			}
 		}
 	});
 	$routeProvider.when('/users-permissions',{
 		templateUrl: './users-permissions',
 		controller: 'PermissionsController',
 		resolve: {
 			groups: function(Groups) {
	 			return Groups.get();
 			}
 		}
 	});
 	$routeProvider.when('/users-permissions-edit-group/:id', {
 		templateUrl: './users-permissions-edit-group',
 		controller: 'EditPermissionsGroupController',
 		resolve: {
 			groupDetails: function(Groups) {
 				return Groups.individual();
 			},
 			resources: function(Resources) {
 				return Resources.get();
 			},
 			staffUsers: function(StaffUsers) {
	 			return StaffUsers.get();
 			} 
 		}
 	});

 	$routeProvider.otherwise({
 		redirectTo: '/'
 	});

 });