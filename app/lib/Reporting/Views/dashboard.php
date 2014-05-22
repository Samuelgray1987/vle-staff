<h1>{{title}}</h1>
<ol class="breadcrumb">
  <li><a ng-href="#/">Reporting</a></li>
  <li class="active">Report Cards</li>
</ol>
<h3>My Classes</h3>
<div class="row">
  <div class="col-md-6 mb">
    <label>Search by class: 
      <input type="text" ng-model="search.$"></label>
  </div>
</div>

<!--
  Admin
 <div class="row">
  <div class="col-md-4 mb">
    <div class="weather-3 pn centered">
      <i class="fa fa-users"></i>
      <h1>{{grandTotalStudents}} Students</h1>
      <div class="info">
        <div class="row">
            <h3 class="centered">{{ ( grandTotalStudentsCompleted / grandTotalStudents ) * 100 | number:2}}% Completed</h3>
          <div class="col-sm-12 col-xs-12">
            <p><i class="fa fa-clock"></i><small> <span my-current-time></span></small></p>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  
  <div class="col-md-3 mb" ng-repeat="class in myClasses | filter:search">
    <!-- WHITE PANEL - TOP USER -->
    <div class="content-panel pn get-class-report-details" classid="{{ class.class }}" >
      <div id="profile-01" class="{{panelBackground}}">
        <h3>{{ class.class }}</h3>
        <h6>{{ studentsInClass }} Students</h6>
      </div>
      <a class="profile centered" href="#/report-cards/edit-report-cards">
        Add/Edit Reports
      </a>
      <div class=" col-md-6 centered">
        <h6><i class="fa fa-check"></i><br>{{ reportsCompleted }} Reports Complete</h6>
      </div> 
      <div class=" col-md-6 centered">
        <h6><i class="fa fa-check"></i><br>{{ reportsConfirmed }} Confirmed by manager</h6>
      </div> 
    </div>
  </div>
</div>
