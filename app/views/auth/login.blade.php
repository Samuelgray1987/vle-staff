<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
	<meta charset="UTF-8">
	<title>Walbottle Campus - Staff VLE</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
	    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	    <!-- build:css styles/vendor.css -->
	    <!-- bower:css -->
	    <link rel="stylesheet" href="<?= asset('./app/bower_components/bootstrap/dist/css/bootstrap.css'); ?>" />
	    <!-- endbower -->
	    <!-- endbuild -->

		<!--external css-->
		<link href="<?= asset('./assets/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="<?= asset('./assets/css/zabuto_calendar.css'); ?>">
	    <link rel="stylesheet" type="text/css" href="<?= asset('./assets/js/gritter/css/jquery.gritter.css'); ?>" />
    
    	<!-- Custom styles for this template -->
    	<link href="<?= asset('./assets/css/style.css'); ?>" rel="stylesheet">
    	<link href="<?= asset('./assets/css/style-responsive.css'); ?>" rel="stylesheet">
	    <!-- endbuild -->	
	<script>
		angular.module("app").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>');
	</script>
</head>
	<body>

		<div id="login-page">
			<div class='container'>
				<div class="row">
					
					<div class="lg-12-col">
						@if(Session::has('success'))
							<div class="alert alert-success">
					        	{{ Session::get('success') }}
							</div>
						@endif
					</div>
				</div>
				<div class="account-wall">
				    {{ Form::open(['url' => 'auth/login', 'class' => 'form-login']) }}
				    	<h2 class="form-login-heading">Sign in to the staff area</h2>
				    	<div class="login-wrap">
				    		<div class="lg-12-col">
								@if(Session::has('error'))
									<div class="alert alert-warning">
							        	{{ Session::get('error') }}
									</div>
								@endif
							</div>
				    		<input type="text" name="username" class="form-control" placeholder="username" required autofocus/>
				    		<br>
				     		<input type="password" name="password" class="form-control" placeholder="password" required/>
				     		<br>
				     		<button class="btn btn-theme btn-block" type="submit">Sign in</button>
				    	</div><!--.login-wrap-->						    	
				    </form>
				</div>
			</div><!--.container-->
		</div><!--#login-page-->
	{{ HTML::script('./app/bower_components/jquery/jquery.min.js'); }}
	{{ HTML::script('./app/bower_components/backstretch/jquery.backstretch.min.js'); }}
    <script>
        $.backstretch("./dist/images/walbottle.jpeg", {speed: 500});
    </script>
	</body>
</html>