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
	  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Modify User Permissions</h4>
	      	<div ng-repeat="resource in resources">
					        			<label class="checkbox-inline">
								           	<?php echo \Form::checkbox("{{resource.id}}", "{{resource.id}}", "<is-resource-active></is-resource-active>"); ?>
								            {{ resource.name }}
								        </label>
					        		</div>


	      	<form class="form-horizontal style-form" ng-submit="submit()">
	        	
	        	<table class="table table-bordered table-striped table-condensed cf">
	        		<thead>
	        			<tr>
	        				<th width="20%">Name</th>
	        				<th>Permissions</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<tr ng-repeat="user in users">
	        				<td>{{user.surname}} {{user.forename}}</td>
	        				<td>
				        			<div ng-repeat="resource in resources">
					        			<label class="checkbox-inline">
					        				<input type="checkbox" name="{{resource.name}}" value="{{resource.id}}" class="is-resource-active" user="{{user.username}}">
								           	<?php //echo \Form::checkbox("{{resource.id}}", "{{resource.id}}", false); ?>
								            {{ resource.name }}
								        </label>
					        		</div>
	        				</td>
	        			</tr>
	        		</tbody>
	        	</table>	      
	      	</form>
	  </div>
	</div><!-- col-lg-12-->      	
</div>
