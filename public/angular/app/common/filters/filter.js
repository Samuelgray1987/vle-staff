var filters = angular.module('commonfilters', []);

filters.directive('isActive', function($location){
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
			if ($location.$$path == attrs.link) {
				element.addClass('active');
			}
		}
	}
});