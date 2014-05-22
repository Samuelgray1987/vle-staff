<div class="row mt">
  <div class="col-lg-12">
    <div class="alert alert-warning" ng-if="flash">
      {{flash}}
    </div>
  </div>
</div>
<ol class="breadcrumb">
  <li class="active">Printing</li>
</ol>

 <div class="col-md-3 col-lg-3">
    <section class="panel">
      <div class="panel-body">
        <span ng-if="attainmentOptions">
        <select class="form-control" ng-model="attainmentSelection">
          <option ng-repeat="attainment in attainmentOptions" value="{{attainment.date}}">{{attainment.date}}</option>
        </select>
        <br>
        
          <a href="" ng-click="generateReport(attainmentSelection)" class="btn btn-compose">
              <span ng-show="loading">
                <img src="<?php echo asset('./img/712.GIF'); ?>" width="15px" height="15px" />
                Loading reports please wait...
              </span>   
                <span ng-if="!loading">Generate reports for year {{ yeargroup }}</span>
          </a>
        </span>
        <ul class="nav nav-pills nav-stacked mail-nav">
          <li ng-repeat="yeargroup in studentYeargroups">
            <a ng-click="changeYeargroup(yeargroup.yeargroup, yeargroup.year)" href="">
              Year {{yeargroup.yeargroup}}
            </a>
          </li>
        </ul>   
      </div><!-- panel-body-->  
    </section><!--panel-->
  </div>

  <div class="col-md-9 col-lg-9">
    <section class="panel">
      <header class="panel-heading wht-bg">
        <h4 class="gen-case">
          {{title}} <small><br>Current Report Collection: Year {{yeargroup}}</small>
            <form action="#" class="pull-right mail-src-position">
                <div class="input-append">
                  <input class="form-control" type="text"  placeholder="Search reg groups etc" ng-model="search.$"></label>
                </div>
            </form>
        </h4>
        <a href="./reports-printing/printview?yeargroup={{yeargroup}}" class="btn btn-info" target="_blank">View Print Version</a>
      </header>
      <div class="panel-body minimal">
        <div ng-if="myClasses.error" class="alert alert-info">
          {{myClasses.error}}
        </div>
          <table class="table table-inbox table-hover">
            <thead>
              <tr>
                <th class="text-center"><i class="fa fa-group"> </i><a href="" ng-click="reverse = predicate == 'surname' && !reverse; predicate = 'surname'"> Student name</a></th>
                <th class="text-center"><a href="" ng-click="reverse = predicate == 'number_errors' && !reverse; predicate = 'number_errors'">Number of errors</a></th>
                <th class="text-center"><a href="" ng-click="reverse = predicate == 'student_count' && !reverse; predicate = 'student_count'">Subjects with errors</a></th>
                <th class="text-center"><a href="" ng-click="reverse = predicate == 'reg_group' && !reverse; predicate = 'reg_group'"> Reg group</a></th>
                <th class="text-center"><i class="fa fa-asterisk"> </i><a href="" ng-click="reverse = predicate == 'upn' && !reverse; predicate = 'upn'"> UPN</a></th>
              </tr>
            </thead>
            <tbody>
              <tr class="read" ng-repeat="report in reports | filter:search | orderBy:predicate:reverse" ng-click="open(report.upn, report.surname, report.forename)">
                  <td class="view-message text-center">
                      {{report.surname}} {{report.forename}}
                  </td>
                  <td class="view-message text-center">{{report.number_errors}}</td>
                  <td class="view-message text-center">
                    {{report.number_subjects}} 
                  </td>
                  <td class="view-message text-center"><a href="mail_view.html">{{report.reg_group}}</a></td>
                  <td class="view-message inbox-small-cells text-center">{{report.upn}}</td>
              </tr>
            </tbody>
          </table>
        </div><!--panel body minimal-->
      </section><!-- End of panel -->
    </div><!--Col-12 lg-->
</div>

<script type="text/ng-template" id="myModalContent.html">
<section class="panel">
  <header class="panel-heading wht-bg">
      <h4 class="gen-case">
        {{forename}} {{surname}}
        <a href="">
          <i class="pull-right fa fa-minus-square" ng-click="cancel()"> </i>
        </a>
      </h4>
  </header>
  <div class="panel-body minimal">
    <table class="table table-inbox table-hover">
      <thead>
        <tr>
          <th>Subject</th>
          <th>Errors</th>
      </thead>
      <tbody>
        <tr ng-repeat="error in errors">
          <td>{{error.subject_name}}</td>
          <td>{{error.errors}}</td>
        </tr>
    </table>
  </div>
</section>
</script>


