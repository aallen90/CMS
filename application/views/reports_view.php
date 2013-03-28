<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reports &middot; YIT Works</title>
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
	<script>
$(document).ready(function () { 
   $('#getreport').click(function(e){
        e.preventDefault();
        //e.stopPropagation();
        getreports();
   });
});
function getreports() {
	$('#getreport').text('Loading');
	var firstdate = $('#dp1').val();
	var seconddate = $('#dp2').val();
	if (firstdate != "" && seconddate != "" && firstdate != seconddate)
	{
		var url = 'reports/showservicelogrange/' + firstdate + '/' + seconddate;
		$.post(url, function(json) {
				$('#servicelogs').html(json);
		});
	}
	else if (firstdate != "" && seconddate == "")
	{
		$('#servicelogs').html('<h5>Please Select a finish date</h5><br><br><br><br><br><br><br><br><br><br><br><br><br><br>');
	}
	else if (firstdate == "" && seconddate != "")
	{
		$('#servicelogs').html('<h5>Please Select a Start date</h5><br><br><br><br><br><br><br><br><br><br><br><br><br><br>');
	}
	else
	{
		$('#servicelogs').html('<h5>Please Select a Start and Finish date</h5><br><br><br><br><br><br><br><br><br><br><br><br><br><br>');
	}
	$('#getreport').text('Get report!');
}

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
					echo '<li><a href="tasks">Tasks</a></li>';
					echo '<li class="active"><a href="reports">Reports</a></li>';
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
		<div class="span12">
			<h2>Reports</h2>
			<h4>Tasks to Verify</h4>
			<table class="table table-hover table-bordered">
			<thead>
				<th>Start</th>
				<th>Finish</th>
				<th>Client</th>
				<th>Tech</th>
				<th>Hours</th>
				<th>Category</th>
				<th>Description</th>
				<th>Verify</th>
			</thead>
			<tbody>
			<?php foreach($tasks as $task)
			{
				if( $task->status == 'completed' )
				{
					?>
					<tr>
					<td><?php echo $task->activation, ' ', DATE("g:i A", STRTOTIME("$task->starttime")); ?></td>
					<td><?php echo $task->finishdate, ' ', DATE("g:i A", STRTOTIME("$task->finishtime")); ?></td>
					<td><?php echo $task->client; ?></td>
					<td><?php echo $task->tech; ?></td>
					<td><?php echo $task->hours; ?></td>
					<td><?php echo $task->tasktype; ?></td>
					<td><?php echo $task->description; ?></td>
					<td><a href="#verifyTask<?php echo $task->taskid ?>" role="button" class="btn btn-small btn-info" data-toggle="modal">Verify</a><br></td>
					</tr>
					<?php
				}
			} 
			?>
			</tbody>
			</table>
		</div> <!-- /Unverified task report -->
		<!-- Verify Modal -->
<?php foreach($tasks as $task) { ?>
<div id="verifyTask<?php echo $task->taskid ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabelverify" aria-hidden="true">
	<form class="form-horizontal" action="reports/verifytask" method="post">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabelverify">Verify</h3>
		</div>
		<div class="modal-body">
			<h5><?php echo $task->firstname ?>'s task</h5>
			<div class="control-group">
				<label class="control-label" for="clientassign">Select a Client</label>
				<div class="controls">
					<input name="taskid" type="hidden" value="<?php echo $task->taskid ?>">
					<input name="techverify" type="hidden" value="<?php echo $task->tech ?>">
					<select name="clientassign" id="clientassign<?php echo $emp->id ?>">
						<?php foreach($clients as $client) {
							if($client->finishdate == 'Active') { ?>
								<option <?php if($task->client == $client->username){ echo 'selected';} ?> value="<?php echo $client->username, '">', $client->firstname, '</option>'; 
							}
						} ?>
					</select>
				</div> <!-- /Controls -->
			</div>
			<div class="control-group">
				<label class="control-label" for="startdate">On</label>
				<div class="controls">
					<div  id="startdate" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
					<input name="startdate" class="span2" type="date" value="<?php echo $task->activation ?>"></div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="starttime">Start Time</label>
				<div name="starttime" id="starttime" class="controls">
					<input name="starttime" type="time" class="span2" value="<?php echo $task->starttime ?>"/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="finishdate">Till</label>
				<div class="controls">
					<div id="finishdate" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
					<input name="finishdate" class="span2" type="date" value="<?php echo $task->finishdate ?>"></div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="finishtime">Finish Time</label>
				<div name="finishtime" id="finishtime" class="controls">
					<input name="finishtime" type="time" class="span2" value="<?php echo $task->finishtime ?>"/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="tasktype">Type</label>
				<div class="controls">
					<select name="tasktype" id="tasktype">
						<option <?php if($task->tasktype == 'Project'){ echo 'selected';} ?>>Project</option>
						<option <?php if($task->tasktype == 'Maintenance'){ echo 'selected';} ?>>Maintenence</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="descripcomplete">Description</label>
				<div class="controls">
				<textarea name="descripcomplete" id="descripcomplete" rows="8"><?php echo $task->description; ?></textarea>
				</div>
			</div>
		</div> <!-- /Modal body -->
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<input type="submit" value="Verify" class="btn btn-success">
		</div> <!-- /Modal footer -->
	</form>
</div> <!-- /Modal -->
<?php } ?>
	</div> <!-- /row -->
	<div class="row">
	<div class="span12">
		<h2>View Service Logs</h2>
		<h4>Select a date range</h4>
		<form class="form form-inline">
			<input name="startdate" class="span2" id="dp1" type="text" placeholder="Select a start date">
			<input name="finishdate" class="span2" id="dp2" type="text" placeholder="Select a finish date">
			<button class="btn btn-primary" id="getreport">Get report!</button>
			</form>
			<div id="servicelogs">
				<br><br><br><br><br><br><br><br><br><br><br><br>
			</div>

	</div>
	
	</div>
	
</div> <!-- /container -->

