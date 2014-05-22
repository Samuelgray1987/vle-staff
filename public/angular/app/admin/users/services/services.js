 angular.module('user-services', []);
 /*
 *
 * Factories
 *
 */

angular.module('user-services').factory("StaffUsers", function($http, FlashService, $route){
	var usersError = function(response){
		FlashService.show(response.flash);
	};
	return {
		get: function() {
			var users = $http.get("./admin/permissionsstaff/" + $route.current.params.id);

			users.success(FlashService.clear);
			users.error(usersError);
			return users;
		},
		getAssignDetails: function() {
			var users = $http.get("./adminassignpermissions");
			users.success(FlashService.clear);
			users.error(usersError);
			return users;
		}
	}
});

angular.module('user-services').factory("Groups", function($http, FlashService, $route){
	var groupsError = function(response){
		FlashService.show(response.flash);
	};
	return {
		get: function() {
			var groups = $http.get("./admingroups");
			groups.success(FlashService.clear);
			groups.error(groupsError);
			return groups;
		},
		individual: function() {
			var groups = $http.get("./admingroups/" + $route.current.params.id);
			groups.success(FlashService.clear);
			groups.error(groupsError);
			return groups;
		}
	}
});

angular.module('user-services').factory("Resources", function($http, FlashService){
	var resourcesError = function(response){
		FlashService.show(response.flash);
	};
	return {
		get: function() {
			var resources = $http.get("./adminresources");
			resources.success(FlashService.clear);
			resources.error(resourcesError);
			return resources;
		},
		individual: function() {
			var resources = $http.get("./adminresources");
			resources.success(FlashService.clear);
			resources.error(resourcesError);
			return resources;
		}
	}
});

angular.module('user-services').factory('GroupsAdd', function(FlashService, $resource){
	return $resource('./admingroups', {}, {
				add: { method: 'POST', params: {}, isArray: false, 
								interceptor: { 
												response : function (data) {
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													return false;
												},
												responseError: function(data)
												{	
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													return data.data;
												}
											} 
							  }
			});
});

angular.module('user-services').factory('GroupsDelete', function(FlashService, $resource){
	return $resource('./admingroups/:id', {}, {
				delete: { method: 'DELETE', params: {}, isArray: false, 
								interceptor: { 
												response : function (data) {
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													return false;
												},
												responseError: function(data)
												{	
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													return data.data;
												}
											} 
							  }
			});
});

angular.module('user-services').factory('IsPermissionGranted', function(FlashService, $resource){
	return $resource('./permissions/groupusers', {}, {
				check: { method: 'POST', params: {}, isArray: false, 
								interceptor: { 
												response : function (data) {
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													return data.data;
												},
												responseError: function(data)
												{	
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													return data.data;
												}
											} 
							  }
			});
});

angular.module('user-services').factory('IsUserPermissionGranted', function(FlashService, $resource){
	return $resource('./permissions/user', {}, {
				check: { method: 'POST', params: {}, isArray: false, 
								interceptor: { 
												response : function (data) {
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													return data.data;
												},
												responseError: function(data)
												{	
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													return data.data;
												}
											} 
							  }
			});
});

angular.module('user-services').factory('ResourcesUpdate', function(FlashService, $resource){
	return $resource('./permissions/groupupdate', {}, {
				update: { method: 'POST', params: {}, isArray: false, 
								interceptor: { 
												response : function (data) {
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													return data.data;
												},
												responseError: function(data)
												{	
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													return data.data;
												}
											} 
							  }
			});
});

angular.module('user-services').factory('UserPermissionsUpdate', function(FlashService, $resource){
	return $resource('./permissions/userupdate', {}, {
				update: { method: 'POST', params: {}, isArray: false, 
								interceptor: { 
												response : function (data) {
													return data.data;
												},
												responseError: function(data)
												{	
													document.body.scrollTop = document.documentElement.scrollTop = 0;
													return data.data;
												}
											} 
							  }
			});
});
