var userDirectives = angular.module('users-directives', ['user-services']);

userDirectives.directive("isResourceActive", function(IsPermissionGranted, FlashService, CSRF_TOKEN){
	return {
		restrict: 'C',
		scope: {},
		link: function (scope, element, attrs) {
			var permissions = IsPermissionGranted.check({group: attrs.group, resource: attrs.resource, CSRF_TOKEN: CSRF_TOKEN}, function(data){ 
	      		if (data == 'true') {
					element.attr("checked", true);
					/*$compile(element[0].form)(scope);*/
	      		}
		    });
	    }
	}
});

userDirectives.directive("isUserActive", function(IsUserPermissionGranted, FlashService, CSRF_TOKEN, $compile){
	return {
		restrict: 'C',
		scope: {},
		link: function (scope, element, attrs) {
			if (attrs.permissiongranted == 'true') {
				element.attr("checked", true);
				$compile(element[0].form)(scope);
      		} else {
      			element.attr("checked", false);
				$compile(element[0].form)(scope);
      		}

	    }
	}
});