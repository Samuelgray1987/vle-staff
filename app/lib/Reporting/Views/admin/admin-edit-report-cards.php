<ol class="breadcrumb">
  <li><a ng-href="#/{{linkBack}}">Reporting</a></li>
  <li><a ng-href="#/{{linkBack}}">{{ linkText }}</a></li>
  <li class="active">Edit {{class}} Report Cards</li>
</ol>
<h3>{{class}} - {{students[0].staff_name}}</h3>
<div class="row">
<!-- **********************************************************************************************************************************************************
LEFT SIDEBAR CONTENT
*********************************************************************************************************************************************************** -->                  
  <div class="col-md-4 col-lg-4">
    <section class="panel">
      <header class="panel-heading wht-bg">
        <input class="form-control " placeholder="Search Students" type="text" ng-model="search.$">
      </header>
      <div class="panel-body">
        <tabset type="navType">
          <tab heading="Students ({{students.length}})">   
            <!-- First student -->
            <ul class="nav nav-pills nav-stacked mail-nav">
              <li ng-repeat="student in students | filter:search">
                <a ng-click="selectStudent(student)" href="">
                  <img src="//placekitten.com/25/25" class="img-circle" width="25"> 
                  &nbsp;{{student.student_forename}} {{student.student_surname}} 
                  <small ng-if="student.management_confirmed_at" class=" pull-right"><i class="fa fa-check success"> </i>Confirmed</small>
                  <small ng-if="student.management_flagged_at" class=" pull-right"><i class="fa fa-flag failure"> </i> <i ng-if="student.modified_since_flagged" class="fa fa-asterisk"> </i>Flagged</small>
                  <small ng-if="student.report_created_at == null" class=" pull-right"> No Report Available</small>
                  <small ng-if="student.report_created_at != null && student.management_confirmed_at == null && student.management_flagged_at == null" class=" pull-right"><i  class="fa fa-bookmark failure"> </i> Awaiting Review</small>
                </a>
              </li>
            </ul>   
            <!-- End of students -->
          </tab>
          <tab heading="Confirmed ({{hodcompletestudents.length}})">
            <ul class="nav nav-pills nav-stacked mail-nav">
              <li ng-repeat="student in hodcompletestudents | filter:search">
                <a ng-click="selectStudent(student)" href="">
                  <img src="//placekitten.com/25/25" class="img-circle" width="25"> 
                  &nbsp;{{student.student_forename}} {{student.student_surname}}
                  <small ng-if="student.management_confirmed_at" class=" pull-right"><i class="fa fa-check success"> </i>Confirmed</small>
                  <small ng-if="student.management_flagged_at" class=" pull-right"><i class="fa fa-flag failure"> </i> <i ng-if="student.modified_since_flagged" class="fa fa-asterisk"> </i>Flagged</small>
                  <small ng-if="student.report_created_at == null" class=" pull-right"> No Report Available</small>
                  <small ng-if="student.report_created_at != null && student.management_confirmed_at == null && student.management_flagged_at == null" class=" pull-right"><i  class="fa fa-bookmark failure"> </i> Awaiting Review</small>
                </a>
              </li>
            </ul> 
          </tab>
          <tab heading="Flags ({{hodflaggedstudents.length}})">
            <ul class="nav nav-pills nav-stacked mail-nav">
              <li ng-repeat="student in hodflaggedstudents | filter:search">
                <a ng-click="selectStudent(student)" href="">
                  <img src="//placekitten.com/25/25" class="img-circle" width="25"> 
                  &nbsp;{{student.student_forename}} {{student.student_surname}}
                  <small ng-if="student.management_confirmed_at" class=" pull-right"><i class="fa fa-check success"> </i>Confirmed</small>
                  <small ng-if="student.management_flagged_at" class=" pull-right"><i class="fa fa-flag failure"> </i> <i ng-if="student.modified_since_flagged" class="fa fa-asterisk"> </i>Flagged</small>
                  <small ng-if="student.report_created_at == null" class=" pull-right"> No Report Available</small>
                  <small ng-if="student.report_created_at != null && student.management_confirmed_at == null && student.management_flagged_at == null" class=" pull-right"><i  class="fa fa-bookmark failure"> </i> Awaiting Review</small>
                </a>
              </li>
            </ul> 
          </tab>
        </tabset>
      </div><!-- panel-body-->  
    </section><!--panel-->
  </div>

