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
	<!--<script>
		angular.module("app").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>');
	</script>-->
</head>
	<body>
		      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>Walbottle Campus<span> Reports</span></b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme">4</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 4 pending tasks</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Dashio Admin Panel</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Database Update</div>
                                        <div class="percent">60%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Product Development</div>
                                        <div class="percent">80%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Payments Sent</div>
                                        <div class="percent">70%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            <span class="sr-only">70% Complete (Important)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme">5</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 5 new messages</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-zac.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Zac Snider</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hi mate, how is everything?
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-divya.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Divya Manian</span>
                                    <span class="time">40 mins.</span>
                                    </span>
                                    <span class="message">
                                     Hi, I need your help with this.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-danro.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dan Rogers</span>
                                    <span class="time">2 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Love your new Dashboard.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-sherman.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dj Sherman</span>
                                    <span class="time">4 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Please, answer asap.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">See all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-bell-o"></i>
                            <span class="badge bg-warning">7</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-yellow"></div>
                            <li>
                                <p class="yellow">You have 7 new notifications</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                    Server Overloaded.
                                    <span class="small italic">4 mins.</span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="label label-warning"><i class="fa fa-bell"></i></span>
                                    Memory #2 Not Responding.
                                    <span class="small italic">30 mins.</span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                    Disk Space Reached 85%.
                                    <span class="small italic">2 hrs.</span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="label label-success"><i class="fa fa-plus"></i></span>
                                    New User Registered.
                                    <span class="small italic">3 hrs.</span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">See all notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
            		<li><a class="apps" href="admin#/">Admin</a></li>
            		<li><a class="apps" href="lessons#/">Lessons</a></li>
            		<li><a class="apps" href="reports#/">Reports</a></li>
                    <li><a class="logout" href="/auth/logout">Logout</a></li>
            	</ul>
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
                      <a class="active" href="index.html">
                          <i class="fa fa-dashboard"></i>
                          <span>Student Reports</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>UI Elements</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="general.html">General</a></li>
                          <li><a  href="buttons.html">Buttons</a></li>
                          <li><a  href="panels.html">Panels</a></li>
                          <li><a  href="font_awesome.html">Font Awesome</a></li>
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
            <div class="row">
                <div id="view" ng-view></div>
            </div>
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
        <script src='<?= asset('./angular/app/app.js'); ?>'></script>
        <!-- Common files -->
            <script src='<?= asset('./angular/app/common/services/index.js') ?>'></script>
        <!-- Dashboard Files -->
            <script src='<?= asset('./angular/app/dashboard/index.js') ?>'></script>
            <script src='<?= asset('./angular/app/dashboard/services/services.js') ?>'></script>
            <script src='<?= asset('./angular/app/dashboard/controllers/dashboard.js') ?>'></script>
        <!-- Profile Files -->
            <script src='<?= asset('./angular/app/profile/index.js') ?>'></script>
            <script src='<?= asset('./angular/app/profile/services/services.js') ?>'></script>
            <script src='<?= asset('./angular/app/profile/controllers/profile.js') ?>'></script>
	

	</body>
</html>