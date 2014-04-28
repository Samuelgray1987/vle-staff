var reportsDirectives = angular.module('reports-directives', ['reports-services']);

reportsDirectives.directive("getClassReportDetails", function(GetClassReports, FlashService, CSRF_TOKEN, $rootScope){
	return {
		restrict: 'C',
		link: function (scope, element, attrs) {
			if (attrs.complete == attrs.students) {
      			scope.panelBackground = "complete-profile";
      		} else {
      			scope.panelBackground = "incomplete-profile";
      		}
			
	    }
	}
});
reportsDirectives.directive('myCurrentTime', function($interval, dateFilter) {
	function link(scope, element, attrs) {
		var format = 'EEE MMM d h:mm:ss a';
		var timeoutId;
		 
		function updateTime() {
			element.text(dateFilter(new Date(), format));
		}
	 	 
		element.on('$destroy', function() {
			$interval.cancel(timeoutId);
		});
	 
		// start the UI update process; save the timeoutId for canceling
		timeoutId = $interval(function() {
			updateTime(); // update DOM
		}, 1000);
	}
 
	return {
		link: link
	};
});