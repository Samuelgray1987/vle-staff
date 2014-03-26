var commonServices = angular.module('commonservices', ['commoncontrollers']);

commonServices.factory("FlashService", function($rootScope, $timeout){
	return {
		show: function(message) {
			$rootScope.flash = message;
			$timeout(function(){
				$rootScope.flash = "";
			}, 5000);
		},
		clear: function(){
			$rootScope.flash = "";
		},
		showMessage: function(message) {
			$rootScope.message = message;
		},
		clearMessage: function() {
			$rootScope.message = "";
		}
	}
})

commonServices.factory("FormPostingService", function($http, $rootScope, $timeout, FlashService){
	var postError = function(response) {
		FlashService.show(response.flash);
	};

	return {
		postForm : function(url, data, message) {
			var dataToSend = $http.post(url, data);
			dataToSend.success(function(){
				$rootScope.message = message;
				$timeout(function(){
					FlashService.clearMessage();
				}, 10000)
			});
			dataToSend.error(postError);
			return dataToSend;
		}
	}
});
