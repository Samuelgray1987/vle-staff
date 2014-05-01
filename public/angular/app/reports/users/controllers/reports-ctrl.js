angular.module('reports-controllers', []);

/*Load Google Charts*/
google.load('visualization', '1', {
  packages: ['corechart', 'table']
});

angular.module('reports-controllers').controller('HomeController', function($timeout, FlashService, $scope, $rootScope, $location, myClasses){
  //Data
  $rootScope.grandTotalStudents = 0;
  $rootScope.grandTotalStudentsConfirmed = 0;
  $rootScope.grandTotalStudentsCompleted = 0;
  $scope.title = "My Report Cards";
  $scope.myClasses = myClasses.data;

  //Data Manipulation
  angular.forEach($scope.myClasses, function(data){
    data.completed = parseInt(data.completed);
    data.confirmed = parseInt(data.confirmed);
    data.flagged = parseInt(data.flagged);
    data.student_count = parseInt(data.student_count);
    data.modified_since_flagged = parseInt(data.modified_since_flagged);
    $scope.grandTotalStudents += parseInt(data.student_count);
    $scope.grandTotalStudentsCompleted += parseInt(data.completed);
    $scope.grandTotalStudentsConfirmed += parseInt(data.confirmed);
  });

  //Functions
  $scope.edit = function(classid, search) {
    $location.url('/report-cards/edit-report-cards?class='+classid+'&back=report-cards&linktext=Report%20Cards');
  }
  //Debugging
	window.scope = $scope;
});
angular.module('reports-controllers').controller('HomeHodController', function($timeout, FlashService, $scope, $rootScope, $location, departmentClasses){
  //Data
  $scope.grandTotalStudents = 0;
  $scope.grandTotalStudentsConfirmed = 0;
  $scope.grandTotalStudentsCompleted = 0;
  $scope.title = "HOD Report Cards";
  $scope.myClasses = departmentClasses.data;

  //Data Manipulation
  angular.forEach($scope.myClasses, function(data){ 
    data.completed = parseInt(data.completed);
    data.confirmed = parseInt(data.confirmed);
    data.flagged = parseInt(data.flagged);
    data.student_count = parseInt(data.student_count);
    data.modified_since_flagged = parseInt(data.modified_since_flagged);
    $scope.grandTotalStudents += parseInt(data.student_count);
    $scope.grandTotalStudentsCompleted += parseInt(data.completed);
    $scope.grandTotalStudentsConfirmed += parseInt(data.confirmed);
  });

  //Functions
  $scope.edit = function(classid, search) {
    if(typeof(search) == "undefined") {
      search = [];
      search.class = "";
    }
    $location.url('/report-cards/admin-edit-report-cards?class='+classid+'&back=report-cards-hod&linktext=Report%20Cards%20HOD');
  }

  //Debugging
  window.scope = $scope;
});
angular.module('reports-controllers').controller('HomeAllController', function($timeout, FlashService, $scope, $rootScope, $location, allClasses){
  //Data
  $rootScope.grandTotalStudents = 0;
  $rootScope.grandTotalStudentsConfirmed = 0;
  $rootScope.grandTotalStudentsCompleted = 0;
  $scope.title = "All Report Cards";
  $scope.myClasses = allClasses.data;

  //Data Manipulation
  angular.forEach($scope.myClasses, function(data){ 
    data.completed = parseInt(data.completed);
    data.confirmed = parseInt(data.confirmed);
    data.flagged = parseInt(data.flagged);
    data.student_count = parseInt(data.student_count);
    data.modified_since_flagged = parseInt(data.modified_since_flagged);
    $scope.grandTotalStudents += parseInt(data.student_count);
    $scope.grandTotalStudentsCompleted += parseInt(data.completed);
    $scope.grandTotalStudentsConfirmed += parseInt(data.confirmed);
  });

  //Functions
  $scope.edit = function(classid, search) {
    $location.url('/report-cards/admin-edit-report-cards?class='+classid+'&back=report-cards-hod-all&linktext=Report%20Cards%20All');
  }

  //Debugging
  window.scope = $scope;
});
angular.module('reports-controllers').controller('EditReportCardController', function(FlagReportCard, CompleteReportCard, DeleteReportCard, InsertReportCard, GetAttainmentGraphData,GetAttainmentTableData, $timeout, $location, FlashService, $scope, $rootScope, GetDataEntries, GetClassReports, CSRF_TOKEN){

  //Date
  $scope.title = "Edit Report Cards";
  $scope.class = $location.search()['class'];
  $scope.student = $location.search()['student'];
  $scope.linkBack = $location.search()['back'];
  $scope.linkText = $location.search()['linktext'];
  $scope.navType="tabs";
  //Arrays for report creation
  $scope.incompletestudents = [];
  $scope.completestudents = [];
  //Arrays for HOD manipulations
  $scope.hodcompletestudents = [];
  $scope.hodflaggedstudents = [];

  $scope.students = GetClassReports.get({id: $scope.class, CSRF_TOKEN: CSRF_TOKEN}, function(data){
    angular.forEach(data, function(data){
      if (data.report_completed_at === null) {
        $scope.incompletestudents.push(data);
      } 
      if (data.report_completed_at !== null && data.management_flagged_at === null) {
        $scope.completestudents.push(data);
      }
      if (data.management_confirmed_at !== null) {
        $scope.hodcompletestudents.push(data);
      }
      if (data.management_flagged_at !== null) {
        $scope.hodflaggedstudents.push(data);
      }
    });
  });
  
  //Functions
  $scope.selectStudent = function(student){
    document.body.scrollTop = document.documentElement.scrollTop = 0;
    $scope.currentStudent = student;
    tabs(student);
  }

  $scope.deleteReportCard = function(card) {
    var deleteCard = DeleteReportCard.delete({id: card.id}, function(data){
      //Success
      FlashService.show(data.flash);
      //Remove the student from the complete area.
      card.report_comment = "";
      var key = 0;
      angular.forEach($scope.completestudents, function(data){
        if (card.student_upn == data.student_upn) {
          $scope.completestudents.splice(key, 1);
          $scope.incompletestudents.push(data);
        }
        key += 1;
      });
      var key = 0;
      angular.forEach($scope.hodflaggedstudents, function(data){
        if (card.student_upn == data.student_upn) {
          $scope.hodflaggedstudents.splice(key, 1);
          $scope.incompletestudents.push(data);
        }
        key += 1;
      });
    });
    deleteCard.$promise.then(function(data){
      FlashService.show(data.flash);
    });
  }

  $rootScope.hodFlag = function(card, comment) {
    var flagCard = FlagReportCard.post({id: card.id, flagged_comment: comment}, function(data){
      //Success
      FlashService.show(data.flash);
      $scope.currentStudent.flagged_comment = comment;
      //Add flag to the viewport
      $scope.currentStudent.management_flagged_at = 1;
      var key = 0;
      angular.forEach($scope.hodcompletestudents, function(data){
        if (card.student_upn == data.student_upn) {
          $scope.hodcompletestudents.splice(key, 1);
        }
        key += 1;
      });

      //Add the student to the flagged area.
      var countFlagged = 0;
      angular.forEach($scope.hodflaggedstudents, function(data){
        if (card.student_upn == data.student_upn) {
          data.modified_since_flagged = null;
          countFlagged = 1;
        }
      });
      if (countFlagged == 0) {
        card.modified_since_flagged = null;
        card.management_confirmed_at = null;
        $scope.hodflaggedstudents.push(card);
      }

      //Change the data within the students scope
      angular.forEach($scope.students, function(data){
        if(card.student_upn == data.student_upn) { 
          data.modified_since_flagged = null;
          data.management_confirmed_at = null;
          data.management_flagged_at = 1;
        }
      });

    });

    //Failure
    flagCard.$promise.then(function(data){
      FlashService.show(data.flash);
    });
  }

  $scope.hodComplete = function(card) {
    var flagCard = CompleteReportCard.post({id: card.id}, {report_comment: card.report_comment}, function(data){
      //Success
      FlashService.show(data.flash);
      //Remove flag from the viewport
      $scope.currentStudent.management_flagged_at = null;
      //Remove the student from the complete area.
      var key = 0;
      angular.forEach($scope.hodflaggedstudents, function(data){
        if (card.student_upn == data.student_upn) {
          $scope.hodflaggedstudents.splice(key, 1);
        }
        key += 1;
      });

      //Add the student to the flagged area.
      var countFlagged = 0;
      angular.forEach($scope.hodcompletestudents, function(data){
        if (card.student_upn == data.student_upn) {
          countFlagged = 1;
        }
      });
      if (countFlagged == 0) {
        card.modified_since_flagged = null;
        card.management_confirmed_at = 1;
        $scope.hodcompletestudents.push(card);
      }

      //Change the data within the students scope
      angular.forEach($scope.students, function(data){
        if(card.student_upn == data.student_upn) {
          data.modified_since_flagged = null;
          data.management_confirmed_at = 1;
          data.management_flagged_at = null;
        }
      });

    });

    //Failure
    flagCard.$promise.then(function(data){
      FlashService.show(data.flash);
    });
  }

  tabs = function(student) {
    if($scope.currentStudent != "undefined"){
      //Retrieve previous entries
      var entries = GetDataEntries.get({upn: student.student_upn, limit: 5}, function(data){
       var x = 0;
        angular.forEach(data, function(entry){

          //Draw the Graph
          var graphdata = GetAttainmentGraphData.get({upn: student.student_upn, entry: entry.date}, function(graphData){
            //Google Graph
            var graph = new google.visualization.DataTable(graphData.data);
            var options = {
              title: '',
              width: "100%",
              height: 420,
              is3D: true,
              colors: ['#2B3E50', '#5BC0DE', '#4E5D6C'],
              hAxis: {
                slantedText: true
              }
            };
            $scope.tabs = [
              { title: entry.date, graphid:"attainmentchartdiv-" + x, graph: graph, options:options}
            ];

          });

          //Draw the Table
          var graphdata = GetAttainmentTableData.get({upn: student.student_upn, entry: entry.date}, function(graphData){
            //Google Graph
            var y = 0;
            var graph = new google.visualization.DataTable(graphData.data);
            $scope.tabs[y].table = graph;
            $scope.tabs[y].tableid = "attainmenttablediv-" + x;
            y++;
          });
        
        });
      x++;
      });     
    }
  }

  $scope.drawGraph = function(tab) {
    var chart = new google.visualization.ColumnChart(document.getElementById(tab.graphid));
    chart.draw(tab.graph, tab.options);
    $scope.drawTable(tab);
  }

  $scope.drawTable = function(tab) {
    var tableoptions = {
    };
    var table = new google.visualization.Table(document.getElementById(tab.tableid));
    table.draw(tab.table, tableoptions);
  }
  //Update report card.
  $scope.updateReportCard = function(student) {
    var inserted = InsertReportCard.insert({student_upn: student.student_upn,
                                            staff_upn: student.staff_upn,
                                            report_comment: student.report_comment,
                                            class_id: student.class_id }
    , function(data){
      //Success
      FlashService.show("Record successfully added.");
      student.id = data.id;
      //Remove the student from the incomplete area.
      var key = 0;
      angular.forEach($scope.incompletestudents, function(data){
        if (student.student_upn == data.student_upn) {
          $scope.incompletestudents.splice(key, 1);
          $scope.completestudents.push(data);
        }
        key += 1;
      });

      //Add modified data
      angular.forEach($scope.hodflaggedstudents, function(data){
        if (student.student_upn == data.student_upn) {
          data.modified_since_flagged = 1;
          $scope.currentStudent.modified_since_flagged = 1;
        }
      });

    });
    inserted.$promise.then(function(data){
      //Fail
      if (data[0]) {
        $scope.errors = data[0];
        FlashService.show("Record could not be added.");
      }
    });
  }

  //Debugging
  window.scope = $scope;
});

//Modal Windows

var ModalDemoCtrl = function ($scope, $modal, $log) {

  $scope.open = function (currentStudent) {
    var modalInstance = $modal.open({
      templateUrl: 'myModalContent.html',
      controller: ModalInstanceCtrl,
      resolve: {
        currentStudent: function() {
          return currentStudent;
        }
      },
      windowClass: 'BLA'
    });

    /*modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      
    });*/
  };
};

// Please note that $modalInstance represents a modal window (instance) dependency.
// It is not the same as the $modal service used above.

var ModalInstanceCtrl = function ($scope, $modalInstance, currentStudent, $rootScope) {
  $scope.flagged_comment = currentStudent.flagged_comment;
  $scope.ok = function (comment) {
    $modalInstance.close();
    $rootScope.hodFlag(currentStudent, comment);
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
};