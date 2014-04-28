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
</head>
	<body>
		      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="/admin#/" class="logo"><b>Walbottle Campus<span> Admin</span></b></a>
            <!--logo end-->

            <div class="top-menu">
                <?= $__env->make('topbar.main', array_except(get_defined_vars(), array('__data', '__path'))); ?>
            </div>
        </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="//placekitten.com/100/100" class="img-circle" width="80"></a></p>
              	  <h5 class="centered"><?= \Auth::user()->forename; ?> <?= \Auth::user()->surname; ?></h5>
              	  	
                  <li class="mt">
                      <a class="active" href="/admin#/">
                          <i class="fa fa-dashboard"></i>
                          <span>Admin Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Users</span>
                      </a>
                      <ul class="sub">
                          <li><a ng-href="#/users-permissions">Permission Groups</a></li>
                          <li><a ng-href="#/users-staff">View Staff Users</a></li>
                          <li><a ng-href="#/users-student">View Student Users</a></li>
                          <li><a ng-href="#/users-staff-add">Add a Staff User</a></li>
                          <li><a ng-href="#/users-student-add">Add a Student User</a></li>
                      </ul>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

       <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <section id="main-content">
        <section class="wrapper">
            <div id="view" ng-view></div>
        </section>
      </section>
      <!-- MAIN CONTENT end-->

      <footer class="site-footer">
          <div class="text-center">
              2014 - Walbottle Campus &copy;
          </div>
      </footer>

    <!-- Angular JS Dependencies -->
        <script src="<?= asset('./app/bower_components/jquery/jquery.js'); ?>"></script>
        <script src="<?= asset('./app/bower_components/angular/angular.js'); ?>"></script>
        <script src="<?= asset('./app/bower_components/bootstrap/dist/js/bootstrap.js'); ?>"></script>
        <script src="<?= asset('./app/bower_components/angular-resource/angular-resource.js'); ?>"></script>
        <script src="<?= asset('./app/bower_components/angular-cookies/angular-cookies.js'); ?>"></script>
        <script src="<?= asset('./app/bower_components/angular-sanitize/angular-sanitize.js'); ?>"></script>
        <script src="<?= asset('./app/bower_components/angular-route/angular-route.js'); ?>"></script>
        <script src="<?= asset('./app/bower_components/angular-bootstrap/ui-bootstrap-tpls.js'); ?>"></script>

    <!-- Dashboard JS Theme Dependencies -->

        <script src="<?= asset('./app/bower_components/jquery/jquery.min.js'); ?>"></script>
        <script src="<?= asset('./app/bower_components/jquery-ui/ui/minified/jquery-ui.min.js'); ?>"></script>
        <script src="<?= asset('./app/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= asset('./assets/js/jquery.dcjqaccordion.2.7.js'); ?>"></script>
        <script src="<?= asset('./assets/js/jquery.scrollTo.min.js'); ?>"></script>
        <script src="<?= asset('./assets/js/jquery.nicescroll.js'); ?>" type="text/javascript"></script>
        <script src="<?= asset('./assets/js/jquery.sparkline.js'); ?>"></script>
    <!--common script for all pages-->
        <script src="<?= asset('./assets/js/common-scripts.js'); ?>"></script>
        <script type="text/javascript" src="<?= asset('./assets/js/gritter/js/jquery.gritter.js'); ?>"></script>
        <script type="text/javascript" src="<?= asset('./assets/js/gritter-conf.js'); ?>"></script>
    <!--script for this page-->
        <script src="<?= asset('./assets/js/sparkline-chart.js'); ?>"></script>    
        <script src="<?= asset('./assets/js/zabuto_calendar.js'); ?>"></script>	

    <!-- Charting Dependencies -->
        <script type="text/javascript" src="//www.google.com/jsapi"></script>
    <!-- Angular Project Includes -->
        <script src='<?= asset('./angular/app/admin/app.js'); ?>'></script>
        <!-- Common files -->
            <script src='<?= asset('./angular/app/common/services/index.js') ?>'></script>
            <script src='<?= asset('./angular/app/common/controllers/common-ctrl.js') ?>'></script>
            <script src='<?= asset('./angular/app/common/filters/filter.js') ?>'></script>
        <!-- Users Files -->
            <script src='<?= asset('./angular/app/admin/users/index.js') ?>'></script>
            <script src='<?= asset('./angular/app/admin/users/services/services.js') ?>'></script>
            <script src='<?= asset('./angular/app/admin/users/controllers/users.js') ?>'></script>
            <script src='<?= asset('./angular/app/admin/users/directives/directives.js') ?>'></script>	
            <script>
                angular.module("app").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>');
            </script>

	</body>
</html>