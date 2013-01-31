<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Administration &middot; YIT Works</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="assets/css/fullcalendar.css" rel="stylesheet">
<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="assets/css/datepicker.css" rel="stylesheet">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Le scripts -->
<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			events: [
				{
					title: 'All Day Project',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Task',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Task',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Task',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch with Client',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Christmas Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				}
			]
		});
		
	});


</script>	
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
          <a class="brand" href="#">&nbsp;&nbsp;&nbsp;&nbsp;YIT Works</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
				<li class="active"><a href="#">Calendar</a></li>
				<?php if($usertype == 'client')
				{
					echo '<li><a href="invoices">Invoices</a></li>';
				}
				elseif($usertype == 'employee')
				{
					echo '<li><a href="tasks">Tasks</a></li>';
				}
				else
				{
					echo '<li><a href="tasks">Tasks</a></li>';
					echo '<li><a href="reports">Reports</a></li>';
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
		<div class="span8"><div id='calendar'></div></div>