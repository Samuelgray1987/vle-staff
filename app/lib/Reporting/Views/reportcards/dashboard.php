<div class="row mt">
  <div class="col-lg-12">
    <div class="alert alert-warning" ng-if="flash">
      {{flash}}
    </div>
  </div>
</div>
<ol class="breadcrumb">
  <li><a ng-href="#/">Reporting</a></li>
  <li class="active">Report Cards</li>
</ol>
<div class="col-lg-12">
  <section class="panel">
    <header class="panel-heading wht-bg">
      <h4 class="gen-case">
        Current Report Collection: Year 10
          <form action="#" class="pull-right mail-src-position">
              <div class="input-append">
                <input class="form-control" type="text"  placeholder="Search Classes" ng-model="search.class"></label>
              </div>
          </form>
      </h4>
    </header>
    <div class="panel-body minimal">
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
        <table class="table table-inbox table-hover">
          <thead>
            <tr>
              <th class="text-center">Class</th>
              <th class="text-center"><i class="fa fa-group"> </i>  Number of Students</th>
              <th class="text-center"><i class="fa fa-check"> </i> Number Complete</th>
              <th class="text-center"><i class="fa fa-check"> </i> Number Confirmed</th>
              <th class="text-center"><i class="fa fa-flag"> </i> Number Flagged</th>
              <th class="text-center"><i class="fa fa-check"> </i> Finished</th>
            </tr>
          </thead>
          <tbody>
            <tr class="read" ng-repeat="class in myClasses | filter:search" ng-click="edit(class.class)">
                <td class="view-message text-center">
                    {{class.class}}
                </td>
                <td class="view-message text-center">{{class.student_count}}</td>
                <td class="view-message text-center">
                  <span class='success' ng-if="class.completed == class.student_count"><i class="fa fa-check"> </i></span>
                  {{class.completed}} 
                </td>
                <td class="view-message text-center"><a href="mail_view.html">{{class.confirmed}}</a></td>
                <td class="view-message inbox-small-cells text-center">{{class.flagged}}</td>
                <td class="view-message text-center">
                  <span class='success' ng-if="(class.completed - class.confirmed + class.flagged) / 2 == class.student_count"><i class="fa fa-check"> </i></span>
                  <span class='failure' ng-if="(class.completed - class.confirmed + class.flagged) / 2 != class.student_count"><i class="fa fa-times"> </i></span>
                </td>
            </tr>
          </tbody>
        </table>
      </div><!--panel body minimal-->
    </section><!-- End of panel -->
  </div><!--Col-12 lg-->
</div>
