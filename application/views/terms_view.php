<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Term Management &middot; YIT Works</title>
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
					echo '<li><a href="tasks">Tasks</a></li>';
					echo '<li><a href="reports">Reports</a></li>';
					echo '<li class="active"><a href="#">Term Management</a></li>';
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
			<h2>Terms</h2>
			<h4>Manage terms for quick task entry.</h4>
			<div><a href="#addTerm" role="button" class="btn btn-success" data-toggle="modal">Add Another Term</a></div><br>
			<table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Term</th>
                  <th>Description</th>
				  <th>Modify</th>
                </tr>
              </thead>
              <tbody>
				      <?php foreach ($terms as $term) { ?>
						<tr>
						  <td><?php echo $term->term; ?></td>
						  <td><?php echo $term->description; ?></td>
						  <td><a href="#editTerm<?php echo $term->termid;?>" role="button" class="btn btn-small btn-info" data-toggle="modal">Edit</a><!-- Modal Trigger -->
						  <a href="terms/removeterm/<?php echo $term->termid; ?>" class="btn btn-small btn-danger">Remove</a>
							</td>
						</tr>    
						<?php } ?>
              </tbody>
            </table>
		
		</div> <!-- /Term table -->
	</div> <!-- /row -->
	
<!-- Modals -->
<?php foreach ($terms as $term) { ?>
<!-- Edit Term Modal -->
<div id="editTerm<?php echo $term->termid;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form class="modal-form form-horizontal" action="terms/editterm" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Edit <?php echo $term->term;?></h3>
  </div>
  <div class="modal-body">
    <h5>Use the form below to edit the term.</h5>
		<div class="control-group">
			<label class="control-label" for="term<?php echo $term->termid;?>">Term</label>
			<div class="controls">
				<input name="term" id="term<?php echo $term->termid;?>" type="text" value="<?php echo $term->term; ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="description<?php echo $term->description;?>">Description</label>
			<div class="controls">
				<textarea name="description" id="description<?php echo $term->description;?>" rows="4"><?php echo $term->description;?></textarea>
				<input name="termid" class="hide" value="<?php echo $term->termid;?>" />
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


<!-- Add Term -->

<div id="addTerm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form class="modal-form form-horizontal" action="terms/addterm" method="post"> 
 <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Add a new term</h3>
  </div>
  <div class="modal-body">
    <form class=" form-horizontal"><h5>Use the form below to add a new term.</h5>
		<div class="control-group">
			<label class="control-label" for="term">Term</label>
			<div class="controls">
				<input name="term" id="term" type="text">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="description">Description</label>
			<div class="controls">
				<textarea name="description" id="description" rows="4"></textarea>
			</div>
		</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <input type="submit" value="Add Term" class="btn btn-primary" />
  </div>
  </form>
</div>
	
</div> <!-- /container -->

