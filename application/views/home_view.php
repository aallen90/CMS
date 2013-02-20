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
$(document).ready(function () {
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
		<?php
		foreach ( $emps as $emp )
		{
			foreach ( $tasks as $task )
			{
				if ( $task->tech == $emp->username )
				{
		?>
					{
						title: '<?php echo $emp->firstname, ' - ', substr($task->description, 0, 5), '...'; ?>',
						start: '<?php echo $task->activation; ?>'                        // need to integrate time columns and make the dayclick() event change side tasks
					},
				<?php
				} //$task->tech == $emp->username
			} //$tasks as $task
		} //$emps as $emp
		?>
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