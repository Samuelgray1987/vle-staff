<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Printing Reports</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= asset('./app/bower_components/bootstrap/dist/css/bootstrap.css'); ?>" />

    <!-- Custom styles for this template -->
    <link href="<?= asset('./assets/printing/print.css'); ?>" rel="stylesheet">

  </head>

  <body>
    <div class="container">
    <?php $x = 0; $testIfSameStudent = ""; ?>
    @foreach ($data as $printData)
    	@if ($testIfSameStudent != $printData->upn)
    		<?php $x = 0; ?>
    	@endif
    	@if ($x == 0)
    		<?php $testIfSameStudent = $printData->upn; ?>
			<div class="row pageBreak">
		        <div class="col-xs-12">
					<img class="center-block" src="<?= asset('img/Logo.jpg'); ?>">
						<h1 class="text-center frontCover">School Report</h1>
						<h2 class="text-center frontCover"><span class="blue">Student Name: </span><br> <?php if(isset($printData->forename)) echo $printData->forename; ?> <?php if(isset($printData->surname)) echo $printData->surname; ?></h2>
						<h2 class="text-center"><span class="blue">Tutor Group: </span><br> <?php if(isset($printData->reg_group)) echo $printData->reg_group; ?></h2>
						<h2 class="text-center"><span class="blue">Year: </span><br> <?php if(isset($printData->yeargroup)) echo $printData->yeargroup; ?></h2>
				</div>
			</div>
		@endif
    	<div class="row pageBreak">
	        <div class="col-xs-8">
				<img src="<?= asset('img/Logo.jpg'); ?>">
				
				<h4>STUDENT REPORT CARD</h4>
				<br >

				<div class="row">
				
					<div class="col-xs-3">
						<p><span class="blue">Student: </span></p>
						<p><span class="blue">Registration Group: </span></p>
						<p><span class="blue">Yeargroup: </span></p>
					</div>
					
					<div class="col-xs-5">
						<p><span class="blue"><?php if(isset($printData->forename)) echo $printData->forename; ?> <?php if(isset($printData->surname)) echo $printData->surname; ?></span></p>
						<p><span class="blue"><?php if(isset($printData->reg_group)) echo $printData->reg_group; ?></span></p>
						<p><span class="blue">Year <?php if(isset($printData->yeargroup)) echo $printData->yeargroup; ?></span></p>
					</div>
					
				</div>
				
				@if ($printData->class_code != "reg_group")
					<h4>GRADES</h4>
					<hr class="report">
					
						<div class="col-xs-4">
							<p><span class="blueTitle">Target:</span><?php if(isset($printData->target)) echo $printData->target; ?></p>
						</div>
						<div class="col-xs-4">
							<p><span class="blueTitle">Predicted:</span><?php if(isset($printData->predicted)) echo $printData->predicted; ?></p>
						</div>
					<br>
				@endif
				<hr class="report">
				
				<h4>PROGRESS COMMENTS</h4>
				<br>
				<p class="schoolReports">
					<?php if(isset($printData->comment)) echo $printData->comment; ?>
				</p>
	
			</div>
		
	        <div class="col-xs-4">
				<h2 class="blue"><?php if(isset($printData->subject_name)) echo $printData->subject_name; ?></h2>
				<br>
				@if ($printData->class_code != "reg_group")
					<h4>Head of Dept:<br><span class="blue"><?php if(isset($printData->subject_hod)) echo $printData->subject_hod; ?></span></h4>
					<br>
					
					<h4>QUALIFICATION</h4>
					<p class="blue"><?php if(isset($printData->subject_qualification)) echo $printData->subject_qualification; ?></p>
					<br>
					
					<h4>COURSE OVERVIEW</h4>
					<div >
						<p class="blue schoolReports">
							<?php if(isset($printData->subject_overview)) echo $printData->subject_overview; ?>
						</p>
					</div>
				@endif
			</div>
		</div>   
		<?php $x++; ?>
	@endforeach
    </div> <!-- /container -->
  </body>
</html>
