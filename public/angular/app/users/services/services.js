 angular.module('user-services', []);
 /*
 *
 * Factories
 *
 */

angular.module('user-services').factory("StaffUsers", function($http, FlashService){
	var usersError = function(response){
		FlashService.show(response.flash);
	};
	return {
		get: function() {
			var users = $http.get("./adminuser");
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

angular.module('user-services').factory("Groups", function($http, FlashService){
	var usersError = function(response){
		FlashService.show(response.flash);
	};
	return {
		get: function() {
			var users = $http.get("./admingroups");
			users.success(FlashService.clear);
			users.error(usersError);
			return users;
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
