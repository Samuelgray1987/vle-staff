var userDirectives = angular.module('users-directives', ['user-services']);

userDirectives.directive("isResourceActive", function(IsPermissionGranted, FlashService, CSRF_TOKEN){
	return {
		restrict: 'C',
		scope: {},
		link: function (scope, element, attrs) {
			var permissions = IsPermissionGranted.check({username: attrs.user, group: attrs.value, CSRF_TOKEN: CSRF_TOKEN}, function(data){ 
		      //Success
		    });
		    permissions.$promise.then(function(response){
		      //Fail
		      
		    })
		}
	}
});