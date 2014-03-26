angular.module('commoncontrollers', []);

angular.module('commoncontrollers').controller('NavController', function(Links, $scope){
	var links = Links.get().then(function(data){$scope.links = data.data;});
});