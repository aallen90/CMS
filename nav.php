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
				 <li><a href="<?php echo base_url('calendar'); ?>">Calendar</a></li>
				<li><a href="<?php echo base_url('tasks'); ?>">Tasks</a></li>  
				<?php if($is_admin == 1) { ?>
					<li><a href="<?php echo base_url('reports'); ?>">Reports</a></li> 
					<li><a href="<?php echo base_url('users'); ?>">Users</a></li>
				<?php }
				if($is_client == 1) { ?>
					<li><a href="<?php echo base_url('invoices'); ?>">Invoices</a></li> 
				<?php } ?>
            </ul>
			<ul class="nav pull-right">
				<li><a href="<?php echo base_url('account/logout'); ?>">Logout</a></li>
			</ul>
          </div><!--/.nav-collapse -->
        </div>
    </div>
</div>