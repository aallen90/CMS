<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Tasks &middot; YIT Works</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <link href="assets/css/bootstrap.css" rel="stylesheet">	
	<link href="assets/css/datepicker.css" rel="stylesheet">
	<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
	<!-- Le scripts -->
	<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  </head>
  <body>

<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand active" href="home">&nbsp;&nbsp;&nbsp;&nbsp;YIT Works</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
				<li><a href="home">Calendar</a></li>
				<?php if($usertype == 'client')
				{
					echo '<li><a href="invoices">Invoices</a></li>';
				}
				elseif($usertype == 'employee')
				{
					echo '<li class="active"><a href="tasks">Tasks</a></li>';
				}
				else
				{
					echo '<li class="active"><a href="tasks">Tasks</a></li>';
					echo '<li><a href="reports">Reports</a></li>';
					echo '<li><a href="terms">Term Management</a></li>';
					echo '<li><a href="users">Users</a></li>';
				}?>
            </ul>
			<ul class="nav pull-right">
				<li><a><?php echo "Welcome $firstname!";  ?></a></li>
				<li><a href="home/logout">Logout</a></li>
			</ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
<div class="container">
	<div class="row">