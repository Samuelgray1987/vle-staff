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
  $scope.title = "Report Cards Dashboard";
  $scope.myClasses = myClasses.data;

  //Data Manipulation
  angular.forEach($scope.myClasses, function(data){
    $scope.grandTotalStudents += parseInt(data.student_count);
    $scope.grandTotalStudentsCompleted += parseInt(data.completed);
    $scope.grandTotalStudentsConfirmed += parseInt(data.confirmed);
  });

  //Functions
  $scope.edit = function(classid) {
    $location.url('/report-cards/edit-report-cards?class='+classid);
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
    $scope.grandTotalStudents += parseInt(data.student_count);
    $scope.grandTotalStudentsCompleted += parseInt(data.completed);
    $scope.grandTotalStudentsConfirmed += parseInt(data.confirmed);
  });

  //Functions

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
    $scope.grandTotalStudents += parseInt(data.student_count);
    $scope.grandTotalStudentsCompleted += parseInt(data.completed);
    $scope.grandTotalStudentsConfirmed += parseInt(data.confirmed);
  });

  //Functions

  //Debugging
  window.scope = $scope;
});
angular.module('reports-controllers').controller('EditReportCardController', function(DeleteReportCard, InsertReportCard, GetAttainmentGraphData,GetAttainmentTableData, $timeout, $location, FlashService, $scope, $rootScope, GetDataEntries, GetClassReports, CSRF_TOKEN){

  //Date
  $scope.title = "Edit Report Cards";
  $scope.class = $location.search()['class'];
  $scope.student = $location.search()['student'];
  $scope.navType="tabs";
  $scope.incompletestudents = [];
  $scope.completestudents = [];
  $scope.students = GetClassReports.get({id: $scope.class, CSRF_TOKEN: CSRF_TOKEN}, function(data){
    angular.forEach(data, function(data){
      if (data.report_completed_at === null) {
        $scope.incompletestudents.push(data);
      } else {
        $scope.completestudents.push(data);
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
    });
    deleteCard.$promise.then(function(data){
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
    });
    inserted.$promise.then(function(data){
      //Fail
      if (data[0]) {
        $scope.errors = data[0];
        FlashService.show("Record could not be added." . data.flash);
      }
    });
  }

  //Debugging
  window.scope = $scope;
});