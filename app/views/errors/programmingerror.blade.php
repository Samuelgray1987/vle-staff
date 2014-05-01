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

		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3  centered">
					<section class="panel">
						<div class="panel-body minimal">
							<img src="assets/img/500.png" alt="">
							<h1>Don't Panic</h1>
							<h3>The page you are looking for doesn't exist.</h3>
							<br>

							<h5 class="mt">Hey, maybe you will be interested in these pages:</h5>
							<p class="centered"><a href="./">Login</a></p>
						</div>	
					</section>
				</div>
			</div>
		</div>
	{{ HTML::script('./app/bower_components/jquery/jquery.min.js'); }}
	{{ HTML::script('./app/bower_components/backstretch/jquery.backstretch.min.js'); }}
    <script>
        $.backstretch("./dist/images/walbottle.jpeg", {speed: 500});
    </script>
	</body>
</html>