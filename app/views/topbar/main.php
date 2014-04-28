<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                <i class="fa fa-google-plus"></i>
                <!-- <span class="badge bg-theme">2</span> -->
            </a>
            <ul class="dropdown-menu extended tasks-bar">
                <div class="notify-arrow notify-arrow-green"></div>
                <li>
                    <p class="green">Your Google Area</p>
                </li>
                <li>
                    <a href="<?= Session::get('realsmart'); ?>&returnUrl=https://docs.google.com/a/walbottlecampus.net/" target="_new">
                        <div class="task-info">

                            <div class="desc"><img src="./assets/logos/drive.png" /> Google Drive</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= Session::get('realsmart'); ?>&returnUrl=https://mail.google.com/a/walbottlecampus.net/" target="_new">
                        <div class="task-info">
                            <div class="desc"><img src="./assets/logos/gmail.png" /> Google Mail</div>
                        </div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- settings end -->   
    </ul>
    <!--  notification end -->
</div>
<ul class="nav pull-right top-menu">
<?php
	foreach (Auth::user()->groups as $group)
    {
        foreach ($group->resources as $resource)
        {
        	if($resource->pattern == 'reports') $links['reports'] =  \Request::segment(1) == "reports" ? '<li><a class="apps active" href="reports#/">Reports</a></li>' : '<li><a class="apps" href="./reports#/">Reports</a></li>';
        	if($resource->pattern == 'admin') $links['admin'] = \Request::segment(1) == "admin" ? '<li><a class="apps active" href="admin#/">Admin</a></li>' : '<li><a class="apps" href="./admin#/">Admin</a></li>';
        }
    }
	if ($links['admin']) echo $links['admin'];
	if ($links['reports']) echo $links['reports'];
?>
	<li><a class="logout" href="/auth/logout">Logout</a></li>
</ul>