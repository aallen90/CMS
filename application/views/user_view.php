<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Users &middot; YIT Works</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
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
          <a class="brand" href="#">&nbsp;&nbsp;&nbsp;&nbsp;YIT Works</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
				<li><a href="home">Calendar</a></li>
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
					echo '<li class="active"><a href="users">Users</a></li>';
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
	<div class="row"> <!-- Reports-->
		<div class="span12">
			<h2>Users</h2>
			<h4>&nbsp;Employees</h4>
			<table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Username</th>
                  <th>Phone</th>
				  <th>Start Date</th>
				  <th>Finish Date</th>
				  <th>Notes</th>
				  <th>Modify</th>
                </tr>
              </thead>
              <tbody>
				      <?php foreach ($emps as $user) { ?>
						<tr>
						  <td><?php echo $user->firstname; ?></td>
						  <td><?php echo $user->lastname; ?></td>
						  <td><?php echo $user->username; ?></td>
						  <td><?php echo $user->phone; ?></td>
						  <td><?php echo $user->startdate; ?></td>
						  <td><?php echo $user->finishdate; ?></td>
						  <td><?php echo $user->notes; ?></td>
						  <td><a href="#editEmp<?php echo $user->id;?>" role="button" class="btn btn-small btn-info" data-toggle="modal">Edit</a><!-- Modal Trigger -->
						  <?php if ($user->finishdate != "Active")
						  {
							echo '<a href="users/enable/';echo $user->id; echo '" class="btn btn-small btn-danger">Enable</a>';
						  }
						  else
						  {
								echo '<a href="users/disable/';echo $user->id; echo '" class="btn btn-small btn-warning">Disable</a>';
							}?>  
							  </td>
						</tr>    
						<?php } ?>
              </tbody>
            </table>
		
	</div> </div> <a href="#addEmp" role="button" class="btn btn-success" data-toggle="modal">Add a New Employee</a><!-- Modal Trigger --><!-- /Users --><!-- /row -->
	
	<div class="row">
		<div class="'span12">
			<h4>&nbsp;Clients</h4>
			<table class="table table-hover table-bordered table-condensed">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Address</th>
                  <th>Phone</th>
				  <th>Client Since</th>
				  <th>Client Till</th>
				  <th>Notes</th>
				  <th>Modify</th>
                </tr>
              </thead>
              <tbody>
			  <?php foreach($clients as $client) { ?>
                <tr>
					<td><?php echo $client->firstname; ?></td>
					<td><?php echo $client->username; ?></td>
					<td><?php echo $client->lastname; ?></td>
					<td><?php echo $client->phone; ?></td>
					<td><?php echo $client->startdate; ?></td>
					<td><?php echo $client->finishdate; ?></td>
					<td><?php echo $client->notes; ?></td>
					<td><a href="#editClient<?php echo $client->id; ?>" role="button" class="btn btn-small btn-info" data-toggle="modal">Edit</a><!-- Modal Trigger -->
					  <?php if ($client->finishdate != "Active")
					  {
						echo '<a href="users/enable/';echo $client->id; echo '" class="btn btn-small btn-danger">Enable</a>';
					  }
					  else
					  {
							echo '<a href="users/disable/';echo $client->id; echo '" class="btn btn-small btn-warning">Disable</a>';
						}?>  
							  </td>
				</tr>    
					<?php } ?>
			  </tbody>
			</table>
		</div>
	</div><!-- /row -->
	<a href="#addClient" role="button" class="btn btn-success" data-toggle="modal">Add a New Client</a>
	
	
	
	
	
	
