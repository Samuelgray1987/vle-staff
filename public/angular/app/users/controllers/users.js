angular.module('user-controllers', []);

angular.module('user-controllers').controller('HomeController', function($timeout, FlashService, $scope, $rootScope, $location, staffUsers){
  $scope.title = "Staff Users Administration"
  $scope.staffUsers = staffUsers.data.active;
  $scope.staffInactiveUsers = staffUsers.data.inactive;
	window.scope = $scope;
});

angular.module('user-controllers').controller('PermissionsController', function($timeout, GroupsDelete, Groups, FlashService, $scope, $rootScope, $location, groups, GroupsAdd, CSRF_TOKEN){
  //Data
  $scope.title = "Staff Users Administration"
  $scope.groups = groups.data.active;
  $scope.inactiveGroups = groups.data.inactive;

  //
  //Functions
  //

  //Add a new group
  $scope.submit = function() {
    var promise = GroupsAdd.add({name: this.name, CSRF_TOKEN: CSRF_TOKEN}, function(data){
      //Success
      var groups = Groups.get(function(data){
      });
      groups.then(function(data){
        $scope.groups = data.data.active;
        $scope.inactiveGroups = data.data.inactive;
        FlashService.show("Your new group: has been added.");
      });

    });
    promise.$promise.then(function(response){
      //Fail
      $scope.errors = response[0];
    });
  };

  //Delete a group
  $scope.deleteGroup = function(groupid, name, index) {
    var deleted = GroupsDelete.delete({id: groupid, CSRF_TOKEN: CSRF_TOKEN}, function(data){ 
      //Success
      FlashService.show("Group deleted.");
    });
    deleted.$promise.then(function(response){
      //Fail
      if(response){
        console.log(response[0]);
        FlashService.show("Could not delete: " + response[0]);
      }
    })
    $scope.groups.splice(index, 1);
  };

  //Controller debugging
  window.scope = $scope;
});

angular.module('user-controllers').controller('AssignPermissionsController', function($scope,FlashService,CSRF_TOKEN,staffUsers){
  $scope.title = "Assign User Permission Groups";

  //Data
  $scope.groups = staffUsers.data.groups;
  $scope.users = staffUsers.data.users;
  $scope.resources = staffUsers.data.resources;

  //Controller Debugging
  window.scope = $scope;

});

angular.module('user-controllers').controller('EditPermissionsGroupController', function($scope,FlashService,CSRF_TOKEN,staffUsers){
  $scope.title = "Edit Group";

  //Data
  $scope.groups = staffUsers.data.groups;
  $scope.users = staffUsers.data.users;
  $scope.resources = staffUsers.data.resources;

  //Controller Debugging
  window.scope = $scope;

});