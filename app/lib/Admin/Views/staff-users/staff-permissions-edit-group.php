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
	  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Edit a group</h4>
	      <form class="form-horizontal style-form" ng-submit="submit()">
	          <div class="{{ errors ? 'form-group has-error' : 'form-group' }}">
	              <label class="col-sm-2 col-sm-2 control-label">Please enter a new group name</label>
	              <div class="col-sm-10">
	                  <input class="form-control" type="text" ng-model="name">
	                  <span ng-if="errors" class="help-block">{{errors.name}}</span>
	              </div>
	          </div>
	          <button type="submit" class="btn btn-theme">Add Group</button>
	      </form>
	  </div>
	</div><!-- col-lg-12-->      	
</div>