<!-- Modals -->
<?php foreach ($emps as $user) { ?>
<!-- Edit Employee Modal -->
<div id="editEmp<?php echo $user->id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form class="modal-form form-horizontal" action="users/editemployee" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Edit <?php echo "$user->firstname $user->lastname";?></h3>
  </div>
  <div class="modal-body">
    <h5>Use the form below to edit the employee.</h5>
		<div class="control-group">
			<label class="control-label" for="empFirst<?php echo $user->id;?>">First Name</label>
			<div class="controls">
				<input name="empFirst" id="empFirst<?php echo $user->id;?>" type="text" value="<?php echo $user->firstname;?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="empLast<?php echo $user->id;?>">Last Name</label>
			<div class="controls">
				<input name="empLast" id="empLast<?php echo $user->id;?>" type="text" value="<?php echo $user->lastname;?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="empUser<?php echo $user->id;?>">Username</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					<input name="empUser" id="empUser<?php echo $user->id;?>" type="text" value="<?php echo $user->username;?>">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="empPass<?php echo $user->id;?>">Password</label>
			<div class="controls">
				<input name="empPass" id="empPass<?php echo $user->id;?>" type="password" >
				<span class="help-block">Leave pass blank to keep the same.</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="empPhone<?php echo $user->id;?>">Phone</label>
			<div class="controls">
				<input name="empPhone" id="empPhone<?php echo $user->id;?>" type="text" value="<?php echo $user->phone;?>"/>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="empStart<?php echo $user->id;?>">Start Date</label>
			<div class="controls">
				<input name="empStart" id="empStart<?php echo $user->id;?>" type="date" value="<?php echo $user->startdate;?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="empFinish<?php echo $user->id;?>">Date Finished</label>
			<div class="controls">
				<input name="empFinish" id="empFinish<?php echo $user->id;?>" type="text" value="<?php echo $user->finishdate;?>">
				<span class="help-block">Anything not "Active" will be disabled.</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="empNotes<?php echo $user->id;?>">Notes</label>
			<div class="controls">
				<textarea name="empNotes" id="empNotes<?php echo $user->id;?>" rows="4"><?php echo $user->notes;?></textarea>
				<input name="empID" class="hide" value="<?php echo $user->id;?>" />
			</div>
		</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <input type="submit" value="Save Changes" class="btn btn-primary" />
  </div>
  </form>
</div>
<?php } ?>
<!-- Add Employee -->

<div id="addEmp" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form class="modal-form form-horizontal" action="users/addemployee" method="post"> 
 <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Add a new employee</h3>
  </div>
  <div class="modal-body">
    <form class=" form-horizontal"><h5>Use the form below to add an employee.</h5>
		<div class="control-group">
			<label class="control-label" for="empFirst">First Name</label>
			<div class="controls">
				<input name="empFirst" id="empFirst" type="text">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="empLast">Last Name</label>
			<div class="controls">
				<input name="empLast" id="empLast" type="text">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="empUser">Username</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					<input name="empUser" id="empUser" type="text">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="empPass">Password</label>
			<div class="controls">
				<input name="empPass" id="empPass" type="password">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="empPhone">Phone</label>
			<div class="controls">
				<input name="empPhone" id="empPhone" type="text">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="empStart">Start Date</label>
			<div class="controls">
				<input name="empStart" id="empStart" type="date">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="empNotes">Notes</label>
			<div class="controls">
				<textarea name="empNotes" id="empNotes" rows="4"></textarea>
			</div>
		</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <input type="submit" value="Add Employee" class="btn btn-primary" />
  </div>
  </form>
</div>

