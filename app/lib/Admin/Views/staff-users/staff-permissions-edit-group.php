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
			<h4 class="mb"><i class="fa fa-angle-right"></i> Edit the {{group[0].name}} Group</h4>
			<div class="form-horizontal style-form">
				<div class="form-group">
		              <label class="col-sm-2 col-sm-2 control-label">Add or remove resources for the group</label>
		              <div class="col-sm-10">
		              	  <div class="checkbox" ng-repeat="resource in resources">
							  <label>
							    <input value="{{resource.id}}" type="checkbox" class="is-resource-active" resource="{{resource.id}}" group="{{group[0].id}}" ng-click="editResource(group[0].id, resource.id)">
							    {{resource.name}}
							  </label>
							</div>
		              </div>
	            </div>
	            <div class="form-group">
	                  <label class="col-sm-2 col-sm-2 control-label">Forename</label>
	                  <div class="col-sm-10">
	                      <input class="form-control" placeholder="Search by forename" type="text" ng-model="search.forename">
	                  </div>
	            </div>
	            <div class="form-group">
	                  <label class="col-sm-2 col-sm-2 control-label">Surname</label>
	                  <div class="col-sm-10">
	                      <input class="form-control" placeholder="Search by surname" type="text" ng-model="search.surname">
	            	   </div>
	            </div>
	            <div class="form-group">
	                  <label class="col-sm-2 col-sm-2 control-label">Search UPN, Username</label>
	                  <div class="col-sm-10">
	                      <input class="form-control" placeholder="Search by Upn or username" type="text" ng-model="search.$">
	                  </div>
	            </div>
          </div>
      	</div>
	</div>
</div>

<div class="row mt">
	<div class="col-lg-12">
	  <div class="form-panel">	          
          <h4 class="mb">Users</h4>
	          <table class="table table-bordered table-striped table-condensed cf">
	          	<thead>
	          		<tr>
	          			<th>Member of staff</th>
	          			<th>UPN</th>
	          			<th>Grant permission</th>
	          		</tr>
	          	</thead>
	          	<tbody>
	          		<tr ng-repeat="user in users | filter:search">
	          			<td>{{user.forename}} {{user.surname}}</td>
	          			<td>{{user.upn}}</td>
	          			<td><input type="checkbox" class="is-user-active" user="{{user.username}}" group="{{group[0].id}}" permissiongranted="{{user.checked}}" ng-click="editUserPermissions(group[0].id, user.username)"></td>
	          		</tr>
	          	</tbody>
	          </table>
	  </div>
	</div><!-- col-lg-12-->      	
</div>