<!-- **********************************************************************************************************************************************************
MAINT CONTENT
*********************************************************************************************************************************************************** -->  
  <div class="col-md-8 col-lg-8">
    <section class="panel">
      <header class="panel-heading grn-bg">
         <h4 class="gen-case"><img src="//placekitten.com/50/50" class="img-circle" width="50"> &nbsp; 
          {{currentStudent.student_forename}} {{currentStudent.student_surname}} 
          <i ng-if="currentStudent.management_flagged_at" class="  fa fa-flag"> </i> 
          <i ng-if="currentStudent.modified_since_flagged" class="  fa fa-asterisk"> </i>
        </h4>
      </header>
      <div class="panel-body minimal">
        <tabset>
          <tab heading="Report Card">
            <section class="panel">
              <!--Student selected -->
              <div ng-if="currentStudent != undefined">
                <form ng-submit="updateReportCard(currentStudent)">
                  <div class="panel-body">          
                      <div class="compose-mail">
                        <div ng-if="currentStudent.management_flagged_at">
                          <!-- Flagged Comment-->
                          <div ng-if="currentStudent.modified_since_flagged" class="alert alert-info">
                            <i class="fa fa-asterisk"> </i> Modified by member of staff since flagged.
                          </div>
                          <div class="alert alert-danger">
                            <i class="fa fa-flag"> </i> Flagged - {{ currentStudent.flagged_comment }}
                          </div>
                          <!--Flagged Comment -->
                        </div>
                        <div class="form-group">
                          <div text-angular="text-angular" name="htmlcontent" ng-model="currentStudent.report_comment" ta-disabled='disabled' ></div>
                        </div>
                        <div class="characters-used">
                          <small>{{currentStudent.report_comment.length}} / 2000</small>
                        </div>
                        <div class="alert alert-info" ng-if="flash">
                          {{flash}}
                        </div>
                        <div class="compose-btn">
                          
                          <!-- <button type="button" class="btn btn-sm btn-theme04" ng-click="hodFlag(currentStudent)"><i class="fa fa-flag"></i> Flag report</button> -->
                          <!-- Flagging Modal -->
                            <div ng-controller="ModalDemoCtrl">
                                <script type="text/ng-template" id="myModalContent.html">
                                  <div class="white-panel">
                                    <div class="white-header">
                                        <h3>Add a flag description <i class="fa fa-flag"> </i></h3>
                                    </div>
                                    <div class="modal-body">  
                                      <div class="row">
                                        <textarea cols="80" rows="10" name="flagged_comment" ng-model="flagged_comment"></textarea>
                                      </div>
                                      <div class="row">
                                        <br>
                                        <button ng-if="flagged_comment" class="btn btn-sm btn-theme04" ng-click="ok(flagged_comment)">Confirm and Flag</button>
                                        <button ng-if="!flagged_comment" disabled="disabled" class="btn btn-sm btn-theme04">Confirm and Flag (please add a description)</button>
                                        <button class="btn btn-sm btn-theme02" ng-click="cancel()">Cancel</button>
                                      </div>
                                    </div>
                                  </div>
                                </script>
                                <button type="button" class="btn btn-sm btn-theme03" ng-click="hodComplete(currentStudent)"><i class="fa fa-check"></i> Correct and complete</button>
                                <button type="button" class="btn btn-sm btn-theme04" ng-click="open(currentStudent)"><i class="fa fa-flag"></i> Flag report</button>
                            </div>
                          <!-- END Flagging Modal -->
                        </div>
                      </div>
                  </div>
                </form>            
              </div>
              <!--.Student selected -->

              <!--Student not yet selected -->
              <div ng-if="currentStudent == undefined">
                <header class="panel-heading wht-bg">
                  <h4 class="gen-case">Please select a student</h4>
                </header>
              </div>
              <!--.Student not yet selected -->

            </section>     
          </tab>
          <tab ng-repeat="tab in tabs" heading="{{tab.title}}" ng-click="drawGraph(tab)">
            <section class="panel">
            <header class="panel-heading wht-bg">
               <h4 class="gen-case"> Attainment in {{tab.title}} for {{currentStudent.student_forename}} {{currentStudent.student_surname}}</h4>
            </header>
              <div id="{{tab.graphid}}"></div>
              <div id="{{tab.tableid}}"></div>
            </section>
          </tab>
        </tabset>
      </div><!--panel body-->
    </section><!--panel-->
  </div>

</div>