<!-- Edit Client -->
<?php foreach($clients as $client) { ?>
<div id="editClient<?php echo $client->id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form class="modal-form form-horizontal" action="users/editclient" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Edit <?php echo $client->firstname; ?></h3>
  </div>
  <div class="modal-body">
    <form class=" form-horizontal"><h5>Use the form below to edit client information.</h5>
		<div class="control-group">
			<label class="control-label" for="clientName<?php echo $client->id;?>">Name</label>
			<div class="controls">
				<input name="clientName" id="clientName<?php echo $client->id;?>" type="text" value="<?php echo $client->firstname;?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientUser<?php echo $client->id;?>">Username</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					<input name="clientUser" id="clientUser<?php echo $client->id;?>" type="text" value="<?php echo $client->username;?>">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientPass<?php echo $client->id;?>">Password</label>
			<div class="controls">
				<input name="clientPass" id="clientPass<?php echo $client->id;?>" type="password">
				<span class="help-block">Leave pass blank to keep the same.</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientAddress<?php echo $client->id;?>">Address</label>
			<div class="controls">
				<input name="clientAddress" id="clientAddress<?php echo $client->id;?>" type="text" value="<?php echo $client->lastname;?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientPhone<?php echo $client->id;?>">Phone</label>
			<div class="controls">
				<input name="clientPhone" id="clientPhone<?php echo $client->id;?>" type="text" value="<?php echo $client->phone;?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientStart<?php echo $client->id;?>">Client Since</label>
			<div class="controls">
				<input name="clientStart" id="clientStart<?php echo $client->id;?>" type="date" value="<?php echo $client->startdate;?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientNotes<?php echo $client->id;?>">Notes</label>
			<div class="controls">
				<textarea name="clientNotes" id="clientNotes<?php echo $client->id;?>" rows="4"><?php echo $client->notes;?></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientInvoiceView<?php echo $client->id;?>">View invoices up to:</label>
			<div class="controls">
				<input name="clientInvoiceView" id="clientInvoiceView<?php echo $client->id;?>" type="month" value="<?php echo $client->latestmonth;?>">
				<input name="clientID" class="hide" value="<?php echo $client->id;?>" />
			</div>
		</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <input type="submit" value="Save Changes" class="btn btn-primary" />
  </div>
  </form>
</div>
<?php } ?>

<!-- Add Client -->
<div id="addClient" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form class="modal-form form-horizontal" action="users/addclient" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Add a new Client</h3>
  </div>
  <div class="modal-body">
		<h5>Use the form below to add a new client.</h5>
		<div class="control-group">
			<label class="control-label" for="clientName">Name</label>
			<div class="controls">
				<input name="clientName" id="clientName" type="text">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientUser">Username</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					<input name="clientUser" id="clientUser" type="text">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientPass">Password</label>
			<div class="controls">
				<input name="clientPass" id="clientPass" type="password">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientAddress">Address</label>
			<div class="controls">
				<input name="clientAddress" id="clientAddress" type="text">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientPhone">Phone</label>
			<div class="controls">
				<input name="clientPhone" id="clientPhone" type="text">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientStart">Client Since</label>
			<div class="controls">
				<input name="clientStart" id="clientStart" type="date">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientNotes">Notes</label>
			<div class="controls">
				<textarea name="clientNotes" id="clientNotes" rows="4"></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="clientInvoiceView">View invoices up to:</label>
			<div class="controls">
				<input name="clientInvoiceView" id="clientInvoiceView" type="month">
			</div>
		</div>
		
		<h5>Rates</h5>
		<div class="control-group">
			<label class="control-label" for="project">Project</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">$</span>
					<input class="span2" id="project" type="text">
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="maintenance">Maintenance</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">$</span>
					<input class="span2" id="maintenance" type="text">
				</div>
			</div>
		</div><div class="control-group">
			<label class="control-label" for="monthlymaintenance">Monthly Maint.</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">$</span>
					<input class="span2" id="monthlymaintenance" type="text">
				</div>
			</div>
		</div><div class="control-group">
			<label class="control-label" for="travel">Travel</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">$</span>
					<input class="span2" id="travel" type="text">
				</div>
			</div>
		</div><div class="control-group">
			<label class="control-label" for="onsite">On-Site</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">$</span>
					<input class="span2" id="onsite" type="text">
				</div>
			</div>
		</div><div class="control-group">
			<label class="control-label" for="offsite">Off-Site</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">$</span>
					<input class="span2" id="offsite" type="text">
				</div>
			</div>
		</div><div class="control-group">
			<label class="control-label" for="remote">Remote (VPN)</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">$</span>
					<input class="span2" id="remote" type="text">
				</div>
			</div>
		</div><div class="control-group">
			<label class="control-label" for="phonesupport">Phone Support</label>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">$</span>
					<input class="span2" id="phonesupport" type="text">
				</div>
			</div>
		</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <input type="submit" value="Add Client" class="btn btn-primary" />
  </div>
  </form>
</div>
</div><br> <!-- /container -->
