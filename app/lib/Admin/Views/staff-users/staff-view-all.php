<h3>{{ title }}</h3>
<div class="row mt">
	<div class="col-lg-12">
		<div class="form-panel">
			<div class="form-horizontal style-form" method="get">
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
	<div>
	  <tabset>
	    <tab heading="Active Staff Users">
	    	<div class="content-panel">
	            <section id="no-more-tables">
	                <table class="table table-bordered table-striped table-condensed cf">
	                  <thead class="cf">
		                  <tr>
		                      <th width="17%">Forename</th>
		                      <th width="17%">Surname</th>
							  <th width="17%">Username</th>
		                      <th width="17%">Upn</th>
		                      <th width="17%">Delete</th>
		                      <th width="17%">Edit</th>
		                  </tr>
	                  </thead>
	                  <tbody>
		                  <tr ng-repeat="user in staffUsers | filter:search">
		                      <td data-title="Forename">{{user.forename}}</td>
		                      <td data-title="Surname">{{user.surname}}</td>
		                      <td data-title="Username">{{user.username}}</td>
		                      <td data-title="Upn">{{user.upn}}</td>
		                      <td data-title="Delete User"><a>Delete</a></td>
		                      <td data-title="Edit User"><a>Edit</a></td>
		                  </tr>
	                  </tbody>
		            </table>
		        </section>
		    </div><!-- /content-panel -->
	    </tab>
	    <tab heading="Inactive Staff Users">
	    	<div class="content-panel">
	            <section id="no-more-tables">
	                <table class="table table-bordered table-striped table-condensed cf">
	                  <thead class="cf">
		                  <tr>
		                      <th width="17%">Forename</th>
		                      <th width="17%">Surname</th>
							  <th width="17%">Username</th>
		                      <th width="17%">Upn</th>
		                      <th width="17%">Delete</th>
		                      <th width="17%">Edit</th>
		                  </tr>
	                  </thead>
	                  <tbody>
		                  <tr ng-repeat="user in staffInactiveUsers | filter:search">
		                      <td data-title="Forename">{{user.forename}}</td>
		                      <td data-title="Surname">{{user.surname}}</td>
		                      <td data-title="Username">{{user.username}}</td>
		                      <td data-title="Upn">{{user.upn}}</td>
		                      <td data-title="Delete User"><a >Delete</a></td>
		                      <td data-title="Edit User"><a >Edit</a></td>
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