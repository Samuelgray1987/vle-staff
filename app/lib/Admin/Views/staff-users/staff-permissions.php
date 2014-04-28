<h3>{{ title }}</h3>

<div class="row mt">
	<div class="col-lg-12">
		<div class="alert alert-warning" ng-if="flash">
		 	{{flash}}
		</div>
	</div>
</div>
<div class="row mt">
	<div class="col-lg-12">
	  <div class="form-panel">
	  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Add a new group</h4>
	      <form class="form-horizontal style-form" ng-submit="submit()">
	          <div class="{{ errors.name ? 'form-group has-error' : 'form-group' }}">
	              <label class="col-sm-2 col-sm-2 control-label">Please enter a new group name</label>
	              <div class="col-sm-10">
	                  <input class="form-control" type="text" ng-model="name">
	                  <span ng-if="errors" class="help-block">{{errors.name}}</span>
	              </div>
	          </div>
	          <div class="{{ errors.subject_id ? 'form-group has-error' : 'form-group' }}">
	              <label class="col-sm-2 col-sm-2 control-label">If you are adding a subject add a subject id</label>
	              <div class="col-sm-10">
	                  <input class="form-control" type="text" ng-model="subject_id">
	                  <span ng-if="errors.subject_id" class="help-block">{{errors.subject_id}}</span>
	              </div>
	          </div>
	          <button type="submit" class="btn btn-theme">Add Group</button>
	      </form>
	  </div>
	</div><!-- col-lg-12-->      	
</div>
<br>
<div class="row mt">
	<div class="col-lg-12">
		<div class="form-panel">
			<div class="form-horizontal style-form">
	            <div class="form-group">
	                  <label class="col-sm-2 col-sm-2 control-label">Search by subject</label>
	                  <div class="col-sm-10">
	                      <input class="form-control" placeholder="Search by subject" type="text" ng-model="search.$">
	                  </div>
	            </div>
          	</div>
      	</div>
	</div>
</div>
<br>
<div class="col-lg-12">
	<div>
	  <tabset>
	    <tab heading="Active Groups">
	    	<div class="content-panel">
	            <section id="no-more-tables">
	                <table class="table table-bordered table-striped table-condensed cf">
	                  <thead class="cf">
		                  <tr>
		                      <th width="33%">Name</th>
		                      <th width="33%">Subject Code</th>
		                      <th width="33%">Delete</th>
		                      <th width="33%">Edit</th>
		                  </tr>
	                  </thead>
	                  <tbody>
		                  <tr ng-repeat="group in groups | filter:search">
		                      <td data-title="Forename">{{group.name}}</td>
		                      <td data-title="Forename">{{group.subject_id}}</td>
		                      <td data-title="Delete"><a class="btn btn-danger" ng-click="deleteGroup(group.id, group.name, $index)">Delete</a></td>
		                      <td data-title="Edit"><a class="btn btn-info" ng-href="#/users-permissions-edit-group/{{group.id}}">Edit</a></td>
		                  </tr>
	                  </tbody>
		            </table>
		        </section>
		    </div><!-- /content-panel -->
	    </tab>
	    <tab heading="Inactive Groups">
	    	<div class="content-panel">
	            <section id="no-more-tables">
	                <table class="table table-bordered table-striped table-condensed cf">
	                  <thead class="cf">
		                  <tr>
		                      <th width="50%">Name</th>
		                  </tr>
	                  </thead>
	                  <tbody>
		                  <tr ng-repeat="group in inactiveGroups">
		                      <td data-title="Forename">{{group.name}}</td>
		                  </tr>
	                  </tbody>
		            </table>
		        </section>
		    </div><!-- /content-panel -->
	    </tab>
	  </tabset>
	</div>
  </div><!-- /col-lg-12 -->
</div